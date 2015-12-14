<?php

namespace LpdwBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use LpdwBundle\Post;

class PostController extends Controller
{
    public function postsAction(Request $request)
    {
        $repository = $this
            ->getDoctrine()
            ->getRepository('LpdwBundle:Post')
        ;

        // $posts = $repository->findBy(array());
        $posts = $repository->findAll();

        return $this->render('LpdwBundle:Post:posts.html.twig', [
            'posts' => $posts
        ]);
    }

    public function postAction(Request $request, $id)
    {
        $repository = $this
            ->getDoctrine()
            ->getRepository('LpdwBundle:Post')
        ;

        // $post = $repository->findOneById($id);
        // $post = $repository->findOneBy(array('id' => $id));
        $post = $repository->find($id);

        return $this->render('LpdwBundle:Post:post.html.twig', [
            'id'   => $id,
            'post' => $post
        ]);
    }
}
