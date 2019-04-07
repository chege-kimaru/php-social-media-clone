<?php
/**
 * Created by PhpStorm.
 * User: Kevin Chege
 * Date: 06/04/2019
 * Time: 23:41
 */

class Comment
{
    private $conn;
    private $table = 'comments';

    public $id;
    public $user_id;
    public $post_id;
    public $comment;
    public $dateAdded;
    public $lastUpdated;

    //Object holding owner of comment
    public $user;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function createTable()
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS comments (
                id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                user_id INT NOT NULL,
                post_id INT NOT NULL,
                comment VARCHAR(500) NOT NULL, 
                dateAdded TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                lastUpdated TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                FOREIGN KEY (user_id) REFERENCES users(id),
                FOREIGN KEY (post_id) REFERENCES posts(id)
            )
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
    }

    public function comment()
    {
        try {
            $query = 'INSERT INTO comments
                SET 
                user_id = :user_id,
                post_id = :post_id,
                comment = :comment
            ';
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':user_id', htmlspecialchars(strip_tags($this->user_id)));
            $stmt->bindParam(':post_id', htmlspecialchars(strip_tags($this->post_id)));
            $stmt->bindParam(':comment', htmlspecialchars(strip_tags($this->comment)));

            $stmt->execute();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function commentsCount()
    {
        try {
            $query = 'SELECT COUNT(*) AS comments FROM comments WHERE post_id = :post_id
            ';
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':post_id', htmlspecialchars(strip_tags($this->post_id)));

            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC)['comments'];
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getComments()
    {
        try {
            $query = 'SELECT * FROM comments WHERE post_id = :post_id';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':post_id', htmlspecialchars(strip_tags($this->post_id)));
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw $e;
        }
    }


    //++++++++++++++++++++++++++++++++++++++++++

    public function fetchComments()
    {
        try {
            $comments = array();
            $comments_r = $this->getComments();
            foreach ($comments_r as $comment) {

                $user = new User($this->conn);
                $user->id = $comment['user_id'];

                array_push($comments, array(
                    'id' => $comment['id'],
                    'comment' => $comment['comment'],
                    'user_id' => $comment['user_id'],
                    'post_id' => $comment['post_id'],
                    'dateAdded' => $comment['dateAdded'],
                    'lastUpdated' => $comment['lastUpdated'],
                    'user' => $user->fetchSingleUser(),
                ));
            }
            return $comments;
        } catch (Exception $e) {
            throw $e;
        }
    }
}