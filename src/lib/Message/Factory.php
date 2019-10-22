<?php

namespace Igord\CustomBlog\lib\Message;

class Factory
{
    // ########################################

    /**
     * @param string $type
     * @param string $value
     *
     * @return \Igord\CustomBlog\lib\Message
     */
    public function create(string $type, string $value): \Igord\CustomBlog\lib\Message
    {
        if (!in_array($type, $this->getAllowedTypes())) {
            throw new \LogicException("Not allowed message type: {$type}.");
        }

        return new \Igord\CustomBlog\lib\Message($type, $value);
    }

    // ########################################

    /**
     * @return array
     */
    private function getAllowedTypes(): array
    {
        return [
            \Igord\CustomBlog\lib\Message::ERROR_TYPE,
            \Igord\CustomBlog\lib\Message::SUCCESS_TYPE
        ];
    }

    // ########################################
}
