<?php
include "app/connection.php";
include "app/helper.php";

$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

// status: 1: Enquiry, 2: Incomplete data, 3: Server error
$resp = [];
if ($name == "" || $email == "" || $subject == "" || $message == "") {
    $resp['message'] = 'Incomplete data';
    $resp['status'] = 0;
} else {
    try {
        $ins = "INSERT INTO contact_us SET name = '$name', email='$email',subject='$subject',message='$message'";
        $conn->query($ins);
        $resp['message'] = 'Enquiry submitted';
        $resp['status'] = 1;
    } catch (Exception $err) {
        $resp['message'] = 'Internal server error';
        $resp['status'] = 0;
    }
}

echo json_encode($resp);
