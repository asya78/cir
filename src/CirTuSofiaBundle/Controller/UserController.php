<?php

namespace CirTuSofiaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    public function registerAction($name)
    {
        return $this->render('user/register.html.twig');
    }

}
