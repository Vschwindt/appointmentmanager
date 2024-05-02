<?php
// Includes necessary model files
include("./models/appointment.php");
include("./models/comment.php");
include("./models/option.php");
include("./models/voting.php");
// Class for handling database operations
class DataHandler
{
  // Retrieves all appointments from the database
  public function queryAppointments()
  {
    include_once("dbaccess.php");
    $res = array();
    $sql = "SELECT * from appointments;";
    $stmt = $mysqli->prepare($sql);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $name, $location, $description, $vote_start, $vote_end, $creator);
    for ($i = 0; $i < $stmt->num_rows; $i++) {
      $stmt->fetch();
      $item = new Appointment($id, $name, $location, $description, $vote_start, $vote_end, $creator);
      array_push($res, $item);
    }
    return $res;
  }
  // Retrieves appointment by ID from the database
  public function queryAppointmentById($ap_id)
  {
    include_once("dbaccess.php");
    $res = array();
    $sql = "SELECT * from appointments a WHERE a.ap_id = ?;";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('s', $ap_id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $name, $location, $description, $vote_start, $vote_end, $creator);
    for ($i = 0; $i < $stmt->num_rows; $i++) {
      $stmt->fetch();
      $item = new Appointment($id, $name, $location, $description, $vote_start, $vote_end, $creator);
      array_push($res, $item);
    }
    return $res;
  }
  // Retrieves options for a specific appointment from the database
  public function queryAppointmentOptions($ap_id)
  {
    include_once("dbaccess.php");
    $res = array();
    $sql = "SELECT * from options o WHERE o.ap_id = ?;";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('s', $ap_id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($op_id, $ap_id, $start, $end);
    for ($i = 0; $i < $stmt->num_rows; $i++) {
      $stmt->fetch();
      $item = new Option($op_id, $ap_id, $start, $end);
      array_push($res, $item);
    }
    return $res;
  }
  // Retrieves votes for a specific appointment from the database
  public function queryAppointmentVotes($ap_id)
  {
    include_once("dbaccess.php");
    $res = array();
    $sql = "SELECT * from votings v WHERE v.ap_id = ?;";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('s', $ap_id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($v_id, $ap_id, $op_id, $voter_name);
    for ($i = 0; $i < $stmt->num_rows; $i++) {
      $stmt->fetch();
      $item = new Voting($v_id, $ap_id, $op_id, $voter_name);
      array_push($res, $item);
    }
    return $res;
  }
  // Retrieves comments for a specific appointment from the database
  public function queryAppointmentComments($ap_id)
  {
    include_once("dbaccess.php");
    $res = array();
    $sql = "SELECT * from comments c WHERE c.ap_id = ?;";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('s', $ap_id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $ap_id, $author, $text);
    for ($i = 0; $i < $stmt->num_rows; $i++) {
      $stmt->fetch();
      $item = new Comment($id, $ap_id, $author, $text);
      array_push($res, $item);
    }
    return $res;
  }
  // Creates a new appointment in the database
  public function createNewAppointment($data)
  {
    include_once("dbaccess.php");
    $res = array();
    $sql = "INSERT INTO appointments (ap_name, `location`, `description`, vote_start, vote_end, creator_name) VALUES (?, ?, ?, ?, ?, ?);";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('ssssss', $data["ap_name"], $data["location"], $data["description"], $data["vote_start"], $data["vote_end"], $data["creator_name"]);
    $stmt->execute();
    $lastInsertId = mysqli_insert_id($mysqli);
    array_push($res, "New appointment was added successfully.");
    array_push($res, $lastInsertId);
    return $res;
  }
  // Creates a new option for an appointment in the database
  public function createNewOption($data)
  {
    include_once("dbaccess.php");
    $res = array();
    $sql = "INSERT INTO `options` (ap_id, op_start, op_end) VALUES (?, ?, ?);";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('iss', $data["ap_id"], $data["op_start"], $data["op_end"]);
    $stmt->execute();
    array_push($res, "New option was added successfully.");
    return $res;
  }
  // Creates a new voting record in the database
  public function createNewVoting($data)
  {
    include_once("dbaccess.php");
    $res = array();
    $sql = "INSERT INTO votings (ap_id, op_id, voter_name) VALUES (?, ?, ?);";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('iis', $data["ap_id"], $data["op_id"], $data["voter_name"]);
    $stmt->execute();
    array_push($res, "New voting was added successfully.");
    return $res;
  }
  // Creates a new comment for an appointment in the database
  public function createNewComment($data)
  {
    include_once("dbaccess.php");
    $res = array();
    $sql = "INSERT INTO comments (ap_id, author_name, comment_text) VALUES (?, ?, ?);";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('iss', $data["ap_id"], $data["author_name"], $data["comment_text"]);
    $stmt->execute();
    array_push($res, "New comment was added successfully.");
    return $res;
  }
  // Deletes an appointment from the database
  public function deleteAppointment($id)
  {
    include_once("dbaccess.php");
    $res = array();
    $sql = "DELETE FROM appointments WHERE ap_id = ?;";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    array_push($res, "Comment with id=" . $id . " was deleted successfully");
    return $res;
  }
}
