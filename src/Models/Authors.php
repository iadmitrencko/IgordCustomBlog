<?php

namespace Igord\CustomBlog\Models;

class Authors
{
    public const NAME_MAX_LENGTH = 50;

    /** @var \Igord\CustomBlog\lib\Database\Mysql\Manager */
    private $mysqlManager;

    // ########################################

    /**
     * Authors constructor.
     *
     * @param \Igord\CustomBlog\lib\Database\Mysql\Manager $mysqlManager
     */
    public function __construct(\Igord\CustomBlog\lib\Database\Mysql\Manager $mysqlManager)
    {
        $this->mysqlManager = $mysqlManager;
    }

    // ########################################

    /**
     * @param string $name
     *
     * @return array|null
     */
    public function find(string $name): ?array
    {
        $sql = "SELECT * FROM `Authors` WHERE name=:name;";

        $data = [
            'name' => $name
        ];

        $author = $this->mysqlManager->executePrepared($sql, $data, false);

        return (!$author) ? null : $author;
    }

    /**
     * @param string $name
     *
     * @return int
     */
    public function save(string $name): int
    {
        $sql = "INSERT INTO `Authors`(`name`) VALUES(:name);";

        $data = [
            'name' => $name
        ];

        $this->mysqlManager->executePrepared($sql, $data);

        return $this->mysqlManager->getLastInsertedId();
    }

    // ########################################
}