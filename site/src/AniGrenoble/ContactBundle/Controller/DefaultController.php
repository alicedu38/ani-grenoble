<?php

namespace AniGrenoble\ContactBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DefaultController extends Controller
{
  public function contactAction(Request $request)
  {
    $form = $this->createFormBuilder()
        ->add('name', TextType::class, [
            'label' => 'Nom',
            'required' => false,
        ])
        ->add('email', EmailType::class, [
            'label' => 'Email *',
            'required'=> true
        ])
        ->add('title', TextType::class, [
            'label' => 'Sujet',
            'required' => false,
        ])
        ->add('message', TextareaType::class, [
            'label' => 'Message *',
            'required'=> true
        ])
        ->add('send', SubmitType::class, [
            'label' => 'Envoyer',
            'attr' => [
                'class' => 'btn btn-primary'
            ]
        ])
        ->getForm();

    $form->handleRequest($request);

    //Si le formulaire de contact est valide alors envoie du mail
    if ($form->isSubmitted() && $form->isValid()) {
        $message = \Swift_Message::newInstance()
        ->setFrom('send@example.com')
        ->setSubject('Mail du site ANI Grenoble')
        ->setTo($this->container->getParameter('blogger_blog.emails.contact_email'))
        ->setBody(
            $this->renderView(
                // app/Resources/views/Emails/registration.html.twig
                'AniGrenobleContactBundle:Default:contactEmail.txt.twig',
                array(
                    'name' => $form->get('name')->getData(),
                    'email' => $form->get('email')->getData(),
                    'title' => $form->get('title')->getData(),
                    'message' => $form->get('message')->getData(),
                )
            )
        );

        $this->get('mailer')->send($message);
        $request->getSession()->getFlashBag()->add('notice green accent-2', 'Message envoyé avec succès ! Merci.');

        return $this->redirect($this->generateUrl('ani_grenoble_contact_contact'));
    }


    return $this->render('AniGrenobleContactBundle:Default:contact.html.twig', array(
      'form' => $form->createView()
    ));
  }
}
