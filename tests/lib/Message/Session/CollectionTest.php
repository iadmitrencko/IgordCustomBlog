<?php

namespace Tests\lib\Message\Session;

use PHPUnit\Framework\TestCase as TestCase;
use \Igord\CustomBlog\lib\Message\Session\Collection as SessionCollection;
use \Igord\CustomBlog\lib\Message\Collection\BaseInterface as CollectionBaseInterface;
use \Igord\CustomBlog\lib\Session as Session;
use \Igord\CustomBlog\lib\Message as Message;

class CollectionTest extends TestCase
{
    // ########################################

    public function testCollectionImplementBaseInterface()
    {
        $collection = new SessionCollection(new Session());

        $this->assertInstanceOf(CollectionBaseInterface::class, $collection);
    }

    public function testCollectionFunctionality()
    {
        $collection = new SessionCollection(new Session());

        $this->assertFalse($collection->hasMessages());
        $this->assertFalse($collection->hasMessages(Message::SUCCESS_TYPE));
        $this->assertFalse($collection->hasMessages(Message::ERROR_TYPE));
        $this->assertEmpty($collection->getMessages());

        $collection->addMessage(new Message(Message::SUCCESS_TYPE, 'test value for success message'));
        $collection->addMessage(new Message(Message::ERROR_TYPE, 'test value for error message'));

        // ----------------------------------------

        // check messages added
        $this->assertTrue($collection->hasMessages());
        $this->assertTrue($collection->hasMessages(Message::SUCCESS_TYPE));
        $this->assertTrue($collection->hasMessages(Message::ERROR_TYPE));

        // ----------------------------------------

        // check getMessages method
        $successMessage = $collection->getMessages(Message::SUCCESS_TYPE)[0];
        $this->assertEquals('test value for success message', $successMessage->getValue());

        $successMessage = $collection->getMessages(Message::SUCCESS_TYPE)[0];
        $this->assertEquals('test value for success message', $successMessage->getValue());

        // ----------------------------------------

        //check removeMessages method
        $collection->removeMessages();

        $this->assertFalse($collection->hasMessages());
        $this->assertFalse($collection->hasMessages(Message::SUCCESS_TYPE));
        $this->assertFalse($collection->hasMessages(Message::ERROR_TYPE));
    }

    public function testThrowExceptionWhenAddMessageWithNotSupportedType()
    {
        $collection = new SessionCollection(new Session());

        $this->expectException(\LogicException::class);
        $collection->addMessage(new Message('notSupportedType', 'value'));
    }

    public function testThrowExceptionWhenGetMessageWithNotSupportedType()
    {
        $collection = new SessionCollection(new Session());

        $this->expectException(\LogicException::class);
        $collection->getMessages('notSupportedType');
    }

    public function testThrowExceptionWhenCheckMessageExistWithNotSupportedType()
    {
        $collection = new SessionCollection(new Session());

        $this->expectException(\LogicException::class);
        $collection->hasMessages('notSupportedType');
    }

    // ########################################
}