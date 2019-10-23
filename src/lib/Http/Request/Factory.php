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
            $_SERVER['REQUEST_METHOD'],
            $_SERVER['REQUEST_URI'],
            $_GET,
            $_POST
        );
    }

    // ########################################
}