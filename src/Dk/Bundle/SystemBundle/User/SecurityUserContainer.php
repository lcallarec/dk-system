<?php

namespace Dk\Bundle\SystemBundle\User;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class UserContainer
 *
 * This class contain the user from security context
 * Used only by the service container
 *
 * @package Dk\Bundle\SystemBundle\User
 *
 * @author Laurent Callarec <l.callarec@gmail.com>
 */
class SecurityUserContainer
{
    /**
     * @var UserInterface
     */
    private $user;

    /**
     * @param UserInterface $user
     */
    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    /**
     * @return UserInterface
     */
    public function getUser()
    {
        return $this->user;
    }
} 