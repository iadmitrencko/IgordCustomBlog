<?php

namespace Igord\CustomBlog\Blocks\Messages;

class Handler implements \Igord\CustomBlog\lib\View\Block\Handler\BaseInterface
{
    public const BLOCK_ID   = 'messages';
    public const BLOCK_VIEW = self::BLOCK_ID . '.php';

    /** @var \Igord\CustomBlog\lib\Message\Collection\BaseInterface */
    private $messagesCollection;

    // ########################################

    /**
     * Handler constructor.
     *
     * @param \Igord\CustomBlog\lib\Message\Collection\BaseInterface $messagesCollection
     */
    public function __construct(\Igord\CustomBlog\lib\Message\Collection\BaseInterface $messagesCollection)
    {
        $this->messagesCollection = $messagesCollection;
    }

    // ########################################

    /**
     * @return array
     */
    public function getVars(): array
    {
        return [
            'successMessages' => $this->getMessages(\Igord\CustomBlog\lib\Message::SUCCESS_TYPE),
            'errorMessages'   => $this->getMessages(\Igord\CustomBlog\lib\Message::ERROR_TYPE)
        ];
    }

    // ########################################

    /**
     * @param string $type
     *
     * @return array
     */
    private function getMessages(string $type): array
    {
        $messages = [];

        if ($this->messagesCollection->hasMessages($type)) {
            $messages = $this->messagesCollection->getMessages($type);

            $this->messagesCollection->removeMessages($type);
        }

        return $messages;
    }

    // ########################################
}