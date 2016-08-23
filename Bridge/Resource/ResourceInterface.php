<?php

namespace Mt\RestBundle\Bridge\Resource;

use Mt\RestBundle\Bridge\Collection\ResourceCollection;
use Mt\RestBundle\Core\Resource\ResourceQuery;

interface ResourceInterface
{
    public function create(ResourceQuery $query): ResourceEntityInterface;

    public function read(ResourceQuery $query): ResourceCollection;

    public function update(ResourceQuery $query): ResourceEntityInterface;

    public function delete(ResourceQuery $query): ResourceEntityInterface;
}
