<?php

namespace Tests\lib\Http;

use PHPUnit\Framework\TestCase as TestCase;
use \Igord\CustomBlog\lib\Http\Request as Request;

class RequestTest extends TestCase
{
    // ########################################

    public function testMethodParamPreparedCorrectly()
    {
        $request = new Request('get', '/');

        $this->assertNotEquals('get', $request->getMethod());
        $this->assertEquals('GET', $request->getMethod());

        // ----------------------------------------

        $request = new Request('', '/');

        $this->assertEquals('', $request->getMethod());
    }

    public function testUriParamPreparedCorrectly()
    {
        $request = new Request('GET', '/');

        $this->assertEquals('/', $request->getUri());

        // ----------------------------------------

        $request = new Request('GET', '/post/id');

        $this->assertEquals('/post/id/', $request->getUri());

        // ----------------------------------------

        $request = new Request('GET', '');

        $this->assertEquals('/', $request->getUri());
    }

    // ########################################
}