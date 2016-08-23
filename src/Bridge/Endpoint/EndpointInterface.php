<?php

namespace Mt\RestBundle\Bridge\Endpoint;

use Mt\RestBundle\Bridge\Request\EndpointRequestInterface;
use Mt\RestBundle\Bridge\Request\RequestHandlerInterface;
use Mt\RestBundle\Bridge\Resource\ResourceInterface;

interface EndpointInterface
{
    public function getPath(): string;

    public function getResource(): ResourceInterface;

    public function setRequestHandler(RequestHandlerInterface $requestHandler);

    public function handleRequest(EndpointRequestInterface $request);
}
