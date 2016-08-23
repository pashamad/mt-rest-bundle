<?php

namespace Mt\RestBundle\Bridge\Collection;

use Mt\RestBundle\Bridge\Resource\ResourceEntityInterface;

class ResourceCollection extends ArrayCollection
{
    /**
     * @return ResourceEntityInterface[]
     */
    public function getIterator()
    {
        return parent::getIterator();
    }
}
