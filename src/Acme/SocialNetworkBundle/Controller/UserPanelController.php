<?php

namespace Acme\SocialNetworkBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserPanelController extends Controller
{
    public function indexAction()
    {
        return $this->render('AcmeSocialNetworkBundle:Default:user_panel.html.twig');
    }
}
