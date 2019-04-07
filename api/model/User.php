<?php
/**
 * Created by PhpStorm.
 * User: Kevin Chege
 * Date: 22/02/2019
 * Time: 08:38
 */

class User
{
    private $conn;
    private $table = 'users';

    public $id;
    public $name;
    public $phone;
    public $email;
    public $password;
    public $dob;
    public $location;
    public $education;
    public $image;
    public $dateAdded;
    public $lastUpdated;

    public $friend_id;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function createTable()
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS users (
                id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(50) NOT NULL,
                email VARCHAR(50) NOT NULL UNIQUE,
                phone VARCHAR(10) NOT NULL,
                password VARCHAR(255) NOT NULL,
                dob TIMESTAMP,
                location VARCHAR(255),
                education VARCHAR(255),
                image VARCHAR(255),
                dateAdded TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                lastUpdated TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
    }

    public function createFriends()
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS friends (
                user_id INT NOT NULL, 
                friend_id INT NOT NULL,
                UNIQUE(user_id, friend_id),
                FOREIGN KEY (user_id) REFERENCES users(id),
                FOREIGN KEY (friend_id) REFERENCES users(id),
                dateAdded TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                lastUpdated TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
    }

    public function follow()
    {
        try {
            $query = 'INSERT INTO friends
                SET 
                user_id = :user_id,
                friend_id = :friend_id
            ';
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':user_id', htmlspecialchars(strip_tags($this->id)));
            $stmt->bindParam(':friend_id', htmlspecialchars(strip_tags($this->friend_id)));

            $stmt->execute();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function unfollow()
    {
        try {
            $query = 'DELETE FROM friends
                WHERE user_id = :user_id AND friend_id = :friend_id
            ';
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':user_id', htmlspecialchars(strip_tags($this->id)));
            $stmt->bindParam(':friend_id', htmlspecialchars(strip_tags($this->friend_id)));

            $stmt->execute();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function isFollowing()
    {
        try {
            $query = 'SELECT COUNT(*) AS following FROM friends WHERE user_id = :user_id AND friend_id = :friend_id
            ';
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':user_id', htmlspecialchars(strip_tags($this->id)));
            $stmt->bindParam(':friend_id', htmlspecialchars(strip_tags($this->friend_id)));

            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC)['following'];
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function followersCount()
    {
        try {
            $query = 'SELECT COUNT(*) AS followers FROM friends WHERE friend_id = :user_id
            ';
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':user_id', htmlspecialchars(strip_tags($this->id)));

            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC)['followers'];
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function followingCount()
    {
        try {
            $query = 'SELECT COUNT(*) AS following FROM friends WHERE user_id = :user_id
            ';
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':user_id', htmlspecialchars(strip_tags($this->id)));

            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC)['following'];
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function followers()
    {
        try {
            $query = 'SELECT u.* FROM friends f
                      LEFT JOIN users u ON f.user_id = u.id 
                      WHERE f.friend_id = :user_id';
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':user_id', htmlspecialchars(strip_tags($this->id)));

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function following()
    {
        try {
            $query = 'SELECT u.* FROM friends f
                      LEFT JOIN users u ON f.friend_id = u.id 
                      WHERE f.user_id = :user_id';
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':user_id', htmlspecialchars(strip_tags($this->id)));

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function register()
    {
        try {
            $query = 'INSERT INTO users
                SET 
                name = :name,
                email = :email,
                phone = :phone,
                dob = :dob,
                location = :location,
                education = :education,
                image = :image,
                password = :password
            ';
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':name', htmlspecialchars(strip_tags($this->name)));
            $stmt->bindParam(':email', htmlspecialchars(strip_tags($this->email)));
            $stmt->bindParam(':phone', htmlspecialchars(strip_tags($this->phone)));
            $stmt->bindParam(':dob', htmlspecialchars(strip_tags($this->dob)));
            $stmt->bindParam(':location', htmlspecialchars(strip_tags($this->location)));
            $stmt->bindParam(':education', htmlspecialchars(strip_tags($this->education)));
            $stmt->bindParam(':image', htmlspecialchars(strip_tags($this->image)));
            $stmt->bindParam(':password', password_hash($this->password, PASSWORD_BCRYPT));

            $stmt->execute();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function editUser()
    {
        try {
            $query = 'UPDATE users
                SET 
                name = :name,
                phone = :phone,
                email = :email,
                dob = :dob,
                location = :location,
                education = :education,
                image = :image
                WHERE
                id = :id
            ';
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':id', htmlspecialchars(strip_tags($this->id)));
            $stmt->bindParam(':name', htmlspecialchars(strip_tags($this->name)));
            $stmt->bindParam(':phone', htmlspecialchars(strip_tags($this->phone)));
            $stmt->bindParam(':email', htmlspecialchars(strip_tags($this->email)));
            $stmt->bindParam(':dob', htmlspecialchars(strip_tags($this->dob)));
            $stmt->bindParam(':location', htmlspecialchars(strip_tags($this->location)));
            $stmt->bindParam(':education', htmlspecialchars(strip_tags($this->education)));
            $stmt->bindParam(':image', htmlspecialchars(strip_tags($this->image)));

            $stmt->execute();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function deleteUser()
    {
        try {
            $query = 'DELETE FROM users WHERE id=:id';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', htmlspecialchars(strip_tags($this->id)));

            $stmt->execute();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getUsers()
    {
        try {
            $query = 'SELECT * FROM users';
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function searchUsers()
    {
        try {
            $query = "SELECT * FROM users WHERE name LIKE '%$this->name%'";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getSingleUser()
    {
        try {
            $query = 'SELECT * FROM users WHERE id=:id';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', htmlspecialchars(strip_tags($this->id)));
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getSingleUserByEmail()
    {
        try {
            $query = 'SELECT * FROM users WHERE email=:email';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':email', htmlspecialchars(strip_tags($this->email)));
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function changePassword()
    {
        try {
            $query = 'UPDATE users
                SET 
                password = :password
                WHERE id = :id
            ';
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':password', password_hash($this->password, PASSWORD_BCRYPT));
            $stmt->bindParam(':id', htmlspecialchars(strip_tags($this->id)));

            $stmt->execute();
        } catch (Exception $e) {
            throw $e;
        }
    }


    //++++++++++++++++++++++++++++++++++++++++++
    public function setUser($byEmail = false)
    {
        try {
            if ($byEmail)
                $user = $this->getSingleUserByEmail();
            else
                $user = $this->getSingleUser();
            $this->id = $user['id'];
            $this->name = $user['name'];
            $this->phone = $user['phone'];
            $this->email = $user['email'];
            $this->location = $user['location'];
            $this->education = $user['education'];
            $this->image = $user['image'];
            $this->dob = $user['dob'];
            $this->password = $user['password'];
            $this->dateAdded = $user['dateAdded'];
            $this->lastUpdated = $user['lastUpdated'];
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function fetchSingleUser()
    {
        try {
            $user = $this->getSingleUser();
            return array(
                'id' => $user['id'],
                'name' => $user['name'],
                'phone' => $user['phone'],
                'email' => $user['email'],
                'education' => $user['education'],
                'dob' => $user['dob'],
                'location' => $user['location'],
                'image' => $user['image'],
                'dateAdded' => $user['dateAdded'],
                'lastUpdated' => $user['lastUpdated'],
                'followersCount' => $this->followersCount(),
                'followingCount' => $this->followingCount(),
            );
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function fetchAllUsers($search = false, $logged_userid = false, $following = false, $followers = false)
    {
        try {
            $users = array();
            if ($search) {
                $users_r = $this->searchUsers();
            } else if ($following) {
                $users_r = $this->following();
            } else if ($followers) {
                $users_r = $this->followers();
            } else {
                $users_r = $this->getUsers();
            }
            foreach ($users_r as $user) {
                $u = new User($this->conn);
                $u->id = $logged_userid;
                $u->friend_id = $user['id'];
                array_push($users, array(
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'phone' => $user['phone'],
                    'email' => $user['email'],
                    'dob' => $user['dob'],
                    'education' => $user['education'],
                    'location' => $user['location'],
                    'image' => $user['image'],
                    'dateAdded' => $user['dateAdded'],
                    'lastUpdated' => $user['lastUpdated'],
                    'following' => $u->isFollowing()
                ));
            }
            return $users;
        } catch (Exception $e) {
            throw $e;
        }
    }

}