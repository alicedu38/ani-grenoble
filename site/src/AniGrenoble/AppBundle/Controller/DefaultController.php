<?php

namespace AniGrenoble\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use AniGrenoble\AppBundle\Entity\Annonce;
use AniGrenoble\AppBundle\Form\AnnonceType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DefaultController extends Controller
{
    public function indexAction()
    {
        // Pour récupérer touts les Annonce : on utilise getAnnonce()
        $listeAnnoncesEvenement = $this->getDoctrine()
            ->getManager()
            ->getRepository('AniGrenobleAppBundle:Annonce')
            ->getAnnonceWithCategories(array('Evenement'));

        $listeAnnoncesReunionHebdomadaire = $this->getDoctrine()
            ->getManager()
            ->getRepository('AniGrenobleAppBundle:Annonce')
            ->getAnnonceWithCategories(array('Reunion_hebdomadaire'));

        return $this->render('AniGrenobleAppBundle:Default:index.html.twig', array(
            'listeAnnoncesEvenement' => $listeAnnoncesEvenement,
            'listeAnnoncesReunionHebdomadaire' => $listeAnnoncesReunionHebdomadaire,
            ));
    }

    public function a_proposAction()
    {
        return $this->render('AniGrenobleAppBundle:Default:a_propos.html.twig');
    }

    /*public function viewAction()
    {
        return $this->render('AniGrenobleAppBundle:Default:view.html.twig');
    }*/

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

    public function editAction($id, Request $request)
    {
        $annonce = $this->getDoctrine()
            ->getManager()
            ->getRepository('AniGrenobleAppBundle:Annonce')
            ->find($id)
        ;

        // Si l'article n'existe pas, on affiche une erreur 404
        if ($annonce === null) {
            throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
        }

        // On crée le FormBuilder grâce au service form factory et avec les données récupérées dans la base de données
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

            // On redirige vers la page d'accueil'
            return $this->redirect($this->generateUrl('ani_grenoble_app_homepage'));
        }

        // À ce stade, le formulaire n'est pas valide car :
        // - Soit la requête est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire
        // - Soit la requête est de type POST, mais le formulaire contient des valeurs invalides, donc on l'affiche de nouveau
        return $this->render('AniGrenobleAppBundle:Default:edit.html.twig', array(
          'form' => $form->createView(),
        ));
    }

    public function deleteAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $annonce = $em->getRepository('AniGrenobleAppBundle:Annonce')->find($id);

        // Si l'annonce n'existe pas, on affiche une erreur 404
        if ($annonce === null) {
            throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
        }

        // On crée un formulaire vide, qui ne contiendra que le champ CSRF
        // Cela permet de protéger la suppression d'annonce contre cette faille
        $form = $this->createFormBuilder()->getForm();

        // On fait le lien Requête <-> Formulaire
        // À partir de maintenant, la variable $annonce contient les valeurs entrées dans le formulaire par le visiteur
        $form->handleRequest($request);

        if ($form->isValid()) {
            // Si la requête est en POST, on deletea l'annonce
            $em->remove($annonce);
            $em->flush();

            $request->getSession()->getFlashBag()->add('info', 'Article bien supprimée.');

            // Puis on redirige vers l'accueil
            return $this->redirect($this->generateUrl('ani_grenoble_app_homepage', array('page' => "1")));
        }

        // Si la requête est en GET, on affiche une page de confirmation avant de delete
        return $this->render('AniGrenobleAppBundle:Default:delete.html.twig', array(
            'id' => $id,
            'annonce' => $annonce,
            'form'   => $form->createView()
        ));
    }
}
