<?php 
include("../config/database.php");

$email = $_POST['email'];
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$query = "INSERT INTO users (email, username, password)
          VALUES (:email, :username, :password)";

$stmt = $pdo->prepare($query);

$stmt->bindParam(":email", $email);
$stmt->bindParam(":username", $username);
$stmt->bindParam(":password", $password);

$stmt->execute();       

header("Location: ../../frontend/login/login.php");
exit();
?>
