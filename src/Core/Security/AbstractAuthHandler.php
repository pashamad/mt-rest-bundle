<?php

namespace Mt\RestBundle\Core\Security;

use Mt\RestBundle\Bridge\Resource\ResourceEntityInterface;
use Mt\RestBundle\Bridge\Security\AuthHandlerInterface;
use Mt\RestBundle\Bridge\Security\AuthenticationAdapterInterface;
use Mt\RestBundle\Bridge\Security\AuthorizationAdapterInterface;
use Mt\RestBundle\Bridge\Security\ResourceGrant;
use Mt\RestBundle\Bridge\Security\TokenInterface;

abstract class AbstractAuthHandler implements AuthHandlerInterface
{
    /**
     * @var AuthenticationAdapterInterface
     */
    private $authenticationAdapter;

    /**
     * @var AuthorizationAdapterInterface
     */
    private $authorizationAdapter;

    public function __construct(AuthenticationAdapterInterface $authenticationAdapter,
                                AuthorizationAdapterInterface $authorizationAdapter)
    {
        $this->authenticationAdapter = $authenticationAdapter;
        $this->authorizationAdapter = $authorizationAdapter;
    }

    public function getToken(): TokenInterface
    {
        return $this->authenticationAdapter->getToken();
    }

    public function isGranted(ResourceGrant $grant, ResourceEntityInterface $entity = null)
    {
        return $this->authorizationAdapter->isGranted($grant, $entity);
    }
}
