<?php
// connection to the database
error_reporting(0); // not show me the warning message
session_start();

$username = "root";
$password = "";
$host = "localhost";
$db = "bakery";

try {
    $conn = new mysqli($host, $username, $password, $db);
} catch (Exception $err) {
    // echo $err->getMessage();
    echo "Internal server error";
    die;
}
