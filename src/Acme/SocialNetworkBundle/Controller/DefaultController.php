<?php

namespace Acme\SocialNetworkBundle\Controller;

use Acme\SocialNetworkBundle\Entity\EmailConfirm;
use Acme\SocialNetworkBundle\Entity\User;
use Acme\SocialNetworkBundle\Form\Type\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        //login
            $session = $request->getSession();
            // get the login error if there is one
            if ($request->attributes->has(Security::AUTHENTICATION_ERROR)) {
                $error = $request->attributes->get(Security::AUTHENTICATION_ERROR);
            } else {
                $error = $session->get(Security::AUTHENTICATION_ERROR);
                $session->remove(Security::AUTHENTICATION_ERROR);
            }
        //end of login

        //if user is logged in
        $securityContext = $this->container->get('security.context');
        if ($securityContext->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirect($this->generateUrl('acme_social_network_user_page'));
        }

        $user = new User();

        $form = $this->createForm(new UserType(), $user);

        $form->handleRequest($request);


        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            if($user->getMobile() == null)
                $user->setMobile('unset');

            //encrypting the passwordS
            $factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($user);
            $password = $encoder->encodePassword($user->getPassword(), $user->getSalt());
            $user->setPassword($password);

            //registration date
            $user->setRegistrationDate(new \DateTime());

            //email confirmation encryption
            $unique_id = uniqid();
            $final_id = md5($unique_id) . crypt($unique_id);
            //eventual slashes
            $final_id = str_replace("/", "", $final_id);
            $emailConfirm = new EmailConfirm();
            $emailConfirm->setUniqueId($final_id);
            $emailConfirm->setUser($user);
            $emailConfirm->setType('registration');

            $em->persist($user);
            $em->persist($emailConfirm);
            $em->flush();
            echo '<br/> user persisted <br/>';
        }
        return $this->render('AcmeSocialNetworkBundle:Default:index.html.twig', array(
            'form' => $form->createView(),
            // last username entered by the user
            'last_username' => $session->get(Security::LAST_USERNAME),
            'error' => $error,
        ));
    }
}
