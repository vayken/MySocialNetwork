<?php

namespace Acme\SocialNetworkBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DisconnectController extends Controller
{
    public function indexAction()
    {
        //this patches the remember me problem
        // Logging user out.
        $this->get('security.token_storage')->setToken(null);

        // Invalidating the session.
        $session = $this->get('request')->getSession();
        $session->invalidate();

        // Redirecting user to login page in the end.
        $response = $this->redirect($this->generateUrl('login'));

        // Clearing the cookies.
        $cookieNames = [
            $this->container->getParameter('session.name'),
            $this->container->getParameter('session.remember_me.name'),
        ];
        foreach ($cookieNames as $cookieName) {
            $response->headers->clearCookie($cookieName);
        }

        return $response;

    }
}
