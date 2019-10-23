<?php

namespace Tests\lib\Http;

use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    // ########################################

    public function testMethodParamPreparedCorrectly()
    {
        $request = new \Igord\CustomBlog\lib\Http\Request('get', '/');

        $this->assertNotEquals('get', $request->getMethod());
        $this->assertEquals('GET', $request->getMethod());

        $request = new \Igord\CustomBlog\lib\Http\Request('', '/');
        $this->assertEquals('', $request->getMethod());
    }

    public function testUriParamPreparedCorrectly()
    {
        $request = new \Igord\CustomBlog\lib\Http\Request('GET', '/');
        $this->assertEquals('/', $request->getUri());

        $request = new \Igord\CustomBlog\lib\Http\Request('GET', '/post/id');
        $this->assertEquals('/post/id/', $request->getUri());

        $request = new \Igord\CustomBlog\lib\Http\Request('GET', '');
        $this->assertEquals('/', $request->getUri());
    }

    // ########################################
}