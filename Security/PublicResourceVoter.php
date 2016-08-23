<?php

namespace Mt\RestBundle\Security;

use Mt\RestBundle\Bridge\Resource\ResourceEntityInterface;
use Mt\RestBundle\Bridge\Security\Token;

class PublicResourceVoter extends ResourceVoter
{

    protected function canCreate(Token $token): bool
    {
        return $token->isAuthenticated();
    }

    protected function canRead(ResourceEntityInterface $entity, Token $token): bool
    {
        return true;
    }

    protected function canUpdate(ResourceEntityInterface $entity, Token $token): bool
    {
        $owner = $entity->getOwner();

        // @todo strict comparison
        return $token->getUser() == $owner;
    }

    protected function canDelete(ResourceEntityInterface $entity, Token $token): bool
    {
        return $this->canUpdate($entity, $token);
    }
}
