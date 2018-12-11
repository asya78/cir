<?php

namespace CirTuSofiaBundle\Controller;

use CirTuSofiaBundle\Entity\Hall;
use CirTuSofiaBundle\Form\HallType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HallController extends Controller
{
    /**
     * @Route("/hall/create", name="create_hall")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function hallAction(Request $request)
    {
        $hall = new Hall();

        $form = $this->createForm(HallType::class, $hall);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $currentUser = $this->getUser();
        }



        return $this->render('hall/create.html.twig');
    }
}
