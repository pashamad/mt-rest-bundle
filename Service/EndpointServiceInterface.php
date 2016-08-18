<?php

namespace Mt\RestBundle\Service;

use Mt\RestBundle\Bridge\Endpoint\EndpointInterface;
use Mt\RestBundle\Bridge\Request\EndpointRequestInterface;

interface EndpointServiceInterface
{
    public function findEndpoint(EndpointRequestInterface $request): EndpointInterface;
}
