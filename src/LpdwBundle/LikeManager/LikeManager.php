<?php

namespace LpdwBundle\LikeManager;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use LpdwBundle\Entity\Post;

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
        
    }
}
