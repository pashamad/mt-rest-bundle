<?php

namespace Mt\RestBundle\Security;

use Mt\RestBundle\Bridge\Security\AnonymousToken;
use Mt\RestBundle\Bridge\Security\AuthenticatedToken;
use Mt\RestBundle\Bridge\Security\AuthenticationAdapterInterface;
use Mt\RestBundle\Bridge\Security\TokenInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class TokenStorageAdapter implements AuthenticationAdapterInterface
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    public function getToken(): TokenInterface
    {
        /** @var \Symfony\Component\Security\Core\Authentication\Token\TokenInterface $baseToken */
        $baseToken = $this->tokenStorage->getToken();

        // @todo immutable
        return $baseToken instanceof \Symfony\Component\Security\Core\Authentication\Token\AnonymousToken
            ? new AnonymousToken()
            : new AuthenticatedToken($baseToken->getUser());
    }
}
