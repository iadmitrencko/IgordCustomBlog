<?php

namespace Igord\CustomBlog\Models;

class Posts
{
    /** @var \Igord\CustomBlog\Models\Authors */
    private $authors;

    /** @var \Igord\CustomBlog\lib\Database\Mysql\Manager */
    private $mysqlManager;

    // ########################################

    /**
     * Posts constructor.
     *
     * @param \Igord\CustomBlog\Models\Authors             $authors
     * @param \Igord\CustomBlog\lib\Database\Mysql\Manager $mysqlManager
     */
    public function __construct(Authors $authors, \Igord\CustomBlog\lib\Database\Mysql\Manager $mysqlManager)
    {
        $this->authors      = $authors;
        $this->mysqlManager = $mysqlManager;
    }

    // ########################################

    /**
     * @param int $id
     *
     * @return array|null
     */
    public function find(int $id): ?array
    {
        $sql = "SELECT Posts.id as id, Authors.name as author_name, Posts.text as text, Posts.created_at as created_at 
                FROM Posts LEFT JOIN Authors ON Posts.author_id = Authors.id 
                WHERE Posts.id = :id;";

        $data = [
            'id' => $id
        ];

        $post = $this->mysqlManager->executePrepared($sql, $data, false);

        return (!$post) ? null : $post;
    }

    /**
     * @param int|null $limit
     * @param bool     $takeMostPopular
     *
     * @return array
     */
    public function findAll(?int $limit = null, bool $takeMostPopular = false): array
    {
        $orderBy = 'Posts.created_at';
        if ($takeMostPopular) {
            $orderBy = 'comments_count DESC';
        }

        $sql = "SELECT DISTINCT Posts.id as post_id, 
                SUBSTRING(Posts.text, 1, 100) as post_text, 
                Posts.created_at as post_created_at, 
                Authors.name as author_name,
                (SELECT COUNT(*) FROM Comments WHERE Posts.id = Comments.post_id) as comments_count 
                FROM Posts 
                LEFT JOIN Comments ON Posts.id = Comments.post_id 
                LEFT JOIN Authors ON Posts.author_id = Authors.id
                ORDER BY {$orderBy}";

        if (!is_null($limit)) {
            $sql .= " LIMIT {$limit}";
        }

        return $this->mysqlManager->query($sql);
    }

    /**
     * @param string $authorName
     * @param string $text
     *
     * @return int
     */
    public function save(string $authorName, string $text): int
    {
        $author = $this->authors->find($authorName);

        $sql = "INSERT INTO `Posts`(`author_id`, `text`, `created_at`) VALUES(:author_id, :text, NOW());";

        $data = [
            'author_id' => (is_null($author)) ? $this->authors->save($authorName) : $author['id'],
            'text'      => $text
        ];

        $this->mysqlManager->executePrepared($sql, $data);

        return $this->mysqlManager->getLastInsertedId();
    }

    // ########################################
}