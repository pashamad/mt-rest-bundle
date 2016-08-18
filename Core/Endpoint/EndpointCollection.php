<?php

namespace Mt\RestBundle\Core\Endpoint;

use Mt\RestBundle\Bridge\Endpoint\EndpointInterface;
use Mt\RestBundle\Bridge\Endpoint\NotFoundException;

class EndpointCollection
{
    /**
     * @var EndpointInterface[]
     */
    private $map = [];

    public function registerEndpoint(EndpointInterface $endpoint, string $path)
    {
        if (isset($this->map[$path])) {
            throw new \Exception(sprintf('Endpoint "%s" already registered', $path));
        }

        $this->map[$path] = $endpoint;
    }

    public function findByPath($path): EndpointInterface
    {
        if (!isset($this->map[$path])) {
            /**
             * @todo replace by optional return (php7.1)
             */
            throw new NotFoundException(sprintf('Endpoint "%s" not found', $path));
        }

        return $this->map[$path];
    }
}
