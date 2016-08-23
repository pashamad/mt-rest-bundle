<?php

namespace Mt\RestBundle\Bridge\Security;

class AuthenticatedToken extends Token
{
    private $user;

    public function __construct(UserInterface $user)
    {
        $this->user = $user;
        parent::__construct(true);
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }
}
