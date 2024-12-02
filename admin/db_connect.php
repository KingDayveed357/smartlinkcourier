<?php
// session_start();

// Define database credentials
$local_host = "localhost";
$local_user = "root";
$local_pass = "";
$local_dbname = "smartlinkcourierservices";

$remote_host = "localhost";
$remote_user = "qbtiafjf_smartlinkcourier";
$remote_pass = "!@#admin!@#";
$remote_dbname = "qbtiafjf_smartlinkcourier";

// Determine if the request is from localhost or remote
$localhost_ips = array('127.0.0.1', '::1');

if (in_array($_SERVER['REMOTE_ADDR'], $localhost_ips)) {
    $conn = new mysqli($local_host, $local_user, $local_pass, $local_dbname);
} else {
    $conn = new mysqli($remote_host, $remote_user, $remote_pass, $remote_dbname);
}

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize input
// function cleaninput($data) {
//     global $conn;
//     $data = trim($data);
//     $data = strip_tags($data);
//     $data = htmlentities($data, ENT_QUOTES, 'UTF-8');
//     $data = $conn->real_escape_string($data);
//     return $data;
// }

// Display all errors (for debugging purposes, should be disabled in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

 