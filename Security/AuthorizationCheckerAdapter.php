<?php

namespace Mt\RestBundle\Security;

use Mt\RestBundle\Bridge\Resource\ResourceEntityInterface;
use Mt\RestBundle\Bridge\Security\AuthorizationAdapterInterface;
use Mt\RestBundle\Bridge\Security\ResourceGrant;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class AuthorizationCheckerAdapter implements AuthorizationAdapterInterface
{
    /**
     * @var AuthorizationCheckerInterface
     */
    private $authorizationChecker;

    public function __construct(AuthorizationCheckerInterface $authorizationChecker)
    {
        $this->authorizationChecker = $authorizationChecker;
    }

    public function isGranted(ResourceGrant $grant, ResourceEntityInterface $entity = null)
    {
        return $this->authorizationChecker->isGranted((string) $grant, $entity);
    }
}
