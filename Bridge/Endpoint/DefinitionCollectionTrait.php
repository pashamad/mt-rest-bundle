<?php

namespace Mt\RestBundle\Bridge\Endpoint;

trait DefinitionCollectionTrait
{
    /**
     * @var EndpointDefinitionInterface[]
     */
    private $map = [];

    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->map);
    }
}
