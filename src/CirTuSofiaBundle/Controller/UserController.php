<?php

namespace CirTuSofiaBundle\Controller;

use CirTuSofiaBundle\Entity\Role;
use CirTuSofiaBundle\Entity\User;
use CirTuSofiaBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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

            $emailForm = $form->getData()->getUsername();

            $userNew = $this
                ->getDoctrine()
                ->getRepository(User::class)
                ->findOneBy(['email'=>$emailForm]);

            if (null !== $userNew) {

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
     * @Route("/profile/view/{id}", name="view_profile")
     * @param integer $id
     * @return Response
     */
    public function profile($id)
    {
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);

        return $this->render('user/profile.html.twig',['user'=>$user]);

    }

    /**
     * @Route("/profile/edit/{id}", name="edit_profile")
     * @param integer $id
     * @return Response
     */
    public function editProfile($id)
    {
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);

        return $this->render('user/profileEdit.html.twig',['user'=>$user]);
    }



    /**
     * @Route("/allUsers", name="user_all")
     */
    public function allUser()
    {
        $users = $this
            ->getDoctrine()
            ->getRepository(User::class)
            ->findAll();

        return $this->render('user/allUsers.html.twig',['users'=>$users]);
    }

}
