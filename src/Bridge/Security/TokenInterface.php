<?php

namespace Mt\RestBundle\Bridge\Security;

interface TokenInterface
{
    public function isAuthenticated(): bool;

    public function getUser(): UserInterface;
}
