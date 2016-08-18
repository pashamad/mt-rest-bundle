<?php

namespace Mt\RestBundle\Request;

use Mt\RestBundle\Bridge\Request\RequestDataInterface;
use Symfony\Component\HttpFoundation\Request;

interface RequestTransformerInterface
{
    public function transformRequest(Request $request): RequestDataInterface;
}
