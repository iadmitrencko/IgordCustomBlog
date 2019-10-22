<?php

namespace Igord\CustomBlog\lib;

class Message
{
    public const SUCCESS_TYPE = 'success';
    public const ERROR_TYPE   = 'error';

    /** @var string */
    private $type;

    /** @var string */
    private $value;

    // ########################################

    /**
     * Message constructor.
     *
     * @param string $type
     * @param string $value
     */
    public function __construct(string $type, string $value)
    {
        $this->type  = $type;
        $this->value = $value;
    }

    // ########################################

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    // ########################################
}