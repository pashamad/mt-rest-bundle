<?php

namespace Mt\RestBundle\Core\Request;

use Mt\RestBundle\Bridge\Auth\AuthHandlerInterface;
use Mt\RestBundle\Bridge\Endpoint\EndpointInterface;
use Mt\RestBundle\Bridge\Request\EndpointRequestInterface;
use Mt\RestBundle\Bridge\Request\RequestHandlerInterface;
use Mt\RestBundle\Core\Resource\ResourceQuery;

class RequestHandler implements RequestHandlerInterface
{
    /**
     * @var AuthHandlerInterface
     */
    private $authHandler;

    public function setAuthHandler(AuthHandlerInterface $authHandler)
    {
        $this->authHandler = $authHandler;
    }

    public function handleRequest(EndpointRequestInterface $request, EndpointInterface $endpoint)
    {
        /**
         * @todo adapter
         */

        switch ($request->getMethod()) {
            case EndpointRequestInterface::METHOD_GET:
                //
                break;
            case EndpointRequestInterface::METHOD_POST:
            case EndpointRequestInterface::METHOD_PUT:
            case EndpointRequestInterface::METHOD_DELETE:
                if (!$this->authHandler->isAuthenticated($request)) {
                    throw new \Exception('Request is not authenticated');
                }
                break;
            default:
                throw new \Exception(sprintf('Method "%s" is not allowed', $request->getMethod()));
        }

        if (!$this->authHandler->isAuthorized($request, $endpoint->getResource())) {
            throw new \Exception('Request is not authorized');
        }

        $params = $request->getParams();
        $id = isset($params['id']) ? $params['id'] : null;
        $query = new ResourceQuery($id, [], $request->getContent());

        switch ($request->getMethod()) {

            case EndpointRequestInterface::METHOD_GET:
                $result = $endpoint->getResource()->read($query);
                break;

            case EndpointRequestInterface::METHOD_POST:
                $result = $endpoint->getResource()->create($query);
                break;

            case EndpointRequestInterface::METHOD_PUT:
                $result = $endpoint->getResource()->update($query);
                break;

            case EndpointRequestInterface::METHOD_DELETE:
                $result = $endpoint->getResource()->delete($query);
                break;

            // unreachable, kept for code purity
            default:
                throw new \Exception(sprintf('Method "%s" is not allowed', $request->getMethod()));
        }

        return $result;
    }
}
