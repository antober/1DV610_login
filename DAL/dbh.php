<?php
include('dbconfig.php');
include('Exceptions.php');

class dbh {
    
    private $conn;

    public function insertUser(User $user) : void {
        $this->conn = $this->openSqlConn();
        $uname = $user->getUsername();
        $pword = $user->getPassword();

        $sql = "INSERT INTO users (name, password)
        VALUES ('$uname', '$pword')";

        if ($this->conn->query($sql) !== true) {
            throw new SQLConnectionError("Error: " . $sql . " " . $this->conn->error);
        }
        $this->conn->close();
    }

    public function getUser($name, $pwd) : bool {
        $this->conn = $this->openSqlConn();
        $sql = "SELECT * FROM users WHERE BINARY name='$name' AND password='$pwd';";
        $result = $this->conn->query($sql);

        if($result->num_rows == 1) {
            return true;
        } else {
            return false;
        }
        $this->conn->close();
    }

    public function userExist($name) : bool {
        $this->conn = $this->openSqlConn();
        $sql = "SELECT * FROM users WHERE BINARY name='$name';";
        $result = $this->conn->query($sql);

        if($result->num_rows == 1) {
            return true;
        } else {
            return false;
        }
        $this->conn->close();
    }

    public function insertPost($author, $timestamp, $post) : void {
        $this->conn = $this->openSqlConn();
        $sql = "INSERT INTO posts (author, timestamp, content)
        VALUES ('$author', '$timestamp', '$post')";

        $this->conn->query($sql);
        $this->conn->close();
    }

    public function getAllPosts() {
        $this->conn = $this->openSqlConn();
        $sql = "SELECT * FROM posts;";
        $result = $this->conn->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function updateAfterUpvote($postID) {
        $this->conn = $this->openSqlConn();
        $sql = "UPDATE posts SET upvotes = upvotes + 1 WHERE id = '$postID'";
        $this->conn->query($sql);
        
        $this->conn->close();
    }

    public function updateAfterDownvote($postID) {
        $this->conn = $this->openSqlConn();
        $sql = "UPDATE posts SET upvotes = upvotes - 1 WHERE id = '$postID'";
        $this->conn->query($sql);

        $this->conn->close();
    }

    public function deletePost($postID) {
        $this->conn = $this->openSqlConn();
        $sql = "DELETE FROM posts WHERE id = '$postID'";

        $this->conn->query($sql);
        

        $this->conn->close();
    }

    private function openSqlConn() {
        $conn = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

        if ($conn->connect_error)
            die("Connection failed: " . $conn->connect_error);
        return $conn;
    }
}


