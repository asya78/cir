<?php

namespace CirTuSofiaBundle\Controller;

use CirTuSofiaBundle\Entity\Hall;
use CirTuSofiaBundle\Entity\RequestHall;
use CirTuSofiaBundle\Form\RequestHallType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
//
//            dump($form->isValid());
//            exit;

            if ($form->isSubmitted()) {

                $timeStart = $form->getExtraData()['request']['timeStart'];

                $requestHall->setTimeStart($timeStart);

                $timeEnd = $form->getExtraData()['request']['timeEnd'];

                $requestHall->setTimeEnd($timeEnd);

                            dump($requestHall);
            exit;

                $requestHall->setDescription($form->getExtraData()['request']['description']);

                $currentUser = $this->getUser();

                $requestHall->setRequester($currentUser);

                $requestHall->setRequesterId($currentUser);

                $em = $this->getDoctrine()->getManager();

                $em->persist($requestHall);

                $em->flush();

                return $this->redirectToRoute('cir_index');
            }

            return $this->render('request/create.html.twig', array('form' => $form->createView(), 'halls' => $halls));

        }
    }

}
