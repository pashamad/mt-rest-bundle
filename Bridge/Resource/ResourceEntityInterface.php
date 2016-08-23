<?php

namespace Mt\RestBundle\Bridge\Resource;

use Mt\RestBundle\Bridge\Security\HasOwnerInterface;

interface ResourceEntityInterface extends HasOwnerInterface
{
    /**
     * @return int
     */
    public function getId();
}
