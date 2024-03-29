<?php

namespace Igord\CustomBlog\lib\Routing\Manager\Result\Route;

class Param
{
    /** @var string */
    private $name;

    /** @var mixed */
    private $value;

    // ########################################

    /**
     * Param constructor.
     *
     * @param string $name
     * @param mixed  $value
     */
    public function __construct(string $name, $value)
    {
        $this->name  = $name;
        $this->value = $value;
    }

    // ########################################

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    // ########################################
}