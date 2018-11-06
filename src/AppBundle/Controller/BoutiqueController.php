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
        $produitsJDM = $this->getDoctrine()->getRepository(Produit::class)->findByCategorie(1);
        $produitsEntrainement = $this->getDoctrine()->getRepository(Produit::class)->findByCategorie(2);
        $produitsAccessoires = $this->getDoctrine()->getRepository(Produit::class)->findByCategorie(3);
        $produitsDirigeant = $this->getDoctrine()->getRepository(Produit::class)->findByCategorie(4);
        $licencies = $this->getDoctrine()->getRepository(Licencie::class)->findAll();

        return $this->render(':default:boutique.html.twig', [
            'jourDeMatch'=> $produitsJDM,
            'entrainement'=> $produitsEntrainement,
            'accessoires'=> $produitsAccessoires,
            'dirigeant'=> $produitsDirigeant,
            'licencies' =>$licencies
        ]);
    }

    /**
     * @Route("/boutique/send", name="boutique-send")
     * @Template()
     */
    public function sendAction(Request $request){
        $existingXlsx   = $this->get('phpoffice.spreadsheet')->createSpreadsheet($this->get('kernel')->getRootDir() . '/Resources/documents/bonDeCommande.xlsx');

        $now = new \DateTime();
        $nomFichier = $request->request->get('licencie') . $now->format('d-m-Y') .'.xlsx';
        $existingXlsx->getActiveSheet()->setCellValue('B1', $now->format('d/m/Y'));

        foreach ($request->request->get('abc') as $item => $value){
            $ligne = 8+$item;
            $existingXlsx->getActiveSheet()->setCellValue('A'.$ligne, $value['reference']);
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

            if ($value['logo'] == true && !empty($value['initiales'])){
                $existingXlsx->getActiveSheet()->setCellValue('H'.$ligne, 'Logo Club + Initiales');
                $existingXlsx->getActiveSheet()->setCellValue('I'.$ligne, $value['initiales']);
            }
            elseif ($value['logo'] == true){
                $existingXlsx->getActiveSheet()->setCellValue('H'.$ligne, 'Logo Club');
            } elseif (!empty($value['initiales'])){
                $existingXlsx->getActiveSheet()->setCellValue('H'.$ligne, 'Initiales');
                $existingXlsx->getActiveSheet()->setCellValue('I'.$ligne, $value['initiales']);
            }
            $existingXlsx->getActiveSheet()->setCellValue('J'.$ligne, $request->request->get('licencie'));
        }

        $writerXlsx = $this->get('phpoffice.spreadsheet')->createWriter($existingXlsx, 'Xlsx');
        $writerXlsx->save($this->get('kernel')->getRootDir() . '/Resources/documents/commande-'.$nomFichier);
        $produitsJDM = $this->getDoctrine()->getRepository(Produit::class)->findByCategorie(1);
        $produitsEntrainement = $this->getDoctrine()->getRepository(Produit::class)->findByCategorie(2);
        $produitsAccessoires = $this->getDoctrine()->getRepository(Produit::class)->findByCategorie(3);
        $produitsDirigeant = $this->getDoctrine()->getRepository(Produit::class)->findByCategorie(4);
        $licencies = $this->getDoctrine()->getRepository(Licencie::class)->findAll();


        $message = new \Swift_Message();
        $message->attach(\Swift_Attachment::fromPath($this->get('kernel')->getRootDir() . '/Resources/documents/commande-'.$nomFichier));
        $message
            ->setSubject('Boutique USCL')
            ->setFrom('contact@uscl-foot.fr')
            ->setTo([$request->request->get('mail'),'delamare.mederic@gmail.com'])
            ->setBody($this->render(':default:mail_boutique.html.twig'),'text/html')
        ;

        $this->get('mailer')->send($message);

        return $this->render(':default:boutique.html.twig', [
            'jourDeMatch'=> $produitsJDM,
            'entrainement'=> $produitsEntrainement,
            'accessoires'=> $produitsAccessoires,
            'dirigeant'=> $produitsDirigeant,
            'licencies' =>$licencies
        ]);
    }
}