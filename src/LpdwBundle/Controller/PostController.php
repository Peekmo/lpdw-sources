<?php

namespace LpdwBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use LpdwBundle\Post;

class PostController extends Controller
{
    public function postsAction(Request $request)
    {
        $posts = [
            new Post('salut', 'moi', true, new \DateTime(),new \DateTime()),
            new Post('salut 2', 'moi', true, new \DateTime(),new \DateTime()),
            new Post('salut 3', 'moi', true, new \DateTime(),new \DateTime()),
        ];

        return $this->render('LpdwBundle:Post:posts.html.twig', [
            'posts' => $posts
        ]);
    }
}