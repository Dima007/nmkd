<?php

namespace Nmkd\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->redirect($this->generateUrl('login'));
    }

    public function adminAction()
    {
        return $this->redirect($this->generateUrl('admin_homepage'));
    }

    public function loginAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)){
            $error = $request->attributes->get(
                SecurityContext::AUTHENTICATION_ERROR
            );
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render(
            'NmkdMainBundle:Secured:login.html.twig',
            array(
                // last username entered by the user
                'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                'error' => $error,
            )
        );
    }

    public function logoutAction()
    {
        // The security layer will intercept this request
        return $this->render(
            'NmkdMainBundle:Secured:login.html.twig'
        );
    }

    public function homeAction()
    {
        return $this->render(
            'NmkdMainBundle:Default:homepage.html.twig'
        );
    }

}
