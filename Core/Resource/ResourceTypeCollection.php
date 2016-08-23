<?php

namespace Mt\RestBundle\Core\Resource;

use Mt\RestBundle\Bridge\Resource\ResourceDefinitionInterface;
use Mt\RestBundle\Bridge\Resource\ResourceTypeInterface;

class ResourceTypeCollection implements \IteratorAggregate
{
    /**
     * @var ResourceTypeInterface
     */
    private $map = [];

    /**
     * @param ResourceTypeInterface $type
     * @throws \Exception
     */
    public function registerType(ResourceTypeInterface $type)
    {
        // @todo fix interface
        $id = $type->getId();

        if (isset($this->map[$id])) {
            throw new \Exception(sprintf('Resource type "%s" already registered', $id));
        }

        $this->map[$id] = $type;
    }

    /**
     * @param string $id
     * @return ResourceDefinitionInterface
     */
    public function findById(string $id): ResourceDefinitionInterface
    {
        return isset($this->map[$id])
            ? $this->map[$id]
            : null;
    }

    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->map);
    }
}
