<?php

namespace CirTuSofiaBundle\Controller;

use CirTuSofiaBundle\Entity\Hall;
use CirTuSofiaBundle\Entity\RequestHall;
use CirTuSofiaBundle\Form\HallType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HallController extends Controller
{
    /**
     * @Route("/hall/create", name="create_hall")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')" )
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {
        $hall = new Hall();

        $form = $this->createForm(HallType::class, $hall);

        $form->handleRequest($request);

        if ( $form->isSubmitted() && $form->isValid() ) {

            /** @var UploadedFile $file */
            $file = $form->getData()->getImage();

            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            try {

                $file->move($this->getParameter('hall_directory'), $fileName);

            } catch (FileException $ex) {

            }

            $hall->setImage($fileName);

            $currentUser = $this->getUser();

            $hall->setUser($currentUser);

            $em = $this->getDoctrine()->getManager();

            $em->persist($hall);

            $em->flush();

            return $this->redirectToRoute('cir_index');
        }

        return $this->render('hall/create.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/hall/view/{id}", name="view_hall")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')" )
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewHall($id)
    {
        $hall = $this->getDoctrine()->getRepository(Hall::class)->find($id);
        return $this->render('hall/view.html.twig',['hall'=>$hall]);
    }

    /**
     * @Route("/hall/edit/{id}", name="edit_hall")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')" )
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editHall($id, Request $request)
    {
        $hall = $this
            ->getDoctrine()
            ->getRepository(Hall::class)
            ->find($id);

        if ($hall === null) {

            return $this->redirectToRoute("cir_index");

        }

        $currentUser = $this->getUser();

        if (!$currentUser->isAdmin())
        {
            return $this->redirectToRoute("cir_index");
        };

        $form = $this->createForm(HallType::class, $hall);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

//            $fs = new Filesystem();

            /** @var UploadedFile $file */
            $file = $form->getData()->getImage();

            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            try {

                $file->move($this->getParameter('hall_directory'), $fileName);

            } catch (FileException $ex) {

            }

            $hall->setImage($fileName);

            $currentUser = $this->getUser();

            $hall->setUser($currentUser);

            $em = $this->getDoctrine()->getManager();

            $em->merge($hall);

            $em->flush();

            return $this->redirectToRoute('cir_index', array('id'=>$hall->getId()));
        }

        return $this->render('hall/edit.html.twig', array('form' => $form->createView(),'hall' => $hall));

    }

    /**
     * @Route("/hall/delete/{id}", name="delete_hall")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')" )
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteAction($id, Request $request)
    {
        $hall = $this
            ->getDoctrine()
            ->getRepository(Hall::class)
            ->find($id);

        if ($hall === null) {

            return $this->redirectToRoute("cir_index");

        }

        $form = $this->createForm(HallType::class, $hall);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $currentUser = $this->getUser();

            $hall->setUser($currentUser);

            $em = $this->getDoctrine()->getManager();

            $em->remove($hall);

            $em->flush();

            return $this->redirectToRoute('hall_all');
        }

        return $this->render('hall/delete.html.twig', array('form' => $form->createView(),'hall' => $hall));
    }

    /**
     * @Route("/hall/all", name="all_hall")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')" )
     */
    public function allHalls()
    {
        $halls = $this->getDoctrine()->getRepository(Hall::class)->findAll();

        return $this->render('hall/halls.html.twig',['halls'=>$halls]);
    }

    /**
     * @Route("/hall/schedule/{id}", name="schedule_hall")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')" )
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function scheduleHall($id)
    {
        $hall = $this->getDoctrine()->getRepository(Hall::class)->find($id);
        $requestsHalls = $this->getDoctrine()->getRepository(RequestHall::class)->findBy(array('hallId'=>$id));
        return $this->render('hall/schedule.html.twig',['hall'=>$hall,'requestsHalls'=>$requestsHalls]);
    }
}
