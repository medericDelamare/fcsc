<?php


namespace AppBundle\Service\Parse;


use AppBundle\Entity\Equipe;
use AppBundle\Entity\Rencontre;
use AppBundle\Entity\StatsParJournee;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DomCrawler\Crawler;

class ParseService
{

    private $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function getStats($url, $category){
        $ch = curl_init();


        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_NOBODY, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.7.12) Gecko/20050915 Firefox/1.0.7");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($ch, CURLOPT_REFERER, $_SERVER['REQUEST_URI']);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_exec($ch);

        $html = curl_exec($ch);

        curl_close($ch);

        $crawler = new Crawler($html);

        $crawler->filter('.confrontation');

        $stats = $this->em->getRepository(StatsParJournee::class)->findByCategorie($category);
        foreach ($stats as $stat){
            $this->em->remove($stat);
        }

        $this->em->flush();
        for ($i = 0; $i < $crawler->filter('.results-content')->count(); $i++) {
            $craw = $crawler->filter('.results-content')->eq($i);
            if (($craw->filter('.widgettitle > span')->count() > 0)) {
                $journee = $craw->filter('.widgettitle > span')->text();
                $journee = (int)str_replace('Journée ', '', $journee);

                for ($j = 0; $j < $craw->filter('.result-display')->count(); $j++){
                    $crawRencontre = $craw->filter('.result-display')->eq($j);
                    $equipe1 = trim($crawRencontre->filter('.equipe1 > .name')->text());
                    $equipe2 = trim($crawRencontre->filter('.equipe2 > .name')->text());
                    $date = $this->convertDate($crawRencontre->filter('.date')->first()->text());
                    $date = \DateTime::createFromFormat('d/m/Y H:i', $date);

                    $rencontreBdd = $this->em->getRepository(Rencontre::class)->getRencontreByEquipeAndCategorie($equipe1, $equipe2, $category);

                    if (count($rencontreBdd) == 1){
                        $rencontreBdd = $rencontreBdd[0];
                    } elseif (count($rencontreBdd) == 0 && ($equipe1 != 'Exempt' && $equipe2 != 'Exempt')) {
                        $rencontreBdd = new Rencontre();
                    } elseif (count($rencontreBdd) > 1){
                        dump('Erreur');
                        continue;
                    }

                    $isForfaitDom = null;
                    if ($crawRencontre->filter('.equipe1 > .forfeit')->count() > 0){
                        $isForfaitDom = empty(trim($crawRencontre->filter('.equipe1 > .forfeit')->text())) ? $forfaitDom = false : $forfaitDom=true;
                    }

                    $isForfaitExt = null;
                    if ($crawRencontre->filter('.equipe2 > .forfeit')->count() > 0){
                        $isForfaitExt = empty(trim($crawRencontre->filter('.equipe2 > .forfeit')->text())) ? $forfaitDom = false : $forfaitDom=true;
                    }

                    if ($equipe1 == 'Exempt' || $equipe2 == 'Exempt'){
                        continue;
                    }

                    /** @var Equipe $equipeDom */
                    $equipeDom = $this->em->getRepository(Equipe::class)->findOneBy([
                        'nomParse' => $equipe1,
                        'categorie' => $category
                    ]);

                    /** @var Equipe $equipeExt */
                    $equipeExt = $this->em->getRepository(Equipe::class)->findOneBy([
                        'nomParse' => $equipe2,
                        'categorie' => $category
                    ]);

                    if (!$equipeDom){
                        $equipeDom = new Equipe($category,$equipe1);
                    }

                    if (!$equipeExt){
                        $equipeExt = new Equipe($category,$equipe2);
                    }

                    // Si il y a un score
                    if (($crawRencontre->filter('.number')->count() > 0)) {
                        $scoreParse = $crawRencontre->filter('.score_match')->html();
                        $score = $this->getScore($scoreParse);

                        if ($score != $rencontreBdd->getScore()){
                            $this->computeClassement($isForfaitDom, $isForfaitExt, $equipeDom, $equipeExt, $score);
                        }

                        if (!$rencontreBdd->getEquipeDomicile()){
                            $rencontreBdd
                                ->setEquipeDomicile($equipeDom);
                        }
                        if (!$rencontreBdd->getEquipeExterieure()){
                            $rencontreBdd
                                ->setEquipeExterieure($equipeExt);
                        }



                        $rencontreBdd
                            ->setDate($date)
                            ->setJournee($journee)
                            ->setScore($score);
                        $this->em->persist($equipeExt);
                        $this->em->persist($equipeDom);
                        $this->em->persist($rencontreBdd);
                        $this->em->flush();
                    }
                    //Si forfait
                    elseif(($crawRencontre->filter('.number')->count() == 0) && ($isForfaitExt || $isForfaitDom)){
                        if ($isForfaitDom){
                            $statsDom = $equipeDom->getStats();
                            $statsDom->computeForfaitContre();

                            $statsExt = $equipeExt->getStats();
                            $statsExt->computeForfaitPour();
                        }elseif ($isForfaitExt){
                            $statsDom = $equipeDom->getStats();
                            $statsDom->computeForfaitPour();

                            $statsExt = $equipeExt->getStats();
                            $statsExt->computeForfaitContre();
                        }

                        $this->em->persist($equipeExt);
                        $this->em->persist($equipeDom);
                        $this->em->flush();

                    }
                    //Sinon
                    else{
                        $rencontreBdd
                            ->setEquipeDomicile($equipeDom)
                            ->setEquipeExterieure($equipeExt)
                            ->setDate($date)
                            ->setJournee($journee);
                        if ($equipeDom == null || $equipeExt == null){
                            dump($equipe1, $equipe2); die;
                        }
                        $this->em->persist($equipeExt);
                        $this->em->persist($equipeDom);
                        $this->em->persist($rencontreBdd);
                        $this->em->flush();
                    }
                }
            }
        }

    }

    public function getNumberByImgUrl($imgUrl)
    {
        if ($imgUrl == 'vide') {
            return '';
        }
        $imgHeaders = get_headers($imgUrl, 1);

        switch ($imgHeaders['Content-Length']) {
            case '2543':
                $score = '0';
                break;
            case '733':
                $score = '1';
                break;
            case '1921':
                $score = '2';
                break;
            case '1987':
                $score = '3';
                break;
            case '1595':
                $score = '4';
                break;
            case '1909':
                $score = '5';
                break;
            case '2632':
                $score = '6';
                break;
            case '1276':
                $score = '7';
                break;
            case '2585':
                $score = '8';
                break;
            case '2570':
                $score = '9';
                break;
        }

        return $score;
    }

    private function getNombre($html)
    {
        $crawler = new Crawler($html);
        $nombre = null;
        for ($i = 0; $i <= $crawler->filter('.number')->count() - 1; $i++) {
            $nombre = $nombre . $this->getNumberByImgUrl($crawler->filter('.number')->eq($i)->attr('src'));
        }
        return $nombre;
    }

    private function convertDate($date)
    {
        $dateRegex = preg_replace('(\s+)', ' ', $date);
        $dateSplit = explode(' ', $dateRegex);
        switch ($dateSplit[6]) {
            case 'janvier':
                $dateSplit[6] = "01";
                break;
            case 'février':
            case 'fevrier':
                $dateSplit[6] = "02";
                break;
            case 'mars':
                $dateSplit[6] = "03";
                break;
            case 'avril':
                $dateSplit[6] = "04";
                break;
            case 'mai':
                $dateSplit[6] = "05";
                break;
            case 'juin':
                $dateSplit[6] = "06";
                break;
            case 'jullet':
                $dateSplit[6] = "07";
                break;
            case 'aout':
            case 'août':
                $dateSplit[6] = "08";
                break;
            case 'septembre':
                $dateSplit[6] = "09";
                break;
            case 'octobre':
                $dateSplit[6] = "10";
                break;
            case 'novembre':
                $dateSplit[6] = "11";
                break;
            case 'décembre':
            case 'decembre':
                $dateSplit[6] = "12";
                break;
        }

        if (count($dateSplit) < 10) {
            return '03/11/1992 06:00';
        }

        $heure = explode('H',$dateSplit[9]);
        return $dateSplit[5] . "/" . $dateSplit[6] . "/" . $dateSplit[7] . ' ' . $heure[0] . ':' . $heure[1];
    }

    private function computeClassement($isForfaitDom, $isForfaitExt, $equipeDom, $equipeExt, $score){
        $scoreDomicile = (int)trim(explode('-',$score)[0]);
        $scoreExterieur = (int)trim(explode('-',$score)[1]);
        if ($isForfaitDom){
            $statsDom = $equipeDom->getStats();
            $statsDom->computeForfaitContre();

            $statsExt = $equipeExt->getStats();
            $statsExt->computeForfaitPour();
        } elseif ($isForfaitExt){
            $statsDom = $equipeDom->getStats();
            $statsDom->computeForfaitPour();

            $statsExt = $equipeExt->getStats();
            $statsExt->computeForfaitContre();
        } elseif ($scoreDomicile > $scoreExterieur){
            $statsDom = $equipeDom->getStats();
            $statsDom->computeVictoire($scoreDomicile, $scoreExterieur);

            $statsExt = $equipeExt->getStats();
            $statsExt->computeDefaite($scoreExterieur, $scoreDomicile);
        } elseif ($scoreDomicile < $scoreExterieur){
            $statsDom = $equipeDom->getStats();
            $statsDom->computeDefaite($scoreDomicile, $scoreExterieur);

            $statsExt = $equipeExt->getStats();
            $statsExt->computeVictoire($scoreExterieur, $scoreDomicile);
        }  elseif ( $scoreDomicile == $scoreExterieur){
            $statsDom = $equipeDom->getStats();
            $statsDom
                ->computeNul($scoreDomicile, $scoreExterieur);

            $statsExt = $equipeExt->getStats();
            $statsExt->computeNul($scoreExterieur, $scoreDomicile);
        }
    }

    private function getScore($score){
        $scoreExposed = explode(' - ', $score);
        $scoreDomicile = $this->getNombre($scoreExposed[0]);
        $scoreExterieur = $this->getNombre($scoreExposed[1]);
        $score = $scoreDomicile . '-' . $scoreExterieur;
        return $score;
    }
}