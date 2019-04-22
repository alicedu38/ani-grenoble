<?php

namespace AniGrenoble\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AniGrenoble\AppBundle\Entity\Image;
use AniGrenoble\AppBundle\Form\ImageType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

class ImageController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $images = $em->getRepository('AniGrenobleAppBundle:Image')->findAll();

        return $this->render('AniGrenobleAdminBundle:Image:index.html.twig', array(
            'images' => $images
        ));
    }

    /**
    * @Security("has_role('ROLE_ADMIN')")
    */
    public function addAction(Request $request)
    {
        $image = new Image();

        $form = $this->createForm(ImageType::class, $image);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($image);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice green accent-2', 'Image bien ajoutée.');

            return $this->redirect($this->generateUrl('ani_grenoble_app_homepage'));
        }

        return $this->render('AniGrenobleAdminBundle:Image:add.html.twig', array(
            'form' => $form->createView(),
        ));

    }

    public function editAction($id, Request $request)
    {
        $image = $this->getDoctrine()
        ->getManager()
        ->getRepository('AniGrenobleAppBundle:Image')
        ->find($id)
        ;

        if ($image === null) {
            throw new NotFoundHttpException("L'image d'id ".$id." n'existe pas.");
        }

        $form = $this->get('form.factory')->create(new ImageType, $image);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($image);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice green accent-2', 'Image bien enregistrée.');

            return $this->redirect($this->generateUrl('ani_grenoble_app_homepage'));
        }

        return $this->render('AniGrenobleAdminBundle:Image:edite.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function deleteAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $image = $em->getRepository('AniGrenobleAppBundle:Image')->find($id);

        if ($image === null) {
            throw new NotFoundHttpException("L'image d'id ".$id." n'existe pas.");
        }

        $form = $this->createFormBuilder()->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->remove($image);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice green accent-2', 'Image bien supprimée.');

            return $this->redirect($this->generateUrl('ani_grenoble_app_homepage', array('page' => "1")));
        }

        return $this->render('AniGrenobleAdminBundle:Image:delete.html.twig', array(
            'id' => $id,
            'image' => $image,
            'form'   => $form->createView()
        ));
    }
}
