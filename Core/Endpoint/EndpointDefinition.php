<?php

namespace Mt\RestBundle\Core\Endpoint;

use Mt\RestBundle\Bridge\Endpoint\EndpointDefinitionInterface;
use Mt\RestBundle\Bridge\Resource\ResourceDefinitionInterface;

class EndpointDefinition implements EndpointDefinitionInterface
{
    /**
     * @var string
     */
    private $path;

    /**
     * @var ResourceDefinitionInterface
     */
    private $resourceDefinition;


    public function __construct(string $path, ResourceDefinitionInterface $resourceDefinition)
    {
        $this->path = $path;
        $this->resourceDefinition = $resourceDefinition;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getResourceDefinition(): ResourceDefinitionInterface
    {
        return $this->resourceDefinition;
    }
}
