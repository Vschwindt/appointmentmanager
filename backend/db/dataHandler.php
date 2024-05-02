<?php
include("./models/appointment.php");
include("./models/comment.php");
include("./models/option.php");
include("./models/voting.php");

class DataHandler
{
    // =========================== READ ==============================================
    
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
    
    public function queryAppointmentById($appointmentId)
    {
        include_once("dbaccess.php");
        $res = array();
        $sql = "SELECT * from appointments a WHERE a.ap_id = ?;";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('s', $appointmentId);
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

    public function queryAppointmentOptions($appointmentId)
    {
        include_once("dbaccess.php");
        $res = array();
        $sql = "SELECT * from options o WHERE o.ap_id = ?;";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('s', $appointmentId);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($optionId, $appointmentId, $start, $end);
        for ($i = 0; $i < $stmt->num_rows; $i++) {
            $stmt->fetch();


            $item = new Option($optionId, $appointmentId, $start, $end);
            array_push($res, $item);
        }
        return $res;
    }

    public function queryAppointmentVotes($appointmentId)
    {
        include_once("dbaccess.php");
        $res = array();
        $sql = "SELECT * from votings v WHERE v.ap_id = ?;";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('s', $appointmentId);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($votingId, $appointmentId, $optionId, $voter_name);
        for ($i = 0; $i < $stmt->num_rows; $i++) {
            $stmt->fetch();
            $item = new Voting($votingId, $appointmentId, $optionId, $voter_name);
            array_push($res, $item);
        }
        return $res;
    }

    public function queryAppointmentComments($appointmentId)
    {
        include_once("dbaccess.php");
        $res = array();
        $sql = "SELECT * from comments c WHERE c.ap_id = ?;";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('s', $appointmentId);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id, $appointmentId, $author, $text);
        for ($i = 0; $i < $stmt->num_rows; $i++) {
            $stmt->fetch();
            $item = new Comment($id, $appointmentId, $author, $text);
            array_push($res, $item);
        }
        return $res;
    }
    
    // =========================== Create ==============================================

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
    
    // =========================== DELETE ==============================================

    public function deleteAppointment($id)
    {
        include_once("dbaccess.php");
        $res = array();
        $sql = "DELETE FROM appointments WHERE ap_id = ?;";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        array_push($res, "Appointment with id=" . $id . " was deleted successfully");
        return $res;
    }
}
