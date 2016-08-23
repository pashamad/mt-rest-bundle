<?php

namespace Mt\RestBundle\Core\Request;

use Mt\RestBundle\Bridge\Request\EndpointRequestInterface;

class EndpointRequest implements EndpointRequestInterface
{
    private $method;

    private $path;

    private $params;

    private $content;

    public function __construct($method, $path, $params, $content)
    {
        $this->method = strtoupper($method);
        $this->path = $path;
        $this->params = $params;
        $this->content = $content;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getParams(): array
    {
        return $this->params;
    }

    public function getContent(): array
    {
        return $this->content;
    }
}
