<?php

namespace AniGrenoble\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use AniGrenoble\AppBundle\Entity\Annonce;
use AniGrenoble\AppBundle\Form\AnnonceType;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AniGrenobleAppBundle:Default:index.html.twig');
    }

    public function viewAction()
    {
        return $this->render('AniGrenobleAppBundle:Default:view.html.twig');
    }

    /**
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function addAction(Request $request)
    {
        // On crée un objet Annonce
        $annonce = new Annonce();

        // On crée le FormBuilder grâce au service form factory
        $form = $this->get('form.factory')->create(new AnnonceType, $annonce);

        // On fait le lien Requête <-> Formulaire
        // À partir de maintenant, la variable $annonce contient les valeurs entrées dans le formulaire par le visiteur
        $form->handleRequest($request);

        // On vérifie que les valeurs entrées sont correctes
        // (Nous verrons la validation des objets en détail dans le prochain chapitre)
        if ($form->isValid()) {
            // On l'enregistre notre objet $annonce dans la base de données, par exemple
            $em = $this->getDoctrine()->getManager();
            $em->persist($annonce);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

            // On redirige vers la page de visualisation de l'annonce nouvellement créée
            return $this->redirect($this->generateUrl('ani_grenoble_app_homepage'));
        }

        // À ce stade, le formulaire n'est pas valide car :
        // - Soit la requête est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire
        // - Soit la requête est de type POST, mais le formulaire contient des valeurs invalides, donc on l'affiche de nouveau
        return $this->render('AniGrenobleAppBundle:Default:add.html.twig', array(
          'form' => $form->createView(),
        ));
            
    }

    public function editAction()
    {
        $advert = $this->getDoctrine()
            ->getManager()
            ->getRepository('AniGrenobleAppBundle:Annonce')
            ->find($id)
        ;

        // On crée le FormBuilder grâce au service form factory
        $form = $this->get('form.factory')->createBuilder('form', $annonce)
            ->add('titre', 'text')
            ->add('contenu', 'textarea')
            ->add('auteur', 'text')
            ->add('date', 'datetime')
            ->add('publie', 'checkbox', array('required' => false))
            ->add('save', 'submit')
            ->getForm()
        ;

        // On fait le lien Requête <-> Formulaire
        // À partir de maintenant, la variable $advert contient les valeurs entrées dans le formulaire par le visiteur
        $form->handleRequest($request);

        // On vérifie que les valeurs entrées sont correctes
        // (Nous verrons la validation des objets en détail dans le prochain chapitre)
        if ($form->isValid()) {
            // On l'enregistre notre objet $advert dans la base de données, par exemple
            $em = $this->getDoctrine()->getManager();
            $em->persist($advert);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

            // On redirige vers la page de visualisation de l'annonce nouvellement créée
            return $this->redirect($this->generateUrl('oc_platform_view', array('id' => $advert->getId())));
        }

        // À ce stade, le formulaire n'est pas valide car :
        // - Soit la requête est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire
        // - Soit la requête est de type POST, mais le formulaire contient des valeurs invalides, donc on l'affiche de nouveau
        return $this->render('AniGrenobleAppBundle:Default:add.html.twig', array(
          'form' => $form->createView(),
        ));
    }

    public function deleteAction()
    {
        return $this->render('AniGrenobleAppBundle:Default:delete.html.twig');
    }
}
