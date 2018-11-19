<?php
include_once('Exceptions.php');

class PostModel {
    private $dbh;
    private $s;

    Public function __construct(dbh $dbh, Session $s) {
        $this->dbh = $dbh;
        $this->s = $s;
    }

    public function doActionPost(string $post) : void {
        $timestamp = date('Y-m-d G:i:s');
        if(empty($post))
            throw new NoContent("Post must have content");
        $filteredPost = strip_tags($post);
        $this->dbh->insertPost($this->s->getUserSession(), $timestamp, $filteredPost);
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
            throw new NotPostOwner("Not owner of post");
        }
    }
}