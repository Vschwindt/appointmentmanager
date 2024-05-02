<?php
class Option
{
  public $optionId;
  public $appointmentId;
  public $start;
  public $end;

  // Constructor to initialize Option object
  function __construct($optionId, $appointmentId, $start, $end)
  {
    $this->optionId = $optionId;
    $this->appointmentId = $appointmentId;
    $this->start = $start;
    $this->end = $end;
  }
}
