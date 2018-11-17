<?php

class PostModel {
    
    private $dbh;
    private $s;

    Public function __construct(dbh $dbh, Session $s) {
        $this->dbh = $dbh;
        $this->s = $s;
    }

    public function doActionPost(string $post) : void {
        if(empty($post))
            // Include to exception class
            throw new Exception("Post must have content");
        $filteredPost = strip_tags($post);
        $this->dbh->insertPost($this->s->getUserSession(), $filteredPost);
    }

    public function doActionVote(int $postID) : void {
        $this->dbh->updateAfterUpvote($postID);
    }

    public function doActionDownvote(int $postID) : void {
        $this->dbh->updateAfterDownvote($postID);
    }

    public function doActionDelete($postID, $author) : void {
        if($this->s->getUserSession() === $author) {
            $this->dbh->deletePost($postID);
        } else {
            throw new Exception("Not owner of post");
        }
    }
}