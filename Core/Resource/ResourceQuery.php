<?php

namespace Mt\RestBundle\Core\Resource;

use Mt\RestBundle\Bridge\Security\TokenInterface;

class ResourceQuery
{
    private $id;

    /**
     * @var TokenInterface
     */
    private $token;

    private $params;

    private $data;

    public function __construct($id, TokenInterface $token, array $params = [], array $data = [])
    {
        $this->id = $id;
        $this->token = $token;
        $this->params = $params;
        $this->data = $data;
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return TokenInterface
     */
    public function getToken(): TokenInterface
    {
        return $this->token;
    }

    public function getParams(): array
    {
        return $this->params;
    }

    public function getData(): array
    {
        return $this->data;
    }
}
