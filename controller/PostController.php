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
        try
        {
            if($this->pv->isPosted())
            {
                $this->pm->tryPost($this->pv->getPost());    
            }
        }
        catch(Exception $e)
        {
            $this->pv->showMessage($e->getMessage());
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