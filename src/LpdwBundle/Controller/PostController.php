<?php

namespace LpdwBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PostController extends Controller
{
    public function postsAction(Request $request)
    {
        return $this->render('LpdwBundle:Post:posts.html.twig');
    }
}
