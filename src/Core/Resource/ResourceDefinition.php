<?php

namespace Mt\RestBundle\Core\Resource;

use Mt\RestBundle\Bridge\Resource\ResourceDefinitionInterface;
use Mt\RestBundle\Bridge\Resource\ResourceTypeInterface;

class ResourceDefinition implements ResourceDefinitionInterface
{
    /**
     * @var ResourceTypeInterface
     */
    private $type;

    /**
     * @var []
     */
    private $params;

    public function __construct(ResourceTypeInterface $type, array $params)
    {
        $this->type = $type;
        $this->params = $params;
    }

    public function getType(): ResourceTypeInterface
    {
        return $this->type;
    }

    public function getParams(): array
    {
        return $this->params;
    }
}
