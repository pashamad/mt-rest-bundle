<?php

namespace Mt\RestBundle\Service;

use Mt\RestBundle\Bridge\Auth\AuthHandlerInterface;
use Mt\RestBundle\Bridge\Endpoint\EndpointInterface;
use Mt\RestBundle\Bridge\Request\EndpointRequestInterface;
use Mt\RestBundle\Bridge\Resource\ResourceInterface;

class OAuthHandlerService implements AuthHandlerInterface
{
    public function isClientAuthenticated(EndpointRequestInterface $request): bool
    {
        // TODO: Implement isClientAuthenticated() method.
        return true;
    }

    public function isEndpointAuthorized(EndpointRequestInterface $request, EndpointInterface $endpoint): bool
    {
        // TODO: Implement isEndpointAuthorized() method.
        return true;
    }

    public function isResourceAuthorized(EndpointRequestInterface $request, ResourceInterface $resource): bool
    {
        // TODO: Implement isResourceAuthorized() method.
        return true;
    }
}
