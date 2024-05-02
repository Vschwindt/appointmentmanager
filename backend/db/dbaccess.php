<?php
// Database configuration
$db_config = [
    'host' => 'localhost',
    'username' => 'bif2webscriptinguser',
    'password' => 'bif2021',
    'database' => 'semesterprojekt2'
];

// Attempt to connect to the database
$mysqli = @new mysqli(
    $db_config['host'],
    $db_config['username'],
    $db_config['password'],
    $db_config['database']
);

// Check for connection errors
if ($mysqli->connect_error) {
    echo 'Connection Error: ' . $mysqli->connect_error;
    exit();
}
