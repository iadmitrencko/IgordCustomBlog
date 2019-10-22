<?php

namespace Igord\CustomBlog\lib\Database\Mysql\Manager;

class Connection
{
    /** @var \Igord\CustomBlog\lib\Database\Mysql\Manager\Connection\Config */
    private $config;

    /** @var \PDO */
    private $connection;

    // ########################################

    /**
     * Connection constructor.
     *
     * @param \Igord\CustomBlog\lib\Database\Mysql\Manager\Connection\Config $config
     */
    public function __construct(Connection\Config $config)
    {
        $this->config = $config;
    }

    // ########################################

    /**
     * @return \PDO
     */
    public function getConnection(): \PDO
    {
        if (!is_null($this->connection)) {
            return $this->connection;
        }

        $dsn = "mysql:host={$this->config->getHost()};port={$this->config->getPort()};dbname={$this->config->getDbName()}";

        $this->connection = new \PDO(
            $dsn,
            $this->config->getUsername(),
            $this->config->getPassword(),
            [
                \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_EMULATE_PREPARES   => false
            ]
        );

        return $this->connection;
    }

    // ########################################
}