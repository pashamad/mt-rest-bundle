<?php

namespace Mt\RestBundle\ResourceType;

use Mt\RestBundle\Bridge\Resource\ResourceTypeInterface;
use Mt\RestBundle\Bridge\Resource\ResourceTypeTrait;
use Mt\RestBundle\Service\ResourceFactory\DoctrineResourceFactory;

class DoctrineResourceType implements ResourceTypeInterface
{
    use ResourceTypeTrait;

    public function __construct(DoctrineResourceFactory $factory)
    {
        $this->factory = $factory;
    }
}
