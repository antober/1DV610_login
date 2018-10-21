<?php

class PostModel
{
    private $dbh;

    Public function __construct(dbh $dbh)
    {
        $this->dbh = $dbh;
    }

    public function tryPost(string $post) : void
    {
        if(empty($post))
        {
            throw new Exception("Post must have content.");
        }
        $filteredPost = strip_tags($post);

        $this->dbh->insertPost($_SESSION['username'], $filteredPost);
    }

    public function tryVote($postID)
    {
        $this->dbh->updateVote('upvote', $postID);
    }
}