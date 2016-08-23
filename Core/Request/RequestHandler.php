<?php

namespace Mt\RestBundle\Core\Request;

use Mt\RestBundle\Bridge\Security\AuthHandlerInterface;
use Mt\RestBundle\Bridge\Endpoint\EndpointInterface;
use Mt\RestBundle\Bridge\Request\EndpointRequestInterface;
use Mt\RestBundle\Bridge\Request\RequestHandlerInterface;
use Mt\RestBundle\Bridge\Security\AccessDeniedException;
use Mt\RestBundle\Bridge\Security\ResourceGrant;
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
        switch ($request->getMethod()) {
            case EndpointRequestInterface::METHOD_GET:
                //
                break;
            case EndpointRequestInterface::METHOD_POST:
            case EndpointRequestInterface::METHOD_PUT:
            case EndpointRequestInterface::METHOD_DELETE:
                //
                break;
            default:
                throw new \Exception(sprintf('Method "%s" is not allowed', $request->getMethod()));
        }

        $params = $request->getParams();
        $id = isset($params['id']) ? $params['id'] : null;
        $query = new ResourceQuery($id, $this->authHandler->getToken(), [], $request->getContent());

        switch ($request->getMethod()) {

            case EndpointRequestInterface::METHOD_GET:
                $result = $endpoint->getResource()->read($query);
                foreach ($result as $entity) {
                    if (!$this->authHandler->isGranted(ResourceGrant::read(), $entity)) {
                        throw new AccessDeniedException();
                    }
                }
                break;

            case EndpointRequestInterface::METHOD_POST:
                if (!$this->authHandler->isGranted(ResourceGrant::create())) {
                    throw new AccessDeniedException();
                }
                $result = $endpoint->getResource()->create($query);
                break;

            case EndpointRequestInterface::METHOD_PUT:
                $entities = $endpoint->getResource()->read($query);
                if (empty($entities)) {
                    return [];
                }
                foreach ($entities as $entity) {
                    if (!$this->authHandler->isGranted(ResourceGrant::update(), $entity)) {
                        throw new AccessDeniedException();
                    }
                }
                $result = $endpoint->getResource()->update($query);
                break;

            case EndpointRequestInterface::METHOD_DELETE:
                $entities = $endpoint->getResource()->read($query);
                if (!count($entities)) {
                    return [];
                }
                foreach ($entities as $entity) {
                    if (!$this->authHandler->isGranted(ResourceGrant::delete(), $entity)) {
                        throw new AccessDeniedException();
                    }
                }
                $result = $endpoint->getResource()->delete($query);
                break;

            default:
                throw new \LogicException('Unreachable code');
        }

        return $result;
    }
}
