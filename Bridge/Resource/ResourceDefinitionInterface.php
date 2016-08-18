<?php

namespace Mt\RestBundle\Bridge\Resource;

interface ResourceDefinitionInterface
{
    public function getType(): ResourceTypeInterface;

    public function getParams(): array;
}
