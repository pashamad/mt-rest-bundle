<?php

namespace Mt\RestBundle\Core\Request;

use Mt\RestBundle\Bridge\Request\EndpointRequestInterface;

class RequestFactory
{
    public function create($method, $path, $params, $content): EndpointRequestInterface
    {
        return new EndpointRequest($method, $path, $params, $content);
    }
}
