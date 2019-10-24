<?php

namespace Tests\Blocks\PopularPosts;

use PHPUnit\Framework\TestCase as TestCase;
use \Igord\CustomBlog\lib\View\Block\Handler\BaseInterface as HandlerBaseInterface;
use \Igord\CustomBlog\Blocks\PopularPosts\Handler as Handler;
use \Igord\CustomBlog\Models\Posts as Posts;

class HandlerTest extends TestCase
{
    // ########################################

    public function testHandlerImplementBaseInterface()
    {
        $this->assertInstanceOf(HandlerBaseInterface::class, $this->createHandler());
    }

    public function testGetVarsHasCorrectStructure()
    {
        $handler = $this->createHandler();

        $vars = $handler->getVars();

        $this->assertIsArray($vars);
        $this->assertArrayHasKey('popularPosts', $vars);

        $this->assertIsArray($vars['popularPosts']);
        $this->assertEmpty($vars['popularPosts']);
    }

    public function testGetVarsReturnCorrectValues()
    {
        $postsMock = $this->createMock(Posts::class);
        $postsMock->method('findAll')
                  ->willReturn([$this->getPost()]);

        $handler = new Handler($postsMock);

        $vars = $handler->getVars();

        $this->assertIsArray($vars['popularPosts']);
        $this->assertEquals(1, count($vars['popularPosts']));
        $this->assertEquals($this->getPost(), $vars['popularPosts'][0]);
    }

    // ########################################

    private function createHandler(): Handler
    {
        $postsMock = $this->createMock(Posts::class);
        $postsMock->method('findAll')
                  ->willReturn([]);

        $handler = new Handler($postsMock);

        return $handler;
    }

    private function getPost(): array
    {
        return [
            'id'          => 1,
            'author_name' => 'name',
            'text'        => 'text',
            'created_at'  => '2019-10-11 13:38:05'
        ];
    }

    // ########################################
}