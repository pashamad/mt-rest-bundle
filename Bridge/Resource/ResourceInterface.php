<?php

namespace Mt\RestBundle\Bridge\Resource;

use Mt\RestBundle\Core\Resource\ResourceQuery;

interface ResourceInterface
{
    public function create(ResourceQuery $query);

    public function read(ResourceQuery $query);

    public function update(ResourceQuery $query);

    public function delete(ResourceQuery $query);
}
