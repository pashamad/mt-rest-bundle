<?php

namespace Mt\RestBundle\Service;

use Mt\RestBundle\Bridge\Endpoint\DefinitionCollectionInterface;
use Mt\RestBundle\Bridge\Endpoint\DefinitionLoaderInterface;
use Mt\RestBundle\Core\Endpoint\EndpointDefinitionCollection;

class EndpointDefinitionLoader implements DefinitionLoaderInterface
{
    /**
     * @var DefinitionCollectionInterface
     */
    private $definitions;

    public function __construct()
    {
        $this->definitions = new EndpointDefinitionCollection();
    }

    public function loadCollection(DefinitionCollectionInterface $collection)
    {
        foreach ($collection as $item)
        {
            $this->definitions->registerDefinition($item);
        }
    }

    public function getDefinitions(): \ArrayIterator
    {
        return $this->definitions->getIterator();
    }
}
