<?php
session_start();
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "smartlinkcourierservices";


     //check whether on localhost or online
  $localhost = array(
      '127.0.0.1',
      '::1'
  );

  if(in_array($_SERVER['REMOTE_ADDR'], $localhost)){
      $conn=new mysqli("localhost","root","","smartlinkcourierservices");
  }
  else {
    $conn=new mysqli("localhost","qbtiafjf_smartlinkcourier","!@#admin!@#","qbtiafjf_smartlinkcourier");
  }


function cleaninput($data){
    GLOBAL $conn;
    $data = trim($data);
    $data = strip_tags($data);
    $data = htmlentities($data);
    $data = $conn->real_escape_string($data);
    return $data;
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

