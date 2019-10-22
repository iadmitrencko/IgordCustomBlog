<?php

namespace Igord\CustomBlog\Http\Request;

class Validator
{
    /** @var \Igord\CustomBlog\lib\Message\Factory */
    private $messageFactory;

    /** @var null|bool */
    private $isValid;

    /** @var \Igord\CustomBlog\lib\Message[] */
    private $errorMessages = [];

    // ########################################

    /**
     * Validator constructor.
     *
     * @param \Igord\CustomBlog\lib\Message\Factory $messageFactory
     */
    public function __construct(
        \Igord\CustomBlog\lib\Message\Factory $messageFactory
    ) {
        $this->messageFactory = $messageFactory;
    }

    // ########################################

    /**
     * @param string $author
     * @param string $text
     */
    public function validate(string $author, string $text): void
    {
        $messageType = \Igord\CustomBlog\lib\Message::ERROR_TYPE;

        if (empty($author)) {
            $this->errorMessages[] = $this->messageFactory->create(
                $messageType,
                'Author must be not empty string!'
            );
        }

        if (strlen($author) > \Igord\CustomBlog\Models\Authors::NAME_MAX_LENGTH) {
            $this->errorMessages[] = $this->messageFactory->create(
                $messageType,
                'Author name must be not more that: ' . \Igord\CustomBlog\Models\Authors::NAME_MAX_LENGTH
            );
        }

        if (empty($text)) {
            $this->errorMessages[] = $this->messageFactory->create(
                $messageType,
                'Text must be not empty string!'
            );
        }

        if (empty($this->errorMessages)) {
            $this->isValid = true;
        } else {
            $this->isValid = false;
        }
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        if (is_null($this->isValid)) {
            throw new \LogicException("Validation error. Call method 'validate' firstly.");
        }

        return $this->isValid;
    }

    /**
     * @return \Igord\CustomBlog\lib\Message[]
     */
    public function getErrorMessages(): array
    {
        return $this->errorMessages;
    }

    // ########################################
}