<?php

namespace CirTuSofiaBundle\Controller;

use CirTuSofiaBundle\Entity\RequestHall;
use CirTuSofiaBundle\Entity\Role;
use CirTuSofiaBundle\Entity\User;
use CirTuSofiaBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends Controller
{

    /**
     * @Route("/register", name="register_user")
     * @param Request $request
     * @return Response
     */
    public function registerUser(Request $request)
    {
        $user = new User();

        $errors = null;

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $validator = $this->get('validator');

            $errors = $validator->validate($user);

            $emailForm = $form->getData()->getUsername();

            $userNew = $this
                ->getDoctrine()
                ->getRepository(User::class)
                ->findOneBy(['email'=>$emailForm]);

            if (null !== $userNew) {

                $this->addFlash('message','Има регистриран потребител с '. $emailForm);

                return $this->render('user/register.html.twig',['errors' =>$errors]);
            }

            if(count($errors)>0){

                return $this->render('user/register.html.twig', ['errors' =>$errors]);

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

            $user->setStatus($form->getData()->getStatus());

            $em = $this->getDoctrine()->getManager();

            $em->persist($user);

            $em->flush();

            return $this->redirectToRoute('security_login');
        }

        return $this->render('user/register.html.twig',['errors'=>$errors]);
    }


    /**
     * @Route("/user/view/{id}", name="view_user")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')" )
     * @param integer $id
     * @return Response
     */
    public function viewUser($id)
    {
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);
        return $this->render('user/view.html.twig',['user'=>$user]);
    }


    /**
     * @Route("/user/create", name="create_user")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')" )
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createUser(Request $request)
    {
        $user = new User();

        $roles = $this
            ->getDoctrine()
            ->getRepository(Role::class)
            ->findAll();

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $emailForm = $form->getData()->getUsername();

            $userNew = $this
                ->getDoctrine()
                ->getRepository(User::class)
                ->findOneBy(['email'=>$emailForm]);


            if (null !== $userNew) {

                $this->addFlash('message','Има регистриран потребител с '. $emailForm);

                return $this->render('user/create.html.twig',['roles'=>$roles]);
            }

            $password = $this
                ->get('security.password_encoder')
                ->encodePassword($user, $user->getPassword());

            $user->setPassword($password);

            $user->setEmail($emailForm);

            $user->setStatus($form->getData()->getStatus());

            $userRole = $this
                ->getDoctrine()
                ->getRepository(Role::class)
                ->findOneBy(['id'=>$form->get('roles')->getData()]);

            $user->addRole($userRole);

            $em = $this->getDoctrine()->getManager();

            $em->persist($user);

            $em->flush();

            return $this->redirectToRoute('all_user');
        }
        return $this->render('user/create.html.twig',
            array(
                'form' => $form->createView(),
                'roles' => $roles
            ));
    }


    /**
     * @Route("/user/edit/{id}", name="edit_user")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')" )
     * @param integer $id
     * @param Request $request
     * @return Response
     */
    public function editUser($id, Request $request)
    {
        $roles = $this
            ->getDoctrine()
            ->getRepository(Role::class)
            ->findAll();

        $user = $this
            ->getDoctrine()
            ->getRepository(User::class)
            ->find($id);

        $users = $this
            ->getDoctrine()
            ->getRepository(User::class)
            ->findAll();


        $userRole = $this
            ->getDoctrine()
            ->getRepository(Role::class)
            ->findOneBy(['name'=>$user->getRoles()[0]]);

        $userEmail = $user->getEmail();

        $userPassword = $user->getPassword();

        if ($user === null) {
            return $this->redirectToRoute('cir_index');
        }

        $currentUser = $this->getUser();

        if (!$currentUser->isAdmin() && !($currentUser->getId() === $user->getId())) {
            return $this->redirectToRoute('cir_index');
        }

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            if (empty($form->getData()->getFullName())) {

                $user->setEmail($userEmail);

                $this->addFlash('message', "Полето 'Име' не може да бъде празно.");

                if (empty($form->getData()->getPassword())) {

                    $user->setPassword($userPassword);

                } else {

                    $passForm = $this
                        ->get('security.password_encoder')
                        ->encodePassword($user, $form->getData()->getPassword());

                    $user->setPassword($passForm);

                }
                $em = $this->getDoctrine()->getManager();

                $em->merge($user);

                $em->flush();

                return $this->render('user/edit.html.twig',
                    array(
                        'form' => $form->createView(),
                        'user' => $user,
                        'roles' => $roles,
                        'userRole'=>$userRole
                    )
                );

            } else {
                if (empty($form->getData()->getPassword())) {

                    $user->setPassword($userPassword);


                } else {

                    $passForm = $this
                        ->get('security.password_encoder')
                        ->encodePassword($user, $form->getData()->getPassword());

                    $user->setPassword($passForm);

                }
                $userRoleForm = $this
                    ->getDoctrine()
                    ->getRepository(Role::class)
                    ->findOneBy(['id'=>$form->get('roles')->getData()]);

                if ($form->get('roles')->getData() !== null && $userRole !== $userRoleForm ) {

                    $user->removeRole($userRole);

                    $user->addRole($userRoleForm);
                }

                $user->setEmail($userEmail);

                $em = $this->getDoctrine()->getManager();

                $em->merge($user);

                $em->flush();

                if ($currentUser->isAdmin()){

                    return $this->redirectToRoute('all_user', array(
                        'user' => $user,
                        'roles' => $roles,
                        'userRole'=>$userRole
                    ));

                }

                return $this->redirectToRoute('cir_index');
            }

        }

        return $this->render('user/edit.html.twig',
            array(
                'form' => $form->createView(),
                'user' => $user,
                'roles' => $roles,
                'userRole'=>$userRole
            )
        );
    }


    /**
     * @Route("/user/delete/{id}", name="delete_user")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')" )
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteUser($id, Request $request)
    {
        $user = $this
            ->getDoctrine()
            ->getRepository(User::class)
            ->find($id);

        $requests = $this
            ->getDoctrine()
            ->getRepository(RequestHall::class)
            ->findBy(['requesterId'=> $user->getId()]);

        $requesterCount = $this
            ->getDoctrine()
            ->getRepository(RequestHall::class)
            ->countRequestsById($user->getId());

//        Forward all requests of user to admin

        $roles = $this
            ->getDoctrine()
            ->getRepository(Role::class)
            ->findAll();

        $userRole = $this
            ->getDoctrine()
            ->getRepository(Role::class)
            ->findOneBy(['name'=>$user->getRoles()[0]]);

        $userEmail = $user->getEmail();

        $userPassword = $user->getPassword();

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            if ( intval($requesterCount) !== 0 ) {

                $user->setEmail($userEmail);

                if (empty($form->getData()->getPassword())) {

                    $user->setPassword($userPassword);

                } else {

                    $passForm = $this
                        ->get('security.password_encoder')
                        ->encodePassword($user, $form->getData()->getPassword());

                    $user->setPassword($passForm);

                }
                $this->addFlash('message','Този потребител има '. intval($requesterCount) . " заявки. Моля първо пренасочете заявките.");
                return $this->render('user/delete.html.twig',array(
                    'form'=>$form->createView(),
                    'user'=>$user,
                    'requests'=>$requests,
                    'count'=>$requesterCount,
                    'roles' => $roles,
                    'userRole'=>$userRole
                ));
            }

            $em = $this->getDoctrine()->getManager();

            $em->remove($user);

            $em->flush();

            return $this->redirectToRoute('all_user');

        }

        return $this->render('user/delete.html.twig',array(
            'form'=>$form->createView(),
            'user'=>$user,
            'requests'=>$requests,
            'count'=>$requesterCount,
            'roles' => $roles,
            'userRole'=>$userRole
        ));
    }


    /**
     * @Route("/user/all", name="all_user")
     * @return Response
     */
    public function allUsers()
    {
        $users = $this
            ->getDoctrine()
            ->getRepository(User::class)
            ->findAll();

        return $this->render('user/users.html.twig',['users'=>$users]);
    }

}
