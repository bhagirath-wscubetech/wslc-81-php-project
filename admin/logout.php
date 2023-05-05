<?php
session_start();
// unset($_SESSION['admin_id']);
// unset($_SESSION['admin_name']);

setcookie('admin_id', $data['admin_id'], time() - 1);
setcookie('admin_name', $data['admin_name'], time() - 1);

header("LOCATION:index.php");
