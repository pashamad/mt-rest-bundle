<?php

namespace Mt\RestBundle\Bridge\Request;

use Mt\RestBundle\Bridge\Auth\AuthHandlerInterface;
use Mt\RestBundle\Bridge\Endpoint\EndpointInterface;

interface RequestHandlerInterface
{
    public function setAuthHandler(AuthHandlerInterface $authHandler);

    public function handleRequest(EndpointRequestInterface $request, EndpointInterface $endpoint);
}
