<?php
namespace AppBundle\Command;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
class SaveRencontresCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('save:rencontres')
            ->setDescription('Récupération des données sur le disctrict')
            ->addArgument('url', InputArgument::REQUIRED, 'Url?')
            ->addArgument('categorie', InputArgument::REQUIRED, 'Categorie?')
        ;
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $url = $input->getArgument('url');
        $categorie = $input->getArgument('categorie');
        $now = new \DateTime();
        $output->writeln('<comment>Start : ' . $now->format('d-m-Y G:i:s') . ' ---</comment>');
        $parseService = $this->getContainer()->get('parse.parse_scores');
        $parseService->getStats($url, $categorie);
        $now = new \DateTime();
        $output->writeln('<comment>End : ' . $now->format('d-m-Y G:i:s') . ' ---</comment>');
    }
}