<?php

namespace Igord\CustomBlog\lib\Http;

class Request
{
    public const METHOD_POST = 'POST';
    public const METHOD_GET  = 'GET';

    /** @var string */
    private $method;

    /** @var string */
    private $uri;

    /** @var array */
    private $params;

    /** @var array */
    private $body;

    // ########################################

    /**
     * Request constructor.
     *
     * @param string $method
     * @param string $uri
     * @param array  $params
     * @param array  $body
     */
    public function __construct(string $method, string $uri, array $params = [], array $body = [])
    {
        $this->method = strtoupper($method);
        $this->uri    = rtrim($uri, '/') . '/';
        $this->params = $params;
        $this->body   = $body;
    }

    // ########################################

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * @return array
     */
    public function getBody(): array
    {
        return $this->body;
    }

    // ########################################
}