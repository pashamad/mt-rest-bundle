<?php

namespace Mt\RestBundle\Bridge\Collection;

abstract class ArrayCollection implements Collection
{
    /**
     * @var []
     */
    private $elements;

    public function __construct(array $elements = [])
    {
        $this->elements = $elements;
    }

    /**
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->elements);
    }

    public function getElements()
    {
        return $this->elements;
    }

    public function count()
    {
        return count($this->elements);
    }
}
