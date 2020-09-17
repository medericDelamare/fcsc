<?php

namespace AppBundle\Service\Scorenco;


use AppBundle\Model\Scorenco\Championnat;
use AppBundle\Model\Scorenco\Classement;
use AppBundle\Model\Scorenco\Club;
use AppBundle\Model\Scorenco\Equipe;
use AppBundle\Model\Scorenco\InformationsCompetition;
use AppBundle\Model\Scorenco\Journee;
use AppBundle\Model\Scorenco\Match;
use AppBundle\Model\Scorenco\RankingData;
use AppBundle\Model\Scorenco\Resultat;
use AppBundle\Model\Scorenco\ResultRequest;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use GuzzleHttp\Client;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ScorencoService
{
    public function getJourneeByUrl($url)
    {
        $client = new Client();
        $response = $client->get($url);

        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());

        $serializer = new Serializer($normalizers, $encoders);

        /** @var Championnat $championnat */
        $championnat = $serializer->deserialize($response->getBody(), Championnat::class, 'json');

        $journees = [];
        /** @var Journee $round */
        foreach ($championnat->getRounds() as $round) {
            /** @var Journee $journee */
            $journee = $serializer->deserialize(json_encode($round), Journee::class, 'json');
            $matchs = [];
            /** @var Match $event */
            foreach ($journee->getEvents() as $event) {
                /** @var Match $match */
                $match = $serializer->deserialize(json_encode($event), Match::class, 'json');
                $equipes = [];
                foreach ($match->getTeams() as $team) {
                    $equipes[] = $serializer->deserialize(json_encode($team), Equipe::class, 'json');
                }
                $match->setTeams($equipes);
                $matchs[] = $match;
            }
            $journee->setEvents($matchs);
            $journees[] = $journee;
        }
        $championnat->setRounds($journees);

        return $championnat;
    }


    public function getClassementByUrl($competitionId)
    {
        $client = new Client();
        $response = $client->get("https://scorenco.com/backend/v1/competitions/" . $competitionId . "/rankings/");

        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());

        $serializer = new Serializer($normalizers, $encoders);

        /** @var Classement $classement */
        $classement = $serializer->deserialize($response->getBody(), Classement::class, 'json');

        $equipes = [];
        foreach ($classement->getTeams() as $team) {
            /** @var Equipe $equipe */
            $equipe = $serializer->deserialize(json_encode($team), Equipe::class, 'json');
            $equipe->setRankingData($this->populateRankingData($equipe));
            $equipe->setLastResults($this->getLastFiveResults($equipe->getTeamId(), $competitionId));
            $equipes[] = $equipe;
        }
        $classement->setTeams($equipes);
        return $classement;
    }

    public function getInformationsCompetition($url)
    {
        $client = new Client();
        $response = $client->get($url);

        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());

        $serializer = new Serializer($normalizers, $encoders);

        return $serializer->deserialize($response->getBody(), InformationsCompetition::class, 'json');
    }

    public function getLastFiveResults($teamId, $competitionId)
    {
        $url = 'https://scorenco.com/backend/v1/teams/' . $teamId . '/results/?pageSize=20&competitionId='. $competitionId .'&fields=id,teams%7BteamId,clubId,logo,score,name,shortName,result,withdrawal,penalties%7D,status,gameStatus,date,url,sportId,timeUnavailable,isLive,liveTime,competitionId';
        $client = new Client();
        $response = $client->get($url);

        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());

        $serializer = new Serializer($normalizers, $encoders);
        /** @var ResultRequest $resultsRequest */
        $resultsRequest = $serializer->deserialize($response->getBody(), ResultRequest::class, 'json');

        $lastResults = [];
        foreach ($resultsRequest->getResults() as $result) {
            /** @var Resultat $result */
            $result = $serializer->deserialize(json_encode($result), Resultat::class, 'json');

            if ($result->getGameStatus() == "normal" && $result->getStatus() == "finish"){
                /** @var Equipe $equipeDom */
                $equipeDom = $serializer->deserialize(json_encode($result->getTeams()[0]), Equipe::class, 'json');
                /** @var Equipe $equipeExt */
                $equipeExt = $serializer->deserialize(json_encode($result->getTeams()[1]), Equipe::class, 'json');

                $lastResults[] = $this->getResultAcronym($teamId, $equipeDom, $equipeExt);
            }
        }

        return array_slice($lastResults, 0,5);
    }

    public function getCalendrierByEquipeAndCompetition($teamId, $competitionId)
    {
        $result = new ArrayCollection(array_merge($this->getResultsByEquipeAndCompetition($teamId, $competitionId), $this->getAgendaByEquipeAndCompetition($teamId, $competitionId)));
        $criteria = Criteria::create()
            ->orderBy(['date' => 'ASC']);

        return $result->matching($criteria);
    }

    public function getDisctinctTeams($url)
    {
        $client = new Client();
        $response = $client->get($url);

        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());

        $serializer = new Serializer($normalizers, $encoders);

        /** @var Classement $classement */
        $classement = $serializer->deserialize($response->getBody(), Classement::class, 'json');

        $distinctEquipes = [];
        foreach ($classement->getTeams() as $team) {
            /** @var Equipe $equipe */
            $equipe = $serializer->deserialize(json_encode($team), Equipe::class, 'json');
            $distinctEquipes[$equipe->getTeamId()] = $equipe->getName();
        }
        return $distinctEquipes;
    }

    public function getLastResultsOfComeptition($competitionId)
    {
        $lastDay = $this->getLastDay($competitionId);
        return $this->getDayByNumber($competitionId, $lastDay);
    }

    public function getAgendasOfCompetition($competitionId)
    {
        $nextDay = $this->getNextDay($competitionId);
        return $this->getDayByNumber($competitionId, $nextDay);
    }

    public function getClubInfoBySlug($clubSlug){
        $client = new Client();
        $response = $client->get("https://scorenco.com/backend/v1/clubs/sport/football/club/". $clubSlug ."/?gtbl=1&exclude=sponsors");

        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());

        $serializer = new Serializer($normalizers, $encoders);

        /** @var Club $club */
        $club = $serializer->deserialize($response->getBody(), Club::class, 'json');

        return $club;
    }

    private function getLastDay($competitionId)
    {
        $client = new Client();
        $response = $client->get("https://scorenco.com/backend/v1/competitions/" . $competitionId . "/events");

        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());

        $serializer = new Serializer($normalizers, $encoders);

        /** @var Championnat $championnat */
        $championnat = $serializer->deserialize($response->getBody(), Championnat::class, 'json');

        $dates = new ArrayCollection();
        /** @var Journee $round */
        foreach ($championnat->getRounds() as $round) {
            $journee = $serializer->deserialize(json_encode($round), Journee::class, 'json');
            $dates->add($journee);
        }

        $now = new \DateTime();
        $nowFormatted = $now->format('Y-m-d');

        $criteria = Criteria::create()
            ->where(Criteria::expr()->lt('officialDate', $nowFormatted))
            ->orderBy(['officialDate' => 'ASC']);
        return $dates->matching($criteria)->last();
    }

    private function getNextDay($competitionId)
    {
        $client = new Client();
        $response = $client->get("https://scorenco.com/backend/v1/competitions/" . $competitionId . "/events");

        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());

        $serializer = new Serializer($normalizers, $encoders);

        /** @var Championnat $championnat */
        $championnat = $serializer->deserialize($response->getBody(), Championnat::class, 'json');

        $dates = new ArrayCollection();
        /** @var Journee $round */
        foreach ($championnat->getRounds() as $round) {
            $journee = $serializer->deserialize(json_encode($round), Journee::class, 'json');
            $dates->add($journee);
        }

        $now = new \DateTime();
        $nowFormatted = $now->format('Y-m-d');
        $criteria = Criteria::create()
            ->where(Criteria::expr()->gt('officialDate', $nowFormatted))
            ->orderBy(['officialDate' => 'ASC']);
        return $dates->matching($criteria)->first();
    }

    /**
     * @param Equipe $equipe
     * @return RankingData
     */
    private function populateRankingData(Equipe $equipe)
    {
        $rankingData = new RankingData();
        foreach ($equipe->getData() as $datum) {
            if (array_key_exists('pts', $datum)) $rankingData->setPoints($datum['pts']);
            if (array_key_exists('jo', $datum)) $rankingData->setJournees($datum['jo']);
            if (array_key_exists('g', $datum)) $rankingData->setVictoires($datum['g']);
            if (array_key_exists('n', $datum)) $rankingData->setNuls($datum['n']);
            if (array_key_exists('p', $datum)) $rankingData->setDefaites($datum['p']);
            if (array_key_exists('f', $datum)) $rankingData->setForfaits($datum['f']);
            if (array_key_exists('bp', $datum)) $rankingData->setButsP($datum['bp']);
            if (array_key_exists('bc', $datum)) $rankingData->setButsC($datum['bc']);
            if (array_key_exists('diff', $datum)) $rankingData->setDiff($datum['diff']);
        }

        return $rankingData;
    }

    /**
     * @param $teamId
     * @param Equipe $equipeDom
     * @param Equipe $equipeExt
     * @return string|null
     */
    private function getResultAcronym($teamId, Equipe $equipeDom, Equipe $equipeExt)
    {
        $result = null;
        if ($teamId == $equipeDom->getTeamId()) {
            if ($equipeDom->getScore() == $equipeExt->getScore()) {
                $result = 'n';
            } elseif ($equipeDom->getScore() > $equipeExt->getScore()) {
                $result = 'v';
            } elseif ($equipeDom->getScore() < $equipeExt->getScore()) {
                $result = 'd';
            }
        } elseif ($teamId == $equipeExt->getTeamId()) {
            if ($equipeDom->getScore() == $equipeExt->getScore()) {
                $result = 'n';
            } elseif ($equipeExt->getScore() > $equipeDom->getScore()) {
                $result = 'v';
            } elseif ($equipeExt->getScore() < $equipeDom->getScore()) {
                $result = 'd';
            }
        }
        return $result;
    }

    /**
     * @param $teamId
     * @param $competitionId
     * @return array
     */
    private function getResultsByEquipeAndCompetition($teamId, $competitionId)
    {
        $resultats = [];
        $url = 'https://scorenco.com/backend/v1/teams/' . $teamId . '/results/?pageSize=100&competitionId=' . $competitionId . '&fields=id,teams%7BteamId,clubId,logo,score,name,shortName,result,withdrawal,penalties%7D,status,gameStatus,date,url,sportId,timeUnavailable,isLive,liveTime,competitionId';
        $client = new Client();
        $response = $client->get($url);
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());

        $serializer = new Serializer($normalizers, $encoders);
        /** @var ResultRequest $resultsRequest */
        $resultsRequest = $serializer->deserialize($response->getBody(), ResultRequest::class, 'json');

        foreach ($resultsRequest->getResults() as $result) {
            /** @var Resultat $resultat */
            $resultat = $serializer->deserialize(json_encode($result), Resultat::class, 'json');
            /** @var Equipe $equipeDom */
            $equipeDom = $serializer->deserialize(json_encode($resultat->getTeams()[0]), Equipe::class, 'json');
            /** @var Equipe $equipeExt */
            $equipeExt = $serializer->deserialize(json_encode($resultat->getTeams()[1]), Equipe::class, 'json');

            $resultat->setTeams([$equipeDom, $equipeExt]);
            $resultats[] = $resultat;
        }
        return $resultats;
    }


    /**
     * @param $teamId
     * @param $competitionId
     * @return array
     */
    private function getAgendaByEquipeAndCompetition($teamId, $competitionId)
    {
        $agendas = [];
        $url = 'https://scorenco.com/backend/v1/teams/' . $teamId . '/calendar/?pageSize=100&competitionId=' . $competitionId . '&fields=id,teams%7BteamId,clubId,logo,score,name,shortName,result,withdrawal,penalties%7D,status,gameStatus,date,url,sportId,timeUnavailable,competitionId';
        $client = new Client();
        $response = $client->get($url);
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());

        $serializer = new Serializer($normalizers, $encoders);
        /** @var ResultRequest $resultsRequest */
        $resultsRequest = $serializer->deserialize($response->getBody(), ResultRequest::class, 'json');

        foreach ($resultsRequest->getResults() as $result) {
            /** @var Resultat $result */
            $agenda = $serializer->deserialize(json_encode($result), Resultat::class, 'json');
            /** @var Equipe $equipeDom */
            $equipeDom = $serializer->deserialize(json_encode($agenda->getTeams()[0]), Equipe::class, 'json');
            /** @var Equipe $equipeExt */
            $equipeExt = $serializer->deserialize(json_encode($agenda->getTeams()[1]), Equipe::class, 'json');

            $agenda->setTeams([$equipeDom, $equipeExt]);
            $agendas[] = $agenda;
        }

        return $agendas;
    }

    /**
     * @param $competitionId
     * @param $lastDay
     * @return Journee
     */
    private function getDayByNumber($competitionId, $lastDay)
    {

        if ($lastDay){
            $client = new Client();
            $response = $client->get("https://scorenco.com/backend/v1/competitions/" . $competitionId . "/events/?roundRank=" . $lastDay->getRank());
            $encoders = array(new XmlEncoder(), new JsonEncoder());
            $normalizers = array(new ObjectNormalizer());

            $serializer = new Serializer($normalizers, $encoders);

            /** @var Championnat $championnat */
            $championnat = $serializer->deserialize($response->getBody(), Championnat::class, 'json');
            foreach ($championnat->getRounds() as $round) {
                /** @var Journee $journee */
                $journee = $serializer->deserialize(json_encode($round), Journee::class, 'json');

                $matchs = [];
                foreach ($journee->getEvents() as $event) {
                    /** @var Match $match */
                    $match = $serializer->deserialize(json_encode($event), Match::class, 'json');
                    /** @var Equipe $equipeDom */
                    $equipeDom = $serializer->deserialize(json_encode($match->getTeams()[0]), Equipe::class, 'json');
                    /** @var Equipe $equipeExt */
                    $equipeExt = $serializer->deserialize(json_encode($match->getTeams()[1]), Equipe::class, 'json');

                    $match->setTeams([$equipeDom, $equipeExt]);
                    $matchs[] = $match;
                }
                $journee->setEvents($matchs);
                if ($journee->getRank() == $lastDay->getRank()) {
                    return $journee;
                }
            }
        }

    }
}