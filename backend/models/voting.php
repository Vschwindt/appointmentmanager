<?php
class Voting
{
  public $votingId;
  public $appointmentId;
  public $optionId;
  public $voterName;

  // Constructor to initialize Voting object
  function __construct($votingId, $appointmentId, $optionId, $voterName)
  {
    $this->votingId = $votingId;
    $this->appointmentId = $appointmentId;
    $this->optionId = $optionId;
    $this->voterName = $voterName;
  }
}
