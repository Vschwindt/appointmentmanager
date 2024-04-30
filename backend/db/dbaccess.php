<?php
// should probably have this in a generel config file
$db_host = 'localhost';
$db_user = 'bif2webscriptinguser';
$db_password = 'bif2021';
$db_db = 'semesterprojekt2';

$mysqli = @new mysqli(
  $db_host,
  $db_user,
  $db_password,
  $db_db
);

if ($mysqli->connect_error) {
  echo 'Errno: ' . $mysqli->connect_errno;
  echo '<br>';
  echo 'Error: ' . $mysqli->connect_error;
  exit();
}
