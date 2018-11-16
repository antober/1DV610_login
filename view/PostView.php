<?php

class PostView { 
    
    private static $messageId = 'LoginView::Message';
    private static $postButton = 'PostView::postButton';
    private static $postContent = 'PostView::postContent';
    private static $upvoteButton = 'PostView::upvoteButton';
    private static $downvoteButton = 'PostView::downvoteButton';
    private static $deleteButton = 'PostView::deleteButton';
    private static $postID = "PostView::postID";
    private static $postContainer = 'postContainer';
    private static $postInfo = 'postInfo';
    private static $postBody = 'postBody';
    private static $upvote_btn = 'upvote_btn';
    private static $downvote_btn = 'downvote_btn';
    private static $delete_btn = 'delete_btn';
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

    public function showMessage(string $message) : void {
		$this->message = $message;
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

    public function isDeleted() : bool {
        if(isset($_POST[self::$deleteButton])) {
            echo 'isDeleteted';
            return isset($_POST[self::$deleteButton]);
		} else {
			return false;
		}
    }

    public function getPostID(){
        if(isset($_POST[self::$postID])) 
			return $_POST[self::$postID];
    }

    private function generateAllPosts() : string {
        $posts = '';

        foreach ($this->dbh->getAllPosts() as $post) {
            $posts .=
            '
                <div class="'.self::$postContainer.'">
                    <div class="' .self::$postInfo. '">
                        Posted by: ' . $post['author'] . ' </br>
                    </div>  
                        <form method="post" action="">
                            ' . $post['upvotes'] . '
                            ' . $this->generateUpVoteButtonHTML() . '
                            <input name="' . self::$postID . '" value="' . $post['id'] . '" type="hidden"/>
                            ' . $this->generateDownVoteButtonHTML() . '
                            ' . $this->generateDeletePostButtonHTML() .'
                        </form>
                    <div class="' .self::$postBody. '">
                        ' . $post['content']. '
                    </div>
                </div>
                </br>
            ';
        }
        return $posts;
    }

    private function generateUpVoteButtonHTML() : string {
        $res = ''; 

        $res .=
            '
                <input type="submit" id="' . self::$upvote_btn . '" 
                name="' . self::$upvoteButton . '" value="Like"/>
            ';

        return $res;
    }

    private function generateDownVoteButtonHTML() : string {
        $res = '';

        $res .=
            '
                <input type="submit" id="' . self::$downvote_btn . '" 
                name="' . self::$downvoteButton . '" value="Dislike"/>
            ';

        return $res;
    }

    private function generateDeletePostButtonHTML() : string {
        $res = '';

        $res .= 
            '
                <input type="submit" id="' . self::$delete_btn . '" 
                name="' . self::$downvoteButton . '" value="Delete"/>
            ';
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
}