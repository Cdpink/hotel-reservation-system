<?php
session_start();
include("../config/database.php");

$email = $_POST["email"];
$password = $_POST["password"];

$query = "SELECT id, fullname, password FROM guest WHERE email = :email";
$stmt = $pdo->prepare($query);
$stmt->bindParam(":email", $email);
$stmt->execute();

$guest = $stmt->fetch(PDO::FETCH_ASSOC);

if ($guest) {
    if (password_verify($password, $guest["password"])) {

        $_SESSION['guest_id'] = $guest['id'];
        $_SESSION['fullname'] = $guest['fullname'];

        header("Location:../../frontend/index/home.php");
        exit();

    } else {
        echo "Wrong password";
    }
} else {
    echo "User not found";
}
