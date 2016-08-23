<?php

namespace Mt\RestBundle\Bridge\Security;

class AccessDeniedException extends \Exception
{
    private static $defaultMessage = 'Access denied';

    public function __construct($message = "", $code = 0, \Exception $previous = null)
    {
        parent::__construct(empty($message) ? self::$defaultMessage : $message, $code, $previous);
    }
}
