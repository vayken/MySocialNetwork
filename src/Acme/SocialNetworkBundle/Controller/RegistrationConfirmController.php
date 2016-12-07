<?php

namespace Acme\SocialNetworkBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class RegistrationConfirmController extends Controller
{
    public function indexAction($uniqueId)
    {

        //todo email confirm leads to there
        $em = $this->getDoctrine()->getManager();
        $email_confirm = $em->getRepository('AcmeSocialNetworkBundle:EmailConfirm')
            ->findOneBy(array('uniqueId' => $uniqueId, 'type' => 'recovery'));
        $response = "";
        if($email_confirm){
            $email_confirm->getUser()->setRegistrationConfirmed(true);
            $email_confirm->getUser()->removeEmailConfirm($email_confirm);
            $em->persist($email_confirm->getUser());
            $em->remove($email_confirm);
            $response .= "Registration confirmed";
            $em->flush();
        } else {
            $response .= "couldn't find object email confirm, either you have already registered or the email confirmation link is wrong";
        }
        return $this->render('AcmeSocialNetworkBundle:Default:email_confirm.html.twig', array('response' => $response));
    }
}
