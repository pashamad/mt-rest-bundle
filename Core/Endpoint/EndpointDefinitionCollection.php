<?php

namespace Mt\RestBundle\Core\Endpoint;

use Mt\RestBundle\Bridge\Endpoint\DefinitionCollectionInterface;
use Mt\RestBundle\Bridge\Endpoint\DefinitionCollectionTrait;
use Mt\RestBundle\Bridge\Endpoint\EndpointDefinitionInterface;
use Mt\RestBundle\Bridge\Endpoint\NotFoundException;

class EndpointDefinitionCollection implements DefinitionCollectionInterface
{
    use DefinitionCollectionTrait;

    public function registerDefinition(EndpointDefinitionInterface $definition)
    {
        $path = $definition->getPath();

        if (isset($this->map[$path])) {
            throw new \Exception(sprintf('Endpoint definition "%s" already registered', $path));
        }

        $this->map[$path] = $definition;
    }

    public function findByPath($path): EndpointDefinitionInterface
    {
        if (!isset($this->map[$path])) {
            /**
             * @todo replace by optional return (php7.1)
             */
            throw new NotFoundException(sprintf('Endpoint definition "%s" not found', $path));
        }

        return $this->map[$path];
    }
}
