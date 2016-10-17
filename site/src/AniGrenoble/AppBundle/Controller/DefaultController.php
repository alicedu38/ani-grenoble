<?php

namespace AniGrenoble\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

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
    public function addAction()
    {
        return $this->render('AniGrenobleAppBundle:Default:add.html.twig');
    }

    public function editAction()
    {
        return $this->render('AniGrenobleAppBundle:Default:edit.html.twig');
    }

    public function deleteAction()
    {
        return $this->render('AniGrenobleAppBundle:Default:delete.html.twig');
    }
}
