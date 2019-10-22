<?php

namespace Igord\CustomBlog\lib\Routing\Route;

class Param
{
    /** @var string */
    private $name;

    /** @var string */
    private $pattern;

    // ########################################

    /**
     * Param constructor.
     *
     * @param string $name
     * @param string $pattern
     */
    public function __construct(string $name, string $pattern)
    {
        $this->name    = $name;
        $this->pattern = $pattern;
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
     * @return string
     */
    public function getPattern(): string
    {
        return $this->pattern;
    }

    // ########################################
}