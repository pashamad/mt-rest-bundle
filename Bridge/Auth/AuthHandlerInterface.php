<?php

namespace Mt\RestBundle\Bridge\Auth;

use Mt\RestBundle\Bridge\Endpoint\EndpointInterface;
use Mt\RestBundle\Bridge\Request\EndpointRequestInterface;
use Mt\RestBundle\Bridge\Resource\ResourceInterface;

interface AuthHandlerInterface
{
    public function isClientAuthenticated(EndpointRequestInterface $request): bool;

    public function isEndpointAuthorized(EndpointRequestInterface $request, EndpointInterface $endpoint): bool;

    public function isResourceAuthorized(EndpointRequestInterface $request, ResourceInterface $resource): bool;
}
