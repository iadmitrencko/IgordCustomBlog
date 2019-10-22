<?php

namespace Igord\CustomBlog\lib\Message\Collection;

interface BaseInterface
{
    // ########################################

    /**
     * @param \Igord\CustomBlog\lib\Message $message
     */
    public function addMessage(\Igord\CustomBlog\lib\Message $message): void;

    /**
     * @param string|null $type
     * If param $type is null must return all messages
     * If $type not allowed throws LogicException
     *
     * @return \Igord\CustomBlog\lib\Message[]
     *
     * @throws \LogicException
     */
    public function getMessages(string $type = null): array;

    /**
     * @param string|null $type
     * If param $type is null must check in all type messages
     * If $type not allowed throws LogicException
     *
     * @return bool
     */
    public function hasMessages(string $type = null): bool;

    /**
     * @param string|null $type
     * If param $type is null must delete all messages
     * If $type not allowed throws LogicException
     *
     * @throws \LogicException
     */
    public function removeMessages(string $type = null): void;

    // ########################################
}