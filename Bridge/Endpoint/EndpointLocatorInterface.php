<?php

namespace Mt\RestBundle\Bridge\Endpoint;

use Mt\RestBundle\Bridge\Request\EndpointRequestInterface;

interface EndpointLocatorInterface
{
    public function loadDefinitions(DefinitionLoaderInterface $loader);

    /**
     * @param EndpointRequestInterface $request
     * @return EndpointInterface
     */
    public function findEndpoint(EndpointRequestInterface $request): EndpointInterface;
}
