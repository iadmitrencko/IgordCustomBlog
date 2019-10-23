<?php

namespace Igord\CustomBlog\lib\Message\Session;

class Collection implements \Igord\CustomBlog\lib\Message\Collection\BaseInterface
{
    private const SESSION_MESSAGES_KEY = 'messages';

    /** @var \Igord\CustomBlog\lib\Session */
    private $session;

    // ########################################

    /**
     * Collection constructor.
     *
     * @param \Igord\CustomBlog\lib\Session $session
     */
    public function __construct(\Igord\CustomBlog\lib\Session $session)
    {
        $this->session = $session;
    }

    // ########################################

    /**
     * @param \Igord\CustomBlog\lib\Message $message
     */
    public function addMessage(\Igord\CustomBlog\lib\Message $message): void
    {
        $messages = $this->session->get(self::SESSION_MESSAGES_KEY);
        if (is_null($messages)) {
            $messages = [];
        }

        $this->checkType($message->getType());

        $messages[$message->getType()][] = $message;

        $this->session->set(self::SESSION_MESSAGES_KEY, $messages);
    }

    /**
     * @param string|null $type
     * If param $type is null must return all messages
     * If $type not allowed throws LogicException
     *
     * @return \Igord\CustomBlog\lib\Message[]
     *
     * @throws \LogicException
     */
    public function getMessages(string $type = null): array
    {
        if (!is_null($type)) {
            $this->checkType($type);
        }

        $messages = $this->session->get(self::SESSION_MESSAGES_KEY);
        if (is_null($messages)) {
            return [];
        }

        if (is_null($type)) {
            $result = [];
            foreach ($messages as $messagesTypeList) {
                $result = array_merge($result, $messagesTypeList);
            }

            return $result;
        }

        if (!$this->hasMessages($type)) {
            return [];
        }

        return $messages[$type];
    }

    /**
     * @param string|null $type
     * If param $type is null must check in all type messages
     * If $type not allowed throws LogicException
     *
     * @return bool
     */
    public function hasMessages(string $type = null): bool
    {
        if (!is_null($type)) {
            $this->checkType($type);
        }

        $messages = $this->session->get(self::SESSION_MESSAGES_KEY);
        if (is_null($messages)) {
            return false;
        }

        if (is_null($type) && !empty($messages)) {
            return true;
        }

        return array_key_exists($type, $messages);
    }

    /**
     * @param string|null $type
     * If param $type is null must delete all messages
     * If $type not allowed throws LogicException
     *
     * @throws \LogicException
     */
    public function removeMessages(string $type = null): void
    {
        if (!is_null($type)) {
            $this->checkType($type);
        }

        if (!$this->hasMessages()) {
            return;
        }

        if (is_null($type)) {
            $this->session->remove(self::SESSION_MESSAGES_KEY);
        }

        if ($this->hasMessages($type)) {
            $messages = $this->session->get(self::SESSION_MESSAGES_KEY);

            unset($messages[$type]);

            $this->session->set(self::SESSION_MESSAGES_KEY, $messages);
        }
    }

    // ########################################

    /**
     * @param string $type
     */
    private function checkType(string $type): void
    {
        $allowedTypes = [
            \Igord\CustomBlog\lib\Message::ERROR_TYPE,
            \Igord\CustomBlog\lib\Message::SUCCESS_TYPE
        ];

        if (!in_array($type, $allowedTypes)) {
            throw new \LogicException("Not allowed message type: {$type}.");
        }
    }

    // ########################################
}