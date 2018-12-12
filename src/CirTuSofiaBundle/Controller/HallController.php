<?php

namespace CirTuSofiaBundle\Controller;

use CirTuSofiaBundle\Entity\Hall;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class HallController extends Controller
{
    /**
     * @Route("/hall/create", name="create_hall")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function hallAction()
    {
        $hall = new Hall();

        return $this->render('hall/create.html.twig');
    }
}
