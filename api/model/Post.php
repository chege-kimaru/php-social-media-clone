<?php

require_once 'User.php';
require_once 'Comment.php';

/**
 * Created by PhpStorm.
 * User: Kevin Chege
 * Date: 06/04/2019
 * Time: 23:40
 */
class Post
{
    private $conn;
    private $table = 'posts';

    public $id;
    public $user_id;
    public $post;
    public $image;
    public $dateAdded;
    public $lastUpdated;

    //the person liking the post
    public $friend_id;

    //object holding the owner of the post
    public $user;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function createTable()
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS posts (
                id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                user_id INT NOT NULL,
                post VARCHAR(500) NOT NULL, 
                image VARCHAR(255),
                dateAdded TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                lastUpdated TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                FOREIGN KEY (user_id) REFERENCES users(id)
            )
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
    }

    public function createLikes()
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS likes (
                post_id INT NOT NULL, 
                friend_id INT NOT NULL,
                UNIQUE(post_id, friend_id),
                FOREIGN KEY (post_id) REFERENCES posts(id),
                FOREIGN KEY (friend_id) REFERENCES users(id),
                dateAdded TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                lastUpdated TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
    }

    public function like()
    {
        try {
            $query = 'INSERT INTO likes
                SET 
                post_id = :post_id,
                friend_id = :friend_id
            ';
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':post_id', htmlspecialchars(strip_tags($this->id)));
            $stmt->bindParam(':friend_id', htmlspecialchars(strip_tags($this->friend_id)));

            $stmt->execute();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function unlike()
    {
        try {
            $query = 'DELETE FROM likes
                WHERE post_id = :post_id AND friend_id = :friend_id
            ';
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':post_id', htmlspecialchars(strip_tags($this->id)));
            $stmt->bindParam(':friend_id', htmlspecialchars(strip_tags($this->friend_id)));

            $stmt->execute();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function isLiked()
    {
        try {
            $query = 'SELECT COUNT(*) AS liked FROM likes WHERE post_id = :post_id AND friend_id = :friend_id
            ';
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':post_id', htmlspecialchars(strip_tags($this->id)));
            $stmt->bindParam(':friend_id', htmlspecialchars(strip_tags($this->friend_id)));

            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC)['liked'];
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function likesCount()
    {
        try {
            $query = 'SELECT COUNT(*) AS likes FROM likes WHERE post_id = :post_id
            ';
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':post_id', htmlspecialchars(strip_tags($this->id)));

            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC)['likes'];
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function post()
    {
        try {
            $query = 'INSERT INTO posts
                SET 
                user_id = :user_id,
                post = :post,
                image = :image
            ';
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':user_id', htmlspecialchars(strip_tags($this->user_id)));
            $stmt->bindParam(':post', htmlspecialchars(strip_tags($this->post)));
            $stmt->bindParam(':image', htmlspecialchars(strip_tags($this->image)));

            $stmt->execute();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getPosts()
    {
        try {
            $query = '
                SELECT p.* FROM posts P
                WHERE p.user_id IN (SELECT friend_id FROM friends WHERE user_id =  :user_id) OR p.user_id = :user_id
                ORDER BY dateAdded DESC           
            ';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':user_id', htmlspecialchars(strip_tags($this->user_id)));
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw $e;
        }
    }


    //++++++++++++++++++++++++++++++++++++++++++

    public function fetchPosts($logged_userid = false)
    {
        try {
            $posts = array();
            $posts_r = $this->getPosts();
            foreach ($posts_r as $post) {
                $p = new Post($this->conn);
                $p->id = $post['id'];
                $p->friend_id = $logged_userid;

                $user = new User($this->conn);
                $user->id = $post['user_id'];

                $comment = new Comment($this->conn);
                $comment->post_id = $post['id'];

                array_push($posts, array(
                    'id' => $post['id'],
                    'post' => $post['post'],
                    'user_id' => $post['user_id'],
                    'image' => $post['image'],
                    'dateAdded' => $post['dateAdded'],
                    'lastUpdated' => $post['lastUpdated'],
                    'likesCount' => $p->likesCount(),
                    'isLiked' => $p->isLiked(),
                    'user' => $user->fetchSingleUser(),
                    'comments' => $comment->fetchComments(),
                    'commentsCount' => $comment->commentsCount(),
                ));
            }
            return $posts;
        } catch (Exception $e) {
            throw $e;
        }
    }

}