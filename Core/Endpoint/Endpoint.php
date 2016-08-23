<?php

namespace Mt\RestBundle\Core\Endpoint;

use Mt\RestBundle\Bridge\Endpoint\EndpointInterface;
use Mt\RestBundle\Bridge\Endpoint\EndpointTrait;
use Mt\RestBundle\Bridge\Request\EndpointRequestInterface;
use Mt\RestBundle\Bridge\Request\RequestHandlerInterface;
use Mt\RestBundle\Bridge\Resource\ResourceInterface;

class Endpoint implements EndpointInterface
{
    use EndpointTrait;

    public function __construct(string $path, ResourceInterface $resource)
    {
        $this->path = $path;
        $this->resource = $resource;
    }

    public function handleRequest(EndpointRequestInterface $request)
    {
        return $this->requestHandler->handleRequest($request, $this);
    }
}
