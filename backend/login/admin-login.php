<?php
session_start();

$username = $_POST["username"];
$password = $_POST["password"];

// Fixed admin credentials
$fixed_username = "admin101";
$fixed_password = "adminroot";

if ($username === $fixed_username && $password === $fixed_password) {
    $_SESSION['admin_id'] = 1;
    $_SESSION['admin_fullname'] = 'Administrator';
    header("Location:../../frontend/admin/index/home.php");
    exit();
} else {
    echo "Invalid admin credentials.";
}
?>
