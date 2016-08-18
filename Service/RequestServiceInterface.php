<?php

namespace Mt\RestBundle\Service;

use Mt\RestBundle\Bridge\Request\EndpointRequestInterface;
use Symfony\Component\HttpFoundation\Request;

interface RequestServiceInterface
{
    public function createRequest(Request $request, string $path, array $params = []): EndpointRequestInterface;
}
