<?php

namespace Igord\CustomBlog\lib\Database\Mysql;

class Manager
{
    /** @var \Igord\CustomBlog\lib\Database\Mysql\Manager\Connection */
    private $connection;

    // ########################################

    /**
     * Manager constructor.
     *
     * @param \Igord\CustomBlog\lib\Database\Mysql\Manager\Connection $connection
     */
    public function __construct(Manager\Connection $connection)
    {
        $this->connection = $connection;
    }

    // ########################################

    /**
     * @param string $sql
     *
     * @return array
     */
    public function query(string $sql): array
    {
        return $this->connection->getConnection()->query($sql)->fetchAll();
    }

    /**
     * @param string $sql
     *
     * @return false|int
     */
    public function exec(string $sql)
    {
        return $this->connection->getConnection()->exec($sql);
    }

    /**
     * @param string $sql
     * @param array  $data
     * @param bool   $fetchAll
     *
     * @return array|mixed
     */
    public function executePrepared(string $sql, array $data, bool $fetchAll = true)
    {
        $sth = $this->connection->getConnection()->prepare($sql);

        $sth->execute($data);

        if ($fetchAll) {
            return $sth->fetchAll();
        }

        return $sth->fetch();
    }

    /**
     * @return string
     */
    public function getLastInsertedId()
    {
        return $this->connection->getConnection()->lastInsertId();
    }

    // ########################################

    /**
     * @return \Igord\CustomBlog\lib\Database\Mysql\Manager\Connection
     */
    protected function getConnection(): Manager\Connection
    {
        return $this->connection;
    }

    // ########################################
}