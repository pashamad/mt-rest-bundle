<?php

namespace Mt\RestBundle\Bridge\Endpoint;

interface DefinitionLoaderInterface
{
    public function loadCollection(DefinitionCollectionInterface $collection);

    public function getDefinitions(): \ArrayIterator;
}
