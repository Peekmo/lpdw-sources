<?php

namespace LpdwBundle\Twig;
use LpdwBundle\Entity\Post;
use LpdwBundle\LikeManager\LikeManager;

class LikeExtension extends \Twig_Extension
{
    private $likeManager;

    public function __construct(LikeManager $likeManager)
    {
        $this->likeManager = $likeManager;
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('get_post_likes', array($this, 'getPostLikes')),
            new \Twig_SimpleFunction('get_post_dislikes', array($this, 'getPostDislikes')),
        );
    }

    public function getPostLikes(Post $post)
    {
        return $this->likeManager->getLikes($post);
    }

    public function getPostDislikes(Post $post)
    {
        return $this->likeManager->getDislikes($post);
    }

    public function getName()
    {
        return 'lpdw_like';
    }
}
