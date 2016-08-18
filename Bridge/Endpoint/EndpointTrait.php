<?php

namespace Mt\RestBundle\Bridge\Endpoint;

use Mt\RestBundle\Bridge\Request\RequestHandlerInterface;
use Mt\RestBundle\Bridge\Resource\ResourceInterface;

trait EndpointTrait
{
    /**
     * @var string
     */
    private $path;

    /**
     * @var ResourceInterface
     */
    private $resource;

    /**
     * @var RequestHandlerInterface
     */
    private $requestHandler;

    public function getPath(): string
    {
        return $this->path;
    }

    public function getResource(): ResourceInterface
    {
        return $this->resource;
    }

    public function setRequestHandler(RequestHandlerInterface $requestHandler)
    {
        $this->requestHandler = $requestHandler;
    }
}
