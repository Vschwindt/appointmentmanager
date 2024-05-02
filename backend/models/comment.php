<?php
class Comment
{
  public $id;
  public $appointmentId;
  public $author;
  public $text;

  // Constructor to initialize Comment object
  function __construct($id, $appointmentId, $author, $text)
  {
    $this->id = $id;
    $this->appointmentId = $appointmentId;
    $this->author = $author;
    $this->text = $text;
  }
}
