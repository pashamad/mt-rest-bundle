<?php

namespace Mt\RestBundle\Bridge\Security;

interface AuthenticatedTokenInterface extends TokenInterface
{
    public function getUser(): UserInterface;
}
