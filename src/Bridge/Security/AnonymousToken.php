<?php

namespace Mt\RestBundle\Bridge\Security;

class AnonymousToken extends Token
{
    public function __construct()
    {
        parent::__construct(false);
    }

    public function getUser(): UserInterface
    {
        throw new \LogicException('Unauthenticated token');
    }
}
