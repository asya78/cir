<?php

namespace CirTuSofiaBundle\Controller;

use CirTuSofiaBundle\Entity\Hall;
use CirTuSofiaBundle\Entity\RequestHall;
use CirTuSofiaBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="cir_index")
     */
    public function indexAction()
    {
        $halls = $this
            ->getDoctrine()
            ->getRepository(Hall::class)
            ->findAll();

        $requestsHalls = $this
            ->getDoctrine()
            ->getRepository(RequestHall::class)
            ->findAll();

        $user = $this
            ->getDoctrine()
            ->getRepository(User::class)
            ->findAll();

        return $this->render('default/index.html.twig',['halls'=>$halls,'requestsHalls'=>$requestsHalls,'user'=>$user]);
    }
}
