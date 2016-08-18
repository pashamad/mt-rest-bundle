<?php

namespace Mt\RestBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Mt\RestBundle\Service\EndpointServiceInterface;
use Mt\RestBundle\Service\RequestServiceInterface;

abstract class BaseRestController extends FOSRestController
{
    use RestControllerTrait;

    protected function getEndpointService(): EndpointServiceInterface
    {
        return $this->container->get('mt_rest.endpoint');
    }

    protected function getRequestService(): RequestServiceInterface
    {
        return $this->container->get('mt_rest.request');
    }
}
