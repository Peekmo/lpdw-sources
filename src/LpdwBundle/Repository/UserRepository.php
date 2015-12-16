<?php

namespace LpdwBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;

class UserRepository extends EntityRepository implements UserProviderInterface
{
    public function loadUserByUsername($username)
    {
        $user = $this
            ->createQueryBuilder('u')
            ->where('u.username = :username')
            ->setParameter('username', $username)
            ->getQuery()
            ->getOneOrNullResult()
        ;

        if (null === $user) {
            throw new UsernameNotFoundException('Pas trouvé');
        }

        return $user;
    }

    public function refreshUser(UserInterface $user)
    {
        $class = get_class($user);

        if (!$this->supportsClass($class)) {
            throw new UnsupportedUserException('Non supporté');
        }

        return $this->find($user->getId());
    }

    public function supportsClass($class)
    {
        return $this->getEntityName() === $class
                    || is_subclass_of($class, $this->getEntityName());
    }
}
