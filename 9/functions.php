<?php

class News
{
  private $header;
  private $date;
  private $content;
  private $comments;

  public function __construct($header, $date, $content)
  {
    $this->header = $header;
    $this->date = $date;
    $this->content = $content;
  }

  public function getContent()
  {
    return $this->content;
  }

  public function getDate()
  {
    return $this->date;
  }

  public function getHeader()
  {
    return $this->header;
  }

  public function addComments($comments)
  {
    $this->comments = $comments;
  }

  public function getComments()
  {
    return $this->comments;
  }
}


class Comment
{
  private $login;
  private $content;

  public function __construct($login, $content)
  {
    $this->login = $login;
    $this->content = $content;
  }

  public function getLogin()
  {
    return $this->login;
  }

  public function getContent()
  {
    return $this->content;
  }
}
