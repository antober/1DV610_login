<?php

class PostView
{
    private static $postButton = 'PostView::postButton';
    private static $postContent = 'PostView::postContent';
    private static $voteButton = 'PostView::voteButton';
    private static $postID = "PostView::postID";
    private static $messageId = 'LoginView::Message';
	private $message;
    private $lm;
    private $dbh;

    public function __construct(LoginModel $lm, dbh $dbh)
    {
        $this->lm = $lm;
        $this->dbh = $dbh;
    }

    public function showMessage(string $message) : void
	{
		$this->message = $message;
	}

    public function response() : string
	{
		$response = '';

		if ($this->lm->isloggedin())
		{
			$response = $this->generatePostFormHTML();
		}
		return $response;
    }

    private function generateAllPosts() : string
    {
        $posts = '';

        foreach ($this->dbh->getAllPosts() as $post) {
            $posts .=
            '
                <div class="postDiv">
                    <form method="post">
                        '. $post['upvotes'] .' 
                        <input name="' . self::$postID . '" value="' . $post['id'] . '" type="hidden"/>
                        <input type="submit" id="upvote_btn" name="' . self::$voteButton . '" value="Vote"/>
                    </form>  
                        Posted by: ' . $post['author'] . ' </br>
                        ' . $post['content']. '
                </div>
                </br>
            ';
        }
        return $posts;
    }

    //Textarea changed to input because empty field validation failed.
    private function generatePostFormHTML() : string
	{
        return 
        '
            <p id="' . self::$messageId . '">' . $this->message . '</p>
            <div>
                ' . $this->generateAllPosts() . '
            </div>

            <form method="post">
            <br>
            <input type="text" name="' . self::$postContent . '"/>
            <input type="submit" name="' . self::$postButton . '" value="Post" />
            </form>
		';
    }
    
    public function getPost() : string
    {
        if(isset($_POST[self::$postContent]))
		{
			return $_POST[self::$postContent];
		}
		else
        {
            return '';
        }
    }

    public function isPosted() : bool
    {
        if(isset($_POST[self::$postButton])) 
		{
			return true;
		}
		else
		{
			return false;
		}
    }

    public function isVoted() : bool
    {
        if(isset($_POST[self::$voteButton])) 
		{
			return true;
		}
		else
		{
			return false;
		}
    }

    public function getPostID()
    {
        if(isset($_POST[self::$postID])) 
		{
			return $_POST[self::$postID];
		}
    }
}