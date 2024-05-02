<?php
include("businesslogic/simpleLogic.php");

$param = "";
$method = $_SERVER["REQUEST_METHOD"];

// Function to handle requests
function handleRequest($logic, $method, $param) {
    $result = $logic->handleRequest($method, $param);
    if ($result === null) {
        response($method, 400, null);
    } else {
        response($method, 200, $result);
    }
}

// Determine the request method
switch ($method) {
    case "GET":
    case "POST":
        isset($_REQUEST["method"]) ? $method = $_REQUEST["method"] : false;
        isset($_REQUEST["param"]) ? $param = $_REQUEST["param"] : false;
        $logic = new SimpleLogic();
        handleRequest($logic, $method, $param);
        break;
    case "DELETE":
        $logic = new SimpleLogic();
        parse_str(file_get_contents("php://input"), $data);
        $method = $data["method"];
        $param = $data["param"];
        handleRequest($logic, $method, $param);
        break;
    default:
        response($method, 405, null);
        break;
}

// Function to send response
function response($method, $httpStatus, $data) {
    header('Content-Type: application/json');
    http_response_code($httpStatus);
    echo json_encode($data);
}
