<?php

namespace Igord\CustomBlog\lib\Http\Request;

class Factory
{
    // ########################################

    /**
     * @return \Igord\CustomBlog\lib\Http\Request
     */
    public function create(): \Igord\CustomBlog\lib\Http\Request
    {
        return new \Igord\CustomBlog\lib\Http\Request(
            $this->getRequestMethod(),
            $this->getRequestUri(),
            $_GET,
            $_POST
        );
    }

    // ########################################

    /**
     * @return string
     */
    private function getRequestMethod(): string
    {
        return strtoupper($_SERVER['REQUEST_METHOD']);
    }

    /**
     * @return string
     */
    private function getRequestUri(): string
    {
        return rtrim($_SERVER['REQUEST_URI'], '/') . '/';
    }

    // ########################################
}