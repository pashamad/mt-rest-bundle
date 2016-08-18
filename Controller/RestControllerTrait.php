<?php

namespace Mt\RestBundle\Controller;

use Mt\RestBundle\Service\EndpointServiceInterface;
use Mt\RestBundle\Service\RequestServiceInterface;
use Symfony\Component\HttpFoundation\Request;

trait RestControllerTrait
{
    /**
     * @var string
     */
    protected $path;

    abstract protected function getEndpointService(): EndpointServiceInterface;
    abstract protected function getRequestService(): RequestServiceInterface;

    protected function handleRequest(Request $request, $params = [])
    {
        $endpointRequest = $this->getRequestService()->createRequest($request, $this->path, $params);
        $endpoint = $this->getEndpointService()->findEndpoint($endpointRequest);

        return $endpoint->handleRequest($endpointRequest);
    }
}
