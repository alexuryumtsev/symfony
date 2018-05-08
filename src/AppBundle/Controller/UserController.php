<?php

namespace AppBundle\Controller;
use AppBundle\Entity\Users;
use AppBundle\Form\RegFormType;
use AppBundle\Form\EditFormType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserController extends Controller
{

    /**
     * @Route("/register", name="users_register")
     */
    public function registrationAction(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $em)
    {
        $form = $this->createForm(RegFormType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var Users $user */


            $user = $form->getData();

           //  var_dump($user);die;

            $em = $this->getDoctrine()->getManager();
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            $em->persist($user);
            $em->flush();

            $this->addFlash('success','Create new user!');

            return $this->redirectToRoute('users_register');
        }

        return $this->render('user/reg.html.twig', [
            'regForm' => $form->createView()
        ]);
    }


    /**
     * @Route("admin/user/{id}/edit", name="user_edit")
     */
    public function editAction(Request $request, Users $users, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $em)
    {
        $form = $this->createForm(EditFormType::class, $users);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var Users $user */


            $user = $form->getData();

            //  var_dump($user);die;

            $em = $this->getDoctrine()->getManager();
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            $em->persist($user);
            $em->flush();

            $this->addFlash('success','Update user!');

            return $this->redirectToRoute('users_list');
        }

        return $this->render('user/edit.html.twig', [
            'editForm' => $form->createView()
        ]);
    }


    /**
     * @Route("admin/user", name="users_list")
     */
    public function listAction(){
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle\Entity\Users')
            ->findAll();
        return $this->render('user/list.html.twig',[
            'users'=>$user,

        ]);
    }

    /**
     * @Route("admin/user/{id}/delete", name="users_delete")
     */
    public function deleteAction($id){

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle\Entity\Users')
            ->find($id);
      // var_dump($user); die;
        $em->remove($user);
        $em->flush();
        $this->addFlash('success','Delete user!');
        return $this->redirectToRoute('users_list');
    }

}