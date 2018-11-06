<?php


namespace AppBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Console\Application;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Process\Process;
use Symfony\Component\Routing\Annotation\Route;

class ImportAdminController extends Controller
{
    /**
     * @Route("/add", name="add-import")
     */
    public function addAction(){

        /** @var Kernel $kernel */
        $kernel = $this->container->get( 'kernel' );
        $dir = $kernel->getRootDir() . '\Resources\Infos_Footclub';
        if(!is_dir($dir)){
            mkdir($kernel->getRootDir() . '\Resources\Infos_Footclub');
        }
        $request = $this->getRequest();
        /** @var Form $form */
        $form = $this->createFormBuilder()
            ->add('file', FileType::class)
            ->add('Envoyer', SubmitType::class)
            ->getForm();
        $form->handleRequest($request);

        $finder = new Finder();
        $files = $finder->in($dir)->files()->name('*.csv')->sort(function ($a, $b) { return strcmp($b->getRealpath(), $a->getRealpath()); });

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $file */
            $file = $form['file']->getData();
            if ($file->getClientOriginalExtension() == 'csv'){
                $name = $file->getClientOriginalName();
                if (file_exists($dir . '/' . $name)){
                    $this->addFlash('sonata_flash_error', 'Le fichier existe déjà dans le repertoire');
                    return $this->redirect($request->getRequestUri());
                }
                $file->move($dir, $name);

            }
            else{
                $this->addFlash('sonata_flash_error', 'Le format du fichier choisi n\'est pas du type CSV');
                return $this->redirect($request->getRequestUri());
            }
        }
        return $this->render('@SonataAdmin/Import/import.html.twig', [
            'files' => $files,
            'form'=> $form->createView(),
        ]);
    }

    public function importJoueursAction(Request $request){
        $fileName = $request->get('fileName');
        $process = new Process('php ../bin/console import:footclub:csv --fileName="'.$fileName.'"');
        $process->run();

        $this->addFlash('sonata_flash_success', 'Import en cours');
        return $this->redirectToRoute('sonata_admin_dashboard');
    }
}