<?php

namespace CirTuSofiaBundle\Controller;

use CirTuSofiaBundle\Entity\Hall;
use CirTuSofiaBundle\Entity\Problem;
use CirTuSofiaBundle\Form\ProblemType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ProblemController extends Controller
{
    /**
     * @Route("/problem/create", name="create_problem")
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

        $problemHall = new Problem();

        $form = $this->createForm(ProblemType::class, $problemHall);

        if ($request->isMethod('POST')) {

            $form->submit($request->request->all());

            if ($form->isSubmitted()) {

                $problemHall = $form->getData();

                $currentUser = $this->getUser();

                $problemHall->setRequester($currentUser);

                $problemHall->setRequesterId($currentUser->getId());

                if (!is_null($request->query->get('id'))) {

                    $currentHall = $this
                        ->getDoctrine()
                        ->getRepository(Hall::class)
                        ->find($request->query->get('id'));

                    $problemHall->setHallId($currentHall->getId());

                } else {
                    $currentHall = $this
                        ->getDoctrine()
                        ->getRepository(Hall::class)
                        ->find($problemHall->getHallId());
                }

                $problemHall->setHall($currentHall);
                $em = $this->getDoctrine()->getManager();

                $em->persist($problemHall);

                $em->flush();

                return $this->redirectToRoute('all_problem');

            }

            }

        return $this->render('problem/create.html.twig', array(
                'form' => $form->createView(),
                'halls'=> $halls,
                'hall'=>  $hall)
        );
    }

    /**
     * @Route("/problem/edit/{id}", name="edit_problem")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')" )
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editProblem($id, Request $request)
    {
        $problemHall = $this
            ->getDoctrine()
            ->getRepository(Problem::class)
            ->find($id);

        if ($problemHall === null) {

            return $this->redirectToRoute('cir_index');
        }

        $halls = $this->getDoctrine()->getRepository(Hall::class)->findAll();

        $form = $this->createForm(ProblemType::class, $problemHall);

        if ($request->isMethod('POST')) {

            $form->submit($request->request->all());

            if ($form->isSubmitted()) {

                $currentUser = $this->getUser();

                $problemHall->setRequester($currentUser);

                $problemHall->setRequesterId($currentUser->getId());

                $currentHall = $this
                    ->getDoctrine()
                    ->getRepository(Hall::class)
                    ->find($problemHall->getHallId());

                $problemHall->setHallId($currentHall->getId());

                $problemHall->setHall($currentHall);

                $em = $this->getDoctrine()->getManager();

                $em->merge($problemHall);

                $em->flush();

                return $this->redirectToRoute('all_problem');
            }

        }

        return $this->render('problem/edit.html.twig', array(
                'form' => $form->createView(),
                'problemHall'=> $problemHall,
                'halls'=> $halls)
        );

    }

    /**
     * @Route("/problem/delete/{id}", name="delete_problem")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')" )
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteProblem($id, Request $request)
    {
        $problemHall = $this
            ->getDoctrine()
            ->getRepository(Problem::class)
            ->find($id);

        if ($problemHall === null) {

            return $this->redirectToRoute('cir_index');
        }

        $halls = $this->getDoctrine()->getRepository(Hall::class)->findAll();

        $form = $this->createForm(ProblemType::class, $problemHall);

        if ($request->isMethod('POST')) {

            $form->submit($request->request->all());

            if ($form->isSubmitted()) {

                $currentUser = $this->getUser();

                $problemHall->setRequester($currentUser);

                $problemHall->setRequesterId($currentUser->getId());

                $em = $this->getDoctrine()->getManager();

                $em->remove($problemHall);

                $em->flush();

                return $this->redirectToRoute('all_problem');
            }

        }

        return $this->render('problem/delete.html.twig', array(
                'form' => $form->createView(),
                'problemHall'=>$problemHall,
                'halls'=> $halls)
        );

    }

    /**
     * @Route("/problem/all", name="all_problem")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')" )
     */
    public function allProblemHalls()
    {
        $problems = $this->getDoctrine()->getRepository(Problem::class)->findAll();

        return $this->render('problem/problems.html.twig',array('problems'=>$problems));
    }
}
