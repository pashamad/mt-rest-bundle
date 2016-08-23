<?php

namespace Mt\RestBundle\Security;

use Mt\RestBundle\Bridge\Resource\ResourceEntityInterface;
use Mt\RestBundle\Bridge\Security\AccessDeniedException;
use Mt\RestBundle\Bridge\Security\AnonymousToken;
use Mt\RestBundle\Bridge\Security\AuthenticatedToken;
use Mt\RestBundle\Bridge\Security\ResourceGrant;
use Mt\RestBundle\Bridge\Security\Token;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

abstract class ResourceVoter extends Voter
{
    /**
     * @deprecated
     */
    const CREATE = 'create';
    const READ = 'read';
    const UPDATE = 'update';
    const DELETE = 'delete';

    /**
     * Determines if the attribute and subject are supported by this voter.
     *
     * @param string $attribute An attribute
     * @param mixed $subject The subject to secure, e.g. an object the user wants to access or any other PHP type
     *
     * @return bool True if the attribute and subject are supported, false otherwise
     */
    protected function supports($attribute, $subject)
    {
        if (!in_array($attribute, ResourceGrant::getConstList())) {
            return false;
        }

        if (!is_null($subject) && !$subject instanceof ResourceEntityInterface) {
            return false;
        }

        return true;
    }

    /**
     * Perform a single access check operation on a given attribute, subject and token.
     *
     * @param string $attribute
     * @param mixed $subject
     * @param TokenInterface $token
     * @return bool
     * @throws AccessDeniedException
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $baseToken)
    {
        $token = $baseToken instanceof \Symfony\Component\Security\Core\Authentication\Token\AnonymousToken
            ? new AnonymousToken()
            : new AuthenticatedToken($baseToken->getUser());

        switch ($attribute) {

            case ResourceGrant::CREATE:
                return $this->canCreate($token);

            case ResourceGrant::READ:
                return $this->canRead($subject, $token);

            case ResourceGrant::UPDATE:
                return $this->canUpdate($subject, $token);

            case ResourceGrant::DELETE:
                return $this->canDelete($subject, $token);

            default:
                throw new \LogicException('Unreachable code');
        }
    }

    abstract protected function canCreate(Token $token): bool;

    abstract protected function canRead(ResourceEntityInterface $entity, Token $token): bool;

    abstract protected function canUpdate(ResourceEntityInterface $entity, Token $token): bool;

    abstract protected function canDelete(ResourceEntityInterface $entity, Token $token): bool;
}
