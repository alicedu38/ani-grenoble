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

    public function aProposAction()
    {
        return $this->render('AniGrenobleAppBundle:Default:aPropos.html.twig');
    }

    public function photosAction()
    {
        $photos = $this->getDoctrine()
        ->getManager()
        ->getRepository('AniGrenobleAppBundle:Image')
        ->getPhotos(array('Evenement'));

        return $this->render('AniGrenobleAppBundle:Default:photos.html.twig', array(
            'photos' => $photos
        ));
    }
}
