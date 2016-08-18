<?php

namespace Mt\RestBundle\Service;

use Mt\RestBundle\Bridge\Auth\AuthHandlerInterface;
use Mt\RestBundle\Bridge\Endpoint\EndpointInterface;
use Mt\RestBundle\Bridge\Endpoint\EndpointLocatorInterface;
use Mt\RestBundle\Bridge\Request\EndpointRequestInterface;
use Mt\RestBundle\Core\Endpoint\EndpointFactory;
use Mt\RestBundle\Core\Endpoint\EndpointLocator;
use Mt\RestBundle\Core\Request\RequestHandler;

class EndpointService implements EndpointServiceInterface
{
    /**
     * @var EndpointLocatorInterface
     */
    private $locator;

    public function __construct(EndpointDefinitionLoader $loader, AuthHandlerInterface $authHandler)
    {
        $requestHandler = new RequestHandler();
        $requestHandler->setAuthHandler($authHandler);
        $factory = new EndpointFactory($requestHandler);

        $this->locator = new EndpointLocator($factory);
        $this->locator->loadDefinitions($loader);
    }

    /**
     * @param EndpointRequestInterface $request
     * @return EndpointInterface
     */
    public function findEndpoint(EndpointRequestInterface $request): EndpointInterface
    {
        return $this->locator->findEndpoint($request);
    }
}
