<?php

namespace Mt\RestBundle\Core\Resource;

class ResourceQuery
{
    private $id;

    private $params;

    private $data;

    public function __construct($id, array $params = [], array $data = [])
    {
        $this->id = $id;
        $this->params = $params;
        $this->data = $data;
    }

    public function getId()
    {
        return $this->id;
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
