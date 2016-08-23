<?php

namespace Mt\RestBundle\Bridge\Security;

final class ResourceGrant
{
    const CREATE = 'create';

    const READ = 'read';

    const UPDATE = 'update';

    const DELETE = 'delete';

    const __CONST_LIST = [
        self::CREATE,
        self::READ,
        self::UPDATE,
        self::DELETE
    ];

    /**
     * @var string immutable value
     */
    private $__value;

    public function __construct($value)
    {
        if (!in_array($value, $this->getConstList())) {
            throw new \InvalidArgumentException(sprintf('ResourceGrant value must be one of [%s], %s given',
                join(', ', $this->getConstList()), $value));
        }

        $this->__value = $value;
    }

    public static function create(): ResourceGrant
    {
        return new self(self::CREATE);
    }

    public static function read(): ResourceGrant
    {
        return new self(self::READ);
    }

    public static function update(): ResourceGrant
    {
        return new self(self::UPDATE);
    }

    public static function delete(): ResourceGrant
    {
        return new self(self::DELETE);
    }

    /**
     * @return string[]
     */
    public static function getConstList()
    {
        return static::__CONST_LIST;
    }

    function __toString()
    {
        return $this->__value;
    }
}
