<?php
// connection to the database
error_reporting(0); // not show me the warning message
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
