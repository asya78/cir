<?php

namespace CirTuSofiaBundle\Controller;

use CirTuSofiaBundle\Entity\Hall;
use CirTuSofiaBundle\Entity\RequestHall;
use CirTuSofiaBundle\Entity\User;
use CirTuSofiaBundle\Form\RequestHallType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RequestHallController extends Controller
{
    /**
     * @Route("/requestHall/create", name="create_requestHall")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')" )
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {
        $halls = $this->getDoctrine()->getRepository(Hall::class)->findAll();

        if (!is_null($request->query->get('id'))) {

        $hall = $this->getDoctrine()->getRepository(Hall::class)->find($request->query->get('id'));

        } else {

            $hall = new Hall();

        }

        $requestHall = new RequestHall();

        $form = $this->createForm(RequestHallType::class, $requestHall);

        if ($request->isMethod('POST')) {

            $form->submit($request->request->all());

            if ($form->isSubmitted()) {

                $requestHall = $form->getData();

                $currentUser = $this->getUser();

                $requestHall->setRequester($currentUser);

                $requestHall->setRequesterId($currentUser->getId());

                if (!is_null($request->query->get('id'))) {
                    $currentHall = $this->getDoctrine()->getRepository(Hall::class)->find($request->query->get('id'));
                    $requestHall->setHallId($currentHall->getId());
                } else {
                    $currentHall = $this->getDoctrine()->getRepository(Hall::class)->find($requestHall->getHallId());
                }

                $requestHall->setHall($currentHall);

                $nowDate = new \DateTime();

                $requestDate = $requestHall->getDate();

                if ($requestDate < $nowDate) {
                    $this->addFlash('message','Датата, която въведохте е минала.');
                    return $this->render('request/create.html.twig',array(
                            'form' => $form->createView(),
                            'halls'=> $halls,
                            'hall'=>  $hall)
                    );
                }

                $em = $this->getDoctrine()->getManager();

                $em->persist($requestHall);

                $em->flush();

                return $this->redirectToRoute('all_requestHall');
            }

        }

        return $this->render('request/create.html.twig', array(
            'form' => $form->createView(),
            'halls'=> $halls,
            'hall'=>  $hall)
        );
    }

    /**
     * @Route("/requestHall/view/{id}", name="view_requestHall")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')" )
     * @param $id
     * @return  \Symfony\Component\HttpFoundation\Response
     */
    public function viewRequestHall($id)
    {
        $requestHall = $this
            ->getDoctrine()
            ->getRepository(RequestHall::class)
            ->find($id);

        $hall = $this
            ->getDoctrine()
            ->getRepository(Hall::class)
            ->find($requestHall->getHallId());

        return $this->render('request/view.html.twig',array(
            'requestHall'=>$requestHall,
            'hall'=>$hall)
        );
    }

    /**
     * @Route("/requestHall/edit/{id}", name="edit_requestHall")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')" )
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editRequestHall($id, Request $request)
    {
        $requestHall = $this
            ->getDoctrine()
            ->getRepository(RequestHall::class)
            ->find($id);

        if ($requestHall === null) {

            return $this->redirectToRoute('cir_index');
        }

        $halls = $this->getDoctrine()->getRepository(Hall::class)->findAll();

        $form = $this->createForm(RequestHallType::class, $requestHall);

        if ($request->isMethod('POST')) {

            $form->submit($request->request->all());

            if ($form->isSubmitted()) {

                $currentUser = $this->getUser();

                $requestHall->setRequester($currentUser);

                $requestHall->setRequesterId($currentUser->getId());

                $currentHall = $this
                    ->getDoctrine()
                    ->getRepository(Hall::class)
                    ->find($requestHall->getHallId());

                $requestHall->setHallId($currentHall->getId());

                $requestHall->setHall($currentHall);

                $em = $this->getDoctrine()->getManager();

                $em->merge($requestHall);

                $em->flush();

                return $this->redirectToRoute('all_requestHall');
            }

        }

        return $this->render('request/edit.html.twig', array(
            'form' => $form->createView(),
            'requestHall'=>$requestHall,
            'halls'=> $halls)
        );

    }

    /**
     * @Route("/requestHall/delete/{id}", name="delete_requestHall")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')" )
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteRequestHall($id, Request $request)
    {
        $requestHall = $this
            ->getDoctrine()
            ->getRepository(RequestHall::class)
            ->find($id);

        if ($requestHall === null) {

            return $this->redirectToRoute('cir_index');
        }

        $halls = $this->getDoctrine()->getRepository(Hall::class)->findAll();

        $form = $this->createForm(RequestHallType::class, $requestHall);

        if ($request->isMethod('POST')) {

            $form->submit($request->request->all());

            if ($form->isSubmitted()) {

                $currentUser = $this->getUser();

                $requestHall->setRequester($currentUser);

                $requestHall->setRequesterId($currentUser->getId());

                $em = $this->getDoctrine()->getManager();

                $em->remove($requestHall);

                $em->flush();

                return $this->redirectToRoute('all_requestHall');
            }

        }

        return $this->render('request/delete.html.twig', array(
            'form' => $form->createView(),
            'requestHall'=>$requestHall,
            'halls'=> $halls)
        );

    }

    /**
     * @Route("/requestHall/forwarding/{id}", name="forwarding_requestHall")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')" )
     * @param $id
     * @return  \Symfony\Component\HttpFoundation\Response
     */
    public function forwardingRequestHall($id)
    {
        $requestHall = $this
            ->getDoctrine()
            ->getRepository(RequestHall::class)
            ->find($id);

        $requesterId = $requestHall->getRequester()->getId();

        $userAdmin = $this
            ->getDoctrine()
            ->getRepository(User::class)
            ->find('1');

        $requestHall->setRequester($userAdmin);

        $em = $this->getDoctrine()->getManager();

        $em->persist($requestHall);

        $em->flush();

        return $this->redirectToRoute('delete_user',array('id'=> $requesterId));


    }

    /**
     * @Route("/requestHall/all", name="all_requestHall")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')" )
     */
    public function allRequestHalls()
    {
        $requests = $this->getDoctrine()->getRepository(RequestHall::class)->findAll();

        return $this->render('request/requests.html.twig',array('requests'=>$requests));
    }

}
