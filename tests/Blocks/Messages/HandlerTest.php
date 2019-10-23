<?php

namespace Tests\Blocks\Messages;

use PHPUnit\Framework\TestCase as TestCase;
use \Igord\CustomBlog\Blocks\Messages\Handler as Handler;
use \Igord\CustomBlog\lib\Session as Session;
use \Igord\CustomBlog\lib\Message\Session\Collection as SessionCollection;
use \Igord\CustomBlog\lib\View\Block\Handler\BaseInterface as HandlerBaseInterface;
use \Igord\CustomBlog\lib\Message as Message;

class HandlerTest extends TestCase
{
    // ########################################

    public function testHandlerImplementBaseInterface()
    {
        $this->assertInstanceOf(HandlerBaseInterface::class, $this->createHandler());
    }

    public function testGetVarsMessagesHasCorrectStructure()
    {
        $handler = $this->createHandler();

        $vars = $handler->getVars();

        $this->assertIsArray($vars);

        $this->assertArrayHasKey('successMessages', $vars);
        $this->assertArrayHasKey('errorMessages', $vars);

        $successMessages = $vars['successMessages'];
        $errorMessages   = $vars['errorMessages'];

        $this->assertIsArray($successMessages);
        $this->assertIsArray($errorMessages);

        $this->assertEmpty($successMessages);
        $this->assertEmpty($errorMessages);
    }

    public function testGetVarsReturnCorrectValues()
    {
        $sessionCollection = new SessionCollection(new Session());
        $sessionCollection->addMessage(new Message(Message::SUCCESS_TYPE, 'success'));
        $sessionCollection->addMessage(new Message(Message::ERROR_TYPE, 'error'));

        $handler = new Handler($sessionCollection);

        $vars = $handler->getVars();

        $successMessages = $vars['successMessages'];
        $errorMessages   = $vars['errorMessages'];

        $this->assertIsArray($successMessages);
        $this->assertIsArray($errorMessages);

        $this->assertNotEmpty($successMessages);
        $this->assertNotEmpty($errorMessages);

        $this->assertEquals(1, count($successMessages));
        $this->assertEquals(1, count($errorMessages));

        $successMessage = $successMessages[0];
        $errorMessage   = $errorMessages[0];

        $this->assertInstanceOf(Message::class, $successMessage);
        $this->assertInstanceOf(Message::class, $errorMessage);

        $this->assertEquals('success', $successMessage->getValue());
        $this->assertEquals('error', $errorMessage->getValue());
    }

    // ########################################

    private function createHandler(): Handler
    {
        return new Handler(new SessionCollection(new Session()));
    }

    // ########################################
}