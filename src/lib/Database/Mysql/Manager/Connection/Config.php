<?php

namespace Igord\CustomBlog\lib\Database\Mysql\Manager\Connection;

class Config
{
    /** @var string */
    private $host;

    /** @var int */
    private $port;

    /** @var string|null */
    private $username;

    /** @var string|null */
    private $password;

    /** @var string */
    private $dbName;

    // ########################################

    /**
     * Config constructor.
     *
     * @param string      $host
     * @param int         $port
     * @param string|null $username
     * @param string|null $password
     * @param string      $dbName
     */
    public function __construct(string $host, int $port, ?string $username, ?string $password, string $dbName)
    {
        $this->host     = $host;
        $this->port     = $port;
        $this->username = $username;
        $this->password = $password;
        $this->dbName   = $dbName;
    }

    // ########################################

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @return int
     */
    public function getPort(): int
    {
        return $this->port;
    }

    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getDbName(): string
    {
        return $this->dbName;
    }

    // ########################################
}