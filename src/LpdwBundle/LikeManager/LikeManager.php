<?php

namespace LpdwBundle\LikeManager;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use LpdwBundle\Entity\Post;
use LpdwBundle\Entity\PostLike;

class LikeManager
{
    /**
     * @var ManagerRegistry
     */
    private $doctrine;

    /**
     * @var TokenStorage
     */
    private $tokenStorage;

    /**
     * @param ManagerRegistry $doctrine
     * @param TokenStorage    $tokenStorage
     */
    public function __construct($doctrine, $tokenStorage)
    {
        $this->doctrine = $doctrine;
        $this->tokenStorage = $tokenStorage;
    }

    public function createLike(Post $post, $score)
    {
        // Récupère l'utilisateur courant
        $user = $this->tokenStorage->getToken()->getUser();

        // Création du postlike
        $postLike = new PostLike();
        $postLike->setScore($score);
        $postLike->setTarget($post);
        $postLike->setUser($user);

        // Sauvegarde
        $em = $this->doctrine->getManager();
        $em->persist($postLike);
        $em->flush($postLike);
    }

    /**
     * Renvoie le nombre de "j'aime"
     * @param  Post   $post
     * @return int
     */
    public function getLikes(Post $post)
    {
        $repository = $this->doctrine->getRepository('LpdwBundle:PostLike');

        return $repository->getCountLikes($post, 1);
    }


    /**
     * Renvoie le nombre de "j'aime pas"
     * @param  Post   $post
     * @return int
     */
    public function getDislikes(Post $post)
    {
        $repository = $this->doctrine->getRepository('LpdwBundle:PostLike');

        return $repository->getCountLikes($post, -1);
    }
}
