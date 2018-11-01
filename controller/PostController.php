<?php

class PostController {
    private $pv;
    private $pm;

    public function __construct(PostView $pv, PostModel $pm) {
        $this->pv = $pv;
        $this->pm = $pm;
    }

    public function initPost() : void {
        try {
            if($this->pv->isPosted())
                $this->pm->tryActionPost($this->pv->getPost());    
        } catch(Exception $e) {
            $this->pv->showMessage($e->getMessage());
        }
    }

    public function initVote() : void {
        if($this->pv->isUpVoted())
            $this->pm->doActionVote($this->pv->getPostID());
        
        if($this->pv->isDownVoted())
            $this->pm->doActionDownVote($this->pv->getPostID());
    }
}