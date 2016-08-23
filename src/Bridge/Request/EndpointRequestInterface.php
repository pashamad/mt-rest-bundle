<?php

namespace Mt\RestBundle\Bridge\Request;

/**
 * @todo ResourceRequestInterface
 *
 * Interface EndpointRequestInterface
 * @package Mt\RestBundle\Bridge\Request
 */
interface EndpointRequestInterface
{
    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';
    const METHOD_PUT = 'PUT';
    const METHOD_DELETE = 'DELETE';

    public function getMethod(): string;

    public function getPath(): string;

    public function getParams(): array;

    public function getContent(): array;
}
