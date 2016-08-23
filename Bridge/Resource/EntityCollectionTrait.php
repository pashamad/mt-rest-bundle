<?php

namespace Mt\RestBundle\Bridge\Resource;

use Doctrine\Common\Collections\ArrayCollection;

trait EntityCollectionTrait
{
    /**
     * @var ResourceEntityInterface[]
     */
    private $collection = [];

    public function getCollection(): ArrayCollection {}

    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->collection);
    }
}
