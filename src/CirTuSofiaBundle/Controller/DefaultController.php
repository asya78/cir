<?php

namespace CirTuSofiaBundle\Controller;

use CirTuSofiaBundle\Entity\Hall;
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
        return $this->render('default/index.html.twig',['halls'=>$halls]);
    }
}
