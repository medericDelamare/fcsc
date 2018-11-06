<?php
/**
 * Created by PhpStorm.
 * User: mdelamare
 * Date: 27/09/2017
 * Time: 19:27
 */

namespace AppBundle\Service\Category;


use AppBundle\Entity\StatsParJournee;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DomCrawler\Crawler;

abstract class Category
{

    protected $em;

    protected $urlAgenda;
    protected $urlCalendrier;
    protected $urlClassement;
    protected $urlResult;

    protected $category;
    protected $division;

    protected $resultats;
    protected $agenda;
    protected $classement;
    protected $calendrier;
    protected $classementParJournee;

    public function __construct(EntityManager $em, $category)
    {
        $this->em = $em;
        $this->category = $category;
    }

    public function getClassementParJournee(){
        return $this->em->getRepository(StatsParJournee::class)->findByCategOrderByJournee($this->category);
    }

    public function getDivision(){
        return $this->division;
    }

    public function getAgenda(){
        if (null === $this->agenda) {
            $ch = curl_init();


            curl_setopt($ch, CURLOPT_URL, $this->urlAgenda);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_NOBODY, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

            curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.7.12) Gecko/20050915 Firefox/1.0.7");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_REFERER, $_SERVER['REQUEST_URI']);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);

            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_exec($ch);

            $html = curl_exec($ch);

            curl_close($ch);

            $crawler = new Crawler($html);

            $crawler->filter('.confrontation');

            $resultats = [];

            for ($i = 0; $i < $crawler->filter('.confrontation')->count(); $i++) {
                $craw = $crawler->filter('.confrontation')->eq($i);

                $equipe1 = trim($craw->filter('.equipe1')->filter('.name')->text());
                $equipe2 = trim($craw->filter('.equipe2')->text());

                $date = $this->convertDate($craw->filter('.date')->first()->text());
                $resultats[] = [
                    'equipe1' => $equipe1,
                    'equipe2' => $equipe2,
                    'date'=> $date
                ];
            }

            $this->agenda = $resultats;
        }
            return $this->agenda;
    }

    public function getCalendrier(){
        if (null === $this->calendrier) {
            $ch = curl_init();


            curl_setopt($ch, CURLOPT_URL, $this->urlCalendrier);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_NOBODY, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

            curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.7.12) Gecko/20050915 Firefox/1.0.7");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_REFERER, $_SERVER['REQUEST_URI']);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);

            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_exec($ch);

            $html = curl_exec($ch);

            curl_close($ch);

            $crawler = new Crawler($html);


            $crawler->filter('.confrontation');

            $resultats = [];

            for ($i = 0; $i < $crawler->filter('.confrontation')->count(); $i++) {
                $craw = $crawler->filter('.confrontation')->eq($i);

                $equipe1 = trim($craw->filter('.equipe1')->filter('.name')->text());
                $equipe2 = trim($craw->filter('.equipe2')->text());

                $date = $this->convertDate($craw->filter('.date')->first()->text());


                if (($craw->filter('.number')->count() > 0)) {
                    $score = $craw->filter('.score_match')->html();
                    $scoreExposed = explode(' - ', $score);
                    $scoreDomicile = $this->getNombre($scoreExposed[0]);
                    $scoreExterieur = $this->getNombre($scoreExposed[1]);
                    $score = $scoreDomicile . ' - ' . $scoreExterieur;
                } else {
                    $score = '-';
                }

                $resultats[] = [
                    'equipe1' => $equipe1,
                    'equipe2' => $equipe2,
                    'date' => $date,
                    'score' => $score
                ];
            }

            $this->calendrier = $resultats;
        }

        return $this->calendrier;
    }

    public function getClassement(){
        if (null === $this->classement) {
            $ch = curl_init();


            curl_setopt($ch, CURLOPT_URL, $this->urlClassement);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_NOBODY, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

            curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.7.12) Gecko/20050915 Firefox/1.0.7");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_REFERER, $_SERVER['REQUEST_URI']);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);

            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_exec($ch);

            $html = curl_exec($ch);

            curl_close($ch);

            $crawler = new Crawler($html);

            $crawler->filter('.ranking-tab');

            $classement = [];

            for ($i = 1; $i < $crawler->filter('.ranking-tab > tr')->count(); $i++) {
                $craw = $crawler->filter('.ranking-tab > tr')->eq($i);
                $place = $craw->filter('td')->eq(0)->text();
                $equipe = $craw->filter('td')->eq(1)->text();
                $points = $craw->filter('td')->eq(2)->text();
                $journees = $craw->filter('td')->eq(3)->text();
                $gagnes = $craw->filter('td')->eq(4)->text();
                $nuls = $craw->filter('td')->eq(5)->text();
                $defaites = $craw->filter('td')->eq(6)->text();
                $forfaits = $craw->filter('td')->eq(7)->text();
                $butsPour = $craw->filter('td')->eq(8)->text();
                $butsContre = $craw->filter('td')->eq(9)->text();
                $penalites = $craw->filter('td')->eq(10)->text();
                $differences = $craw->filter('td')->eq(11)->text();


                $classement[] = [
                    'place' => $place,
                    'equipe' => $equipe,
                    'points' => $points,
                    'journées' => $journees,
                    'gagnes' => $gagnes,
                    'nuls' => $nuls,
                    'defaites' => $defaites,
                    'forfaits' => $forfaits,
                    'butsPour' => $butsPour,
                    'butsContre' => $butsContre,
                    'penalites' => $penalites,
                    'differences' => $differences
                ];
            }
            $this->classement = $classement;
        }
        return $this->classement;
    }

    public function getResults()
    {
        if (null === $this->resultats) {
            $ch = curl_init();


            curl_setopt($ch, CURLOPT_URL, $this->urlResult);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_NOBODY, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

            curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.7.12) Gecko/20050915 Firefox/1.0.7");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_REFERER, $_SERVER['REQUEST_URI']);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);

            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_exec($ch);

            $html = curl_exec($ch);

            curl_close($ch);

            $crawler = new Crawler($html);

            $crawler->filter('.confrontation');

            $resultats = [];


            for ($i = 0; $i < $crawler->filter('.confrontation')->count(); $i++) {
                $craw = $crawler->filter('.confrontation')->eq($i);
                $equipe1 = trim($craw->filter('.equipe1')->filter('.name')->text());
                $equipe2 = trim($craw->filter('.equipe2')->text());
                $date = $this->convertDate($craw->filter('.date')->first()->text());

                if (($craw->filter('.number')->count() > 0)) {
                    $score = $craw->filter('.score_match')->html();
                    $scoreExposed = explode(' - ', $score);
                    $scoreDomicile = $this->getNombre($scoreExposed[0]);
                    $scoreExterieur = $this->getNombre($scoreExposed[1]);
                    $score = $scoreDomicile . ' - ' . $scoreExterieur;
                } else {
                    $score = '-';
                }

                $resultats[] = [
                    'equipe1' => $equipe1,
                    'equipe2' => $equipe2,
                    'score' => $score,
                    'date' => $date
                ];
            }

            $this->resultats = $resultats;
        }

        return $this->resultats;
    }

    public function convertDate($date)
    {
        $dateRegex = preg_replace('(\s+)', ' ', $date);
        $dateSplit = explode(' ', $dateRegex);
        switch ($dateSplit[3]) {
            case 'janvier':
                $dateSplit[3] = "01";
                break;
            case 'février':
            case 'fevrier':
                $dateSplit[3] = "02";
                break;
            case 'mars':
                $dateSplit[3] = "03";
                break;
            case 'avril':
                $dateSplit[3] = "04";
                break;
            case 'mai':
                $dateSplit[3] = "05";
                break;
            case 'juin':
                $dateSplit[3] = "06";
                break;
            case 'jullet':
                $dateSplit[3] = "07";
                break;
            case 'aout':
            case 'août':
                $dateSplit[3] = "08";
                break;
            case 'septembre':
                $dateSplit[3] = "09";
                break;
            case 'octobre':
                $dateSplit[3] = "10";
                break;
            case 'novembre':
                $dateSplit[3] = "11";
                break;
            case 'décembre':
            case 'decembre':
                $dateSplit[3] = "12";
                break;
        }
        return $dateSplit[2] . "/" . $dateSplit[3] . "/" . $dateSplit[4];
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
}