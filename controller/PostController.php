<?php

class PostController
{
    private $pv;
    private $pm;

    public function __construct(PostView $pv, PostModel $pm)
    {
        $this->pv = $pv;
        $this->pm = $pm;
    }

    public function initPost() : void
    {
        if($this->pv->isPosted())
        {
            $this->pm->tryPost($this->pv->getPost());    
        }
    }

    public function initVote()
    {
        if($this->pv->isVoted())
        {
            $this->pm->tryVote($this->pv->getPostID());
        }
    }
}