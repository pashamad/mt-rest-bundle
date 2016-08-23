<?php

namespace Mt\RestBundle\Core\Security;

use Mt\RestBundle\Bridge\Security\ResourceOwnerInterface;

trait HasOwnerTrait
{
    /**
     * @var ResourceOwnerInterface
     */
    protected $owner;

    /**
     * @return ResourceOwnerInterface
     */
    public function getOwner(): ResourceOwnerInterface
    {
        return $this->owner;
    }

    /**
     * @param ResourceOwnerInterface $owner
     */
    public function setOwner(ResourceOwnerInterface $owner)
    {
        $this->owner = $owner;
    }
}
