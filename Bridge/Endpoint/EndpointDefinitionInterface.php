<?php

namespace Mt\RestBundle\Bridge\Endpoint;

use Mt\RestBundle\Bridge\Resource\ResourceDefinitionInterface;

interface EndpointDefinitionInterface
{
    public function getPath(): string;

    public function getResourceDefinition() : ResourceDefinitionInterface;
}
