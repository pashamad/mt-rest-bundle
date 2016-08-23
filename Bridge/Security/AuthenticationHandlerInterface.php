<?php

namespace Mt\RestBundle\Bridge\Security;

interface AuthenticationHandlerInterface
{
    public function getToken(): TokenInterface;
}
