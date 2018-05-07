<?php

namespace AppBundle\Controller;


use AppBundle\Form\LoginFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login_user")
     */

    public function loginAction(Request $request){

        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $login = $authenticationUtils->getLastUsername();

        $form = $this->createForm(LoginFormType::class,[
            'login' => $login,

        ]);

        return $this->render('user/login.html.twig', array(
           'form' => $form->createView(),
            'error'         => $error,
        ));

    }

    /**
     * @Route("/logout", name="logout_user")
     */
    public function logoutAction()
    {
        return $this->render('main/home.html.twig');
    }
}