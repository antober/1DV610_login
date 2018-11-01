<?php

class PostView { 
    private static $postButton = 'PostView::postButton';
    private static $postContent = 'PostView::postContent';
    private static $upvoteButton = 'PostView::upvoteButton';
    private static $downvoteButton = 'PostView::downvoteButton';
    private static $postID = "PostView::postID";
    private static $messageId = 'LoginView::Message';
	private $message;
    private $lm;
    private $dbh;

    public function __construct(LoginModel $lm, dbh $dbh) {
        $this->lm = $lm;
        $this->dbh = $dbh;
    }

    public function response() : string {
		$response = '';

		if ($this->lm->isloggedin())
		    $response = $this->generatePostFormHTML();
		
		return $response;
    }

    private function generateAllPosts() : string
    {
        $posts = '';

        foreach ($this->dbh->getAllPosts() as $post) {
            $posts .=
            '
                <div class="postDiv">
                    <form method="post" action="">
                        ' . $post['upvotes'] . '
                        ' . $this->generateUpVoteButtonHTML() . '
                        <input name="' . self::$postID . '" value="' . $post['id'] . '" type="hidden"/>
                        ' . $this->generateDownVoteButtonHTML() . '
                    </form>  
                        Posted by: ' . $post['author'] . ' </br>
                        ' . $post['content']. '
                </div>
                </br>
            ';
        }
        return $posts;
    }

    private function generateUpVoteButtonHTML() : string {
        $res = ''; 

        if(!$_COOKIE[$this->getPostID()]) {
            $res .=
            '
                <input type="submit" id="upvote_btn" name="' . self::$upvoteButton . '" value="Like"/>
            ';
        } else {
            $res;
        }

        return $res;
    }

    private function generateDownVoteButtonHTML() : string {
        $res = '';

        if(!$_COOKIE[$this->getPostID()]) {
            $res .=
            '
                <input type="submit" id="downvote_btn" name="' . self::$downvoteButton . '" value="Dislike"/>
            ';
        } else {
            $res;
        }
        return $res;
    }

    private function generatePostFormHTML() : string {

        return 
        '
            <p id="' . self::$messageId . '">' . $this->message . '</p>
            <div>
                ' . $this->generateAllPosts() . '
            </div>

            <form method="post" action="">
                <br>
                <input type="text" name="' . self::$postContent . '"/>
                <input type="submit" name="' . self::$postButton . '" value="Post" />
            </form>
		';
    }
    
    public function getPost() : string {

        if(isset($_POST[self::$postContent])){
			return $_POST[self::$postContent];
		} else {
            return '';
        }
    }

    public function isPosted() : bool {

        if(isset($_POST[self::$postButton])) {
			return true;
		} else {
			return false;
		}
    }

    public function isDownVoted() : bool {

        if(isset($_POST[self::$downvoteButton])) {
            return isset($_POST[self::$downvoteButton]);
		} else {
			return false;
		}
    }

    public function isUpVoted() : bool {

        if(isset($_POST[self::$upvoteButton])) {
            return isset($_POST[self::$upvoteButton]);
		} else {
			return false;
		}
    }

    public function getPostID(){
        
        if(isset($_POST[self::$postID])) 
			return $_POST[self::$postID];
    }
}