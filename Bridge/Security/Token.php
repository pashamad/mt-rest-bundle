<?php

namespace Mt\RestBundle\Bridge\Security;

abstract class Token implements TokenInterface
{
    /**
     * @var bool
     * @immutable
     */
    private $authenticated;

    public function __construct(bool $authenticated)
    {
        $this->authenticated = $authenticated;
    }

    final public function isAuthenticated(): bool
    {
        return $this->authenticated;
    }
}
