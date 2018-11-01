<?php

class PostModel {
    private $dbh;

    Public function __construct(dbh $dbh) {
        $this->dbh = $dbh;
    }

    public function tryActionPost(string $post) : void {
        
        if(empty($post))
            throw new Exception("Post must have content");
        
        $filteredPost = strip_tags($post);
        $this->dbh->insertPost($_SESSION['username'], $filteredPost);
    }

    public function doActionVote(int $postID) : void {

        $this->dbh->updateAfterUpvote($postID);
        setcookie($postID, $_SESSION['username'], time()+60*60*24*365);
    }

    public function doActionDownvote(int $postID) : void {

        $this->dbh->updateAfterDownvote($postID);
        setcookie($postID, $_SESSION['username'], time()+60*60*24*365);
    }
}