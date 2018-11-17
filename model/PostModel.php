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

    public function calcTimeElapsed($timestamp) {
        $time = strtotime($timestamp);
        $time = time() - $time;
        $time = ($time<1)? 1 : $time;
        $tokens = array (
            31536000 => 'year',
            2592000 => 'month',
            604800 => 'week',
            86400 => 'day',
            3600 => 'hour',
            60 => 'minute',
            1 => 'second'
        );

        foreach ($tokens as $unit => $text) {
            if ($time < $unit) continue;
            $numberOfUnits = floor($time / $unit);
            return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
        }
    }
}