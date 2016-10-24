<?php

namespace AniGrenoble\ContactBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AniGrenoble\ContactBundle\Entity\Enquiry;
use AniGrenoble\ContactBundle\Form\EnquiryType;

class DefaultController extends Controller
{
    public function contactAction(Request $request)
    {
    	$enquiry = new Enquiry();
	    $form = $this->createForm(new EnquiryType(), $enquiry);

	    $request = $this->getRequest();
	    if ($request->getMethod() == 'POST') {
	        $form->handleRequest($request);

	        if ($form->isValid()) {
	             $message = \Swift_Message::newInstance()
		            ->setSubject('Mail du site ANI Grenoble')
		            ->setFrom('send@hotmail.fr')
		            ->setTo($this->container->getParameter('blogger_blog.emails.contact_email'))
		            ->setBody($this->renderView('AniGrenobleContactBundle:Default:contactEmail.txt.twig', array('enquiry' => $enquiry)));
		        $this->get('mailer')->send($message);

	        //$this->get('session')->setFlash('blogger-notice', 'Your contact enquiry was successfully sent. Thank you!');

	        // Redirect - This is important to prevent users re-posting
	        // the form if they refresh the page
	            return $this->redirect($this->generateUrl('ani_grenoble_contact_contact'));
	        }
	    }

	    return $this->render('AniGrenobleContactBundle:Default:contact.html.twig', array(
	        'form' => $form->createView()
	    ));
    }
}
