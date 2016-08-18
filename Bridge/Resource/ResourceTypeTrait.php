<?php

namespace Mt\RestBundle\Bridge\Resource;

trait ResourceTypeTrait
{
    /**
     * @var ResourceFactoryInterface
     */
    private $factory;

    public function getFactory(): ResourceFactoryInterface
    {
        return $this->factory;
    }
}
