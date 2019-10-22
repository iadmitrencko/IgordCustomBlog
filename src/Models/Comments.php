<?php

namespace Igord\CustomBlog\Models;

class Comments
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
     * @param int $postId
     *
     * @return array|null
     */
    public function findByPostId(int $postId): ?array
    {
        $sql = "SELECT Comments.id as id, Comments.text as text, Comments.created_at as created_at, Authors.name as author_name 
                FROM Comments LEFT JOIN Authors ON Comments.author_id = Authors.id 
                WHERE Comments.post_id = :postId 
                ORDER BY Comments.created_at DESC;";

        $data = [
            'postId' => $postId
        ];

        $comments = $this->mysqlManager->executePrepared($sql, $data);

        return (empty($comments)) ? null : $comments;
    }

    /**
     * @param int    $postId
     * @param string $authorName
     * @param string $text
     *
     * @return int
     */
    public function save(int $postId, string $authorName, string $text): int
    {
        $author = $this->authors->find($authorName);

        $sql = "INSERT INTO `Comments`(`post_id`, `author_id`, `text`, `created_at`) VALUES(:post_id, :author_id, :text, NOW());";

        $data = [
            'post_id'   => $postId,
            'author_id' => (is_null($author)) ? $this->authors->save($authorName) : $author['id'],
            'text'      => $text
        ];

        $this->mysqlManager->executePrepared($sql, $data);

        return $this->mysqlManager->getLastInsertedId();
    }

    // ########################################
}