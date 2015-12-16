<?php

namespace LpdwBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class LoginController extends Controller
{
    public function loginAction(Request $request)
    {
        return $this->render('LpdwBundle:Login:login.html.twig');
    }

    public function loginCheckAction(Request $request)
    {

    }
}
