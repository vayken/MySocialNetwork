<?php

namespace Acme\SocialNetworkBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserPageController extends Controller
{
    public function indexAction()
    {
        $response = 'NOT AUTHENTICATED';
        $securityContext = $this->container->get('security.context');
        if ($securityContext->isGranted('IS_AUTHENTICATED_FULLY')) {
            $response = 'IS_AUTHENTICATED_FULLY ';
        } else {
            return $this->redirect($this->generateUrl('login'));
        }
        return $this->render('AcmeSocialNetworkBundle:Default:user_page.html.twig', array('response' => $response));
    }
}
