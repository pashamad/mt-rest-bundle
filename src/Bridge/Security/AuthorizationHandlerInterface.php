<?php

namespace Mt\RestBundle\Bridge\Security;

use Mt\RestBundle\Bridge\Resource\ResourceEntityInterface;

interface AuthorizationHandlerInterface
{
    public function isGranted(ResourceGrant $grant, ResourceEntityInterface $entity = null);
}
