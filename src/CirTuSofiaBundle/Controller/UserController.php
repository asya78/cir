<?php

namespace CirTuSofiaBundle\Controller;

use CirTuSofiaBundle\Entity\Role;
use CirTuSofiaBundle\Entity\User;
use CirTuSofiaBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends Controller
{

    /**
     * @Route("/register", name="user_register")
     * $param RequestHall $request
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function registerAction(Request $request)
    {
        $user = new User();

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $emailForm = $form->getData()->getEmail();

            $user = $this
                ->getDoctrine()
                ->getRepository(User::class)
                ->findBy(['email'=> $emailForm]);

            if (null !== $user) {

                $this->addFlash('message','Username with email '. $emailForm.'is already taken.');

                return $this->render('user/register.html.twig');

            }

            $password = $this
                ->get('security.password_encoder')
                ->encodePassword($user, $user->getPassword());

            $user->setPassword($password);

            $userRole = $this
                ->getDoctrine()
                ->getRepository(Role::class)
                ->findOneBy(['name'=>'ROLE_USER']);

            $user->addRole($userRole);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('security_login');

        }

        return $this->render('user/register.html.twig');
    }

    /**
     * @Route("/profile", name="user_profile")
     */
    public function profile()
    {
        $userId = $this->getUser()->getId();

        $user = $this->getDoctrine()->getRepository(User::class)->find($userId);

        return $this->render('user/profile.html.twig',['user'=>$user]);

    }

    /**
     * @Route("/allUsers", name="user_all")
     */
    public function allUsers()
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        return $this->render('user/allUsers.html.twig',['users'=>$users]);
    }

}
