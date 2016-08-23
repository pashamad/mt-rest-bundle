<?php

namespace Mt\RestBundle\Bridge\Security;

interface HasOwnerInterface
{
    public function getOwner(): ResourceOwnerInterface;

    public function setOwner(ResourceOwnerInterface $owner);
}
