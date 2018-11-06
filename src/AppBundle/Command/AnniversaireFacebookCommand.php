<?php

namespace AppBundle\Command;


use AppBundle\Entity\Joueur;
use AppBundle\Entity\Licencie;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AnniversaireFacebookCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('anniversaire:facebook')
            ->setDescription('Import des joueurs via la liste extraite de Footclub');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Showing when the script is launched
        $now = new \DateTime();
        $output->writeln('<comment>Start : ' . $now->format('d-m-Y G:i:s') . ' ---</comment>');

        // Getting doctrine manager
        $em = $this->getContainer()->get('doctrine')->getManager();
        $joueurs = $em->getRepository(Licencie::class)->findBirthday();

        $message = null;
        $noms = null;
        $age = null;

        $now = new \DateTime();

        if (count($joueurs) == 1 ){
            /** @var Licencie $joueur */
            $joueur = array_shift($joueurs);
            $infos = $noms . $joueur->getPrenom() . ' ' . $joueur->getNom() . ' ( ' . $joueur->getCarriere()->first()->getSousCategorie() . ' )';
            $age = $now->format('Y') - $joueur->getDateDeNaissance()->format('Y');
            $categ = $joueur->getCarriere()->first()->getSaison();
            $message = '🎂Alerte anniversaire🎂'.PHP_EOL .  PHP_EOL.'L\'USCL souhaite un joyeux anniversaire à ' . $infos . ' qui fête aujourd\'hui ses ' . $age . ' ans'.PHP_EOL.PHP_EOL.'⚽🔵⚪';

        } elseif (count($joueurs) > 1){
            /** @var Licencie $joueur */
            $messageJoueurs = '';

            foreach ($joueurs as $joueur){
                $age = $now->format('Y') - $joueur->getDateDeNaissance()->format('Y');
                $messageJoueurs = $messageJoueurs . PHP_EOL .  PHP_EOL . $joueur->getNomComplet() . ' ( ' . $joueur->getCarriere()->first()->getSousCategorie() . ' ) pour ses ' . $age . ' ans';
            }
            $message = '🎂Alerte anniversaire🎂'.PHP_EOL .  PHP_EOL.'L\'USCL souhaite un joyeux anniversaire à :' . $messageJoueurs . PHP_EOL . PHP_EOL . '⚽🔵⚪';
        }

        $this->getContainer()->get('app_core.facebook')->poster($message);

        // Showing when the script is over
        $now = new \DateTime();
        $output->writeln('<comment>End : ' . $now->format('d-m-Y G:i:s') . ' ---</comment>');
    }
}