<?php

namespace Mt\RestBundle\Bridge\Resource;

interface ResourceFactoryInterface
{
    public function createResource(ResourceDefinitionInterface $definition): ResourceInterface;
}
