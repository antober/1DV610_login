<?php

class LayoutView 
{
  
  public function render($isLoggedIn, $v, PostView $pv, DateTimeView $dtv) : void
  {
    echo '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <link rel="stylesheet" href="./CSS/style.css">
          <title>Login example</title>
        </head>
        <body>
          <h1>Assignment 2</h1>
          
          ' . $this->renderIsLoggedIn($isLoggedIn) . '
          
          <div class="container">
              ' . $pv->response() . '
              ' . $v->response() . '
              ' . $dtv->show() . '
          </div>
         </body>
      </html>
    ';
  }
  
  private function renderIsLoggedIn($isLoggedIn) : string
  {
    if ($isLoggedIn) 
    {
      return '<h2>Logged in</h2>';
    }
    else 
    {
      return '<h2>Not logged in</h2>';
    }
  }
}
