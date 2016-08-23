<?php

namespace Mt\RestBundle\Service;

use Mt\RestBundle\Bridge\Request\EndpointRequestInterface;
use Mt\RestBundle\Core\Request\EndpointRequest;
use Symfony\Component\HttpFoundation\Request;

class RequestService implements RequestServiceInterface
{
    public function createRequest(Request $request, string $path, array $params = []): EndpointRequestInterface
    {
        $method = $request->getMethod();

        $contentBody = $request->getContent();
        if (empty($contentBody)) {
            $content = [];
        } else {
            // @todo pluggable content decoder
            $content = json_decode($contentBody, true);
            if (is_null($content)) {
                throw new \Exception(sprintf('Content must be a valid json string (%s)', json_last_error_msg()));
            }
        }

        return new EndpointRequest($method, $path, $params, $content);
    }
}
