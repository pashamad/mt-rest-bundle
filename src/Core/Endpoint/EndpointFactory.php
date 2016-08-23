<?php

namespace Mt\RestBundle\Core\Endpoint;

use Mt\RestBundle\Bridge\Endpoint\EndpointDefinitionInterface;
use Mt\RestBundle\Bridge\Endpoint\EndpointInterface;
use Mt\RestBundle\Bridge\Request\RequestHandlerInterface;

class EndpointFactory
{
    /**
     * @var RequestHandlerInterface
     */
    private $requestHandler;

    public function __construct(RequestHandlerInterface $requestHandler)
    {
        $this->requestHandler = $requestHandler;
    }

    /**
     * @param EndpointDefinitionInterface $endpointDefinition
     * @return EndpointInterface
     */
    public function createEndpoint(EndpointDefinitionInterface $endpointDefinition) : EndpointInterface
    {
        $resourceDefinition = $endpointDefinition->getResourceDefinition();
        $resourceFactory = $resourceDefinition->getType()->getFactory();
        $resource = $resourceFactory->createResource($resourceDefinition);

        $endpoint = new Endpoint($endpointDefinition->getPath(), $resource);
        $endpoint->setRequestHandler($this->requestHandler);

        return $endpoint;
    }
}
