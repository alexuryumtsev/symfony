<?php

namespace AppBundle\Security;

use AppBundle\Form\LoginFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;


class LoginFormAuthenticator extends AbstractFormLoginAuthenticator
{

    private $formFactory;

    private $router;

    private $entityManager;

    private $passwordEncoder;


    /**
     * LoginFormAuthenticator constructor.
     */
    public function __construct(FormFactoryInterface $formFactory, RouterInterface $router, EntityManagerInterface $entityManager, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->formFactory = $formFactory;
        $this->router = $router;
        $this->entityManager = $entityManager;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function getCredentials(Request $request)
    {
        $isLoginSubmit = $request->getPathInfo() == "/login" && $request->isMethod('POST');
        if(!$isLoginSubmit){
            return;
        }

        $form = $this->formFactory->create(LoginFormType::class);
        $form->handleRequest($request);
        $data = $form->getData();

        $request->getSession()->set(
            Security::LAST_USERNAME,
            $data['login']
        );

        return $data;
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
      $login = $credentials['login'];


      return $this->entityManager->getRepository('AppBundle:Users')
          ->findOneBy(['login'=>$login]);

    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        $password = $credentials['password'];

        if($this->passwordEncoder->isPasswordValid($user, $password)){
            return true;
        }
        return false;
    }

    protected function getLoginUrl()
    {
        return $this->router->generate('login_user');
    }

    protected function getDefaultSuccessRedirectUrl(){
        return $this->router->generate('log_user');
    }


}