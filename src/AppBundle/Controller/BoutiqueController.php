<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Joueur;
use AppBundle\Entity\Licencie;
use AppBundle\Entity\Produit;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BoutiqueController extends  Controller
{
    /**
     * @Route("/boutique/liste", name="boutique-liste")
     * @Template()
     */
    public function showAction()
    {
        $produits = $this->getDoctrine()->getRepository(Produit::class)->findAll();
        $licencies = $this->getDoctrine()->getRepository(Licencie::class)->findAll();

        return $this->render(':default:boutique.html.twig', [
            'produits' => $produits,
            'licencies' =>$licencies
        ]);
    }

    /**
     * @Route("/boutique/send", name="boutique-send")
     * @Template()
     */
    public function sendAction(Request $request){
        $existingXlsx   = $this->get('phpoffice.spreadsheet')->createSpreadsheet($this->get('kernel')->getRootDir() . '/Resources/Documents/BonDeCommande.xlsx');

        $now = new \DateTime();
        $nomFichier = $request->request->get('licencie') . $now->format('d-m-Y') .'.xlsx';
        $existingXlsx->getActiveSheet()->setCellValue('B1', $now->format('d/m/Y'));
        $existingXlsx->getActiveSheet()->setCellValue('B2', $request->request->get('licencie'));


        foreach ($request->request->get('abc') as $item => $value){
            $ligne = 6+$item;
            $existingXlsx->getActiveSheet()->setCellValue('B'.$ligne, $value['nomProduit']);
            switch ($value['taille']){
                case 'S':
                    $existingXlsx->getActiveSheet()->setCellValue('C'.$ligne, 'X');
                    break;
                case 'M':
                    $existingXlsx->getActiveSheet()->setCellValue('D'.$ligne, 'X');
                    break;
                case 'L':
                    $existingXlsx->getActiveSheet()->setCellValue('E'.$ligne, 'X');
                    break;
                case 'XL':
                    $existingXlsx->getActiveSheet()->setCellValue('F'.$ligne, 'X');
                    break;
                case 'XXL':
                    $existingXlsx->getActiveSheet()->setCellValue('G'.$ligne, 'X');
                    break;
            }
        }
        $writerXlsx = $this->get('phpoffice.spreadsheet')->createWriter($existingXlsx, 'Xlsx');

        $writerXlsx->save($this->get('kernel')->getRootDir() . '/Resources/Documents/commande-'.$nomFichier);
        $produits = $this->getDoctrine()->getRepository(Produit::class)->findAll();
        $licencies = $this->getDoctrine()->getRepository(Licencie::class)->findAll();


        $message = new \Swift_Message();
        $message->attach(\Swift_Attachment::fromPath($this->get('kernel')->getRootDir() . '/Resources/Documents/commande-'.$nomFichier));
        $message
            ->setSubject('Boutique USCL')
            ->setFrom('contact@uscl-foot.fr')
            ->setTo([$request->request->get('mail'),'delamare.mederic@gmail.com'])
            ->setBody($this->render(':default:mail_boutique.html.twig'),'text/html')
        ;

        $this->get('mailer')->send($message);

        return $this->render(':default:boutique.html.twig', [
            'produits'=> $produits,
            'licencies' =>$licencies
        ]);
    }
}