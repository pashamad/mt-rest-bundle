<?php

namespace Mt\RestBundle\Bridge\Resource;

interface ResourceTypeInterface
{
    public function getFactory(): ResourceFactoryInterface;
}
