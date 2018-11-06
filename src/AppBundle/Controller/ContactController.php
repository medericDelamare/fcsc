<?php


namespace AppBundle\Controller;

use AppBundle\Form\ContactType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class ContactController extends Controller
{
    /**
     * @Route("/contact", name="contact")
     * @Template()
     */
    public function showAction(Request $request)
    {
        // Create the form according to the FormType created previously.
        // And give the proper parameters
        $form = $this->createForm(ContactType::class,null,[
            // To set the action use $this->generateUrl('route_identifier')
            'action' => $this->generateUrl('contact'),
            'method' => 'POST'
        ]);

        if ($request->isMethod('POST')) {
            // Refill the fields in case the form is not valid.
            $form->handleRequest($request);

            if($form->isValid()){
                // Send mail
                if($this->sendEmail($form->getData())){

                    // Everything OK, redirect to wherever you want ! :

                    return $this->redirectToRoute('contact');
                }else{
                    // An error ocurred, handle
                    var_dump("Errooooor :(");
                }
            }
        }

        return $this->render(':default:contact.html.twig', array(
            'form' => $form->createView()
        ));
    }

    private function sendEmail($data){
        $message = \Swift_Message::newInstance()
            ->setSubject('Mail Contact USCL')
            ->setFrom($data['email'])
            ->setTo('contact@uscl-foot.fr')
            ->setBody($data['message']);


        return $this->get('mailer')->send($message);
    }
}