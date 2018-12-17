<?php

namespace CirTuSofiaBundle\Controller;

use CirTuSofiaBundle\Entity\Hall;
use CirTuSofiaBundle\Entity\RequestHall;
use CirTuSofiaBundle\Form\RequestHallType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RequestHallController extends Controller
{
    /**
     * @Route("/requestHall/create", name="requestHall_create")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')" )
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {
        $halls = $this->getDoctrine()->getRepository(Hall::class)->findAll();

        $requestHall = new RequestHall();

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
                    ->find(intval($form->getExtraData()['hallId']));

                $requestHall->setHallId($currentHall->getId());

                $requestHall->setHall($currentHall);

                $em = $this->getDoctrine()->getManager();

                $em->persist($requestHall);

                $em->flush();

                return $this->redirectToRoute('requestHall_all');
            }

        }

        return $this->render('request/create.html.twig', array('form' => $form->createView(), 'halls'=> $halls));
    }

    /**
     * @Route("/requestHall/edit/{id}", name="requestHall_edit")
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
                    ->find(intval($form->getExtraData()['hallId']));

                $requestHall->setHallId($currentHall->getId());

                $requestHall->setHall($currentHall);

                $em = $this->getDoctrine()->getManager();

                $em->merge($requestHall);

                $em->flush();

                return $this->redirectToRoute('requestHall_all');
            }

        }

        return $this->render('request/edit.html.twig', array('form' => $form->createView(), 'requestHall'=>$requestHall,'halls'=> $halls));




    }

    /**
     * @Route("/requestHall/all", name="requestHall_all")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')" )
     */
    public function allRequestHalls()
    {
        $requests = $this->getDoctrine()->getRepository(RequestHall::class)->findAll();

        return $this->render('request/requests.html.twig',['requests'=>$requests]);
    }

}
