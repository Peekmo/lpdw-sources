<?php

namespace LpdwBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use LpdwBundle\Entity\Post;
use LpdwBundle\Entity\PostLike;
use LpdwBundle\Form\Type\PostType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

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
        // $post = $repository->find($id);
        $post = $repository->getById($id);

        return $this->render('LpdwBundle:Post:post.html.twig', [
            'id'   => $id,
            'post' => $post,
        ]);
    }

    public function newAction(Request $request)
    {
        // $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            // Faire ceci si mon utilisateur est connecté
        }

        // Récupère l'utilisateur connecté
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $post = new Post();
        $post->setUser($user);

        // $form = $this->createForm(new PostType(), $post); // Pre 2.8
        $form = $this->createForm(PostType::class, $post); // Post 2.8

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager(); // Récupère entity manager

            $em->persist($post);
            $em->flush($post);

            return $this->redirectToRoute('lpdw_post', ['id' => $post->getId()]);
        }

        return $this->render('LpdwBundle:Post:new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function likeAction(Request $request, $id)
    {
        // Récupération du post qu'on va aimer
        $repository = $this
            ->getDoctrine()
            ->getRepository('LpdwBundle:Post')
        ;

        $post = $repository->find($id);

        $this->get('lpdw.like_manager')->createLike($post, 1);

        // Redirection vers le détails d'un Post
        return $this->redirect(
            $this->generateUrl('lpdw_post', array('id' => $id))
        );
    }

    /**
     * @ParamConverter("post", class="LpdwBundle:Post")
     */
    public function dislikeAction(Request $request, Post $post)
    {
        $this->get('lpdw.like_manager')->createLike($post, -1);

        // Redirection vers le détails d'un Post
        return $this->redirect(
            $this->generateUrl('lpdw_post', array('id' => $post->getId()))
        );
    }
}
