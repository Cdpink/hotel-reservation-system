<?php 
include("../config/database.php");

$fullname = $_POST['fullname'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$query = "INSERT INTO users (fullname, username, email, password)
          VALUES (:fullname, :username, :email, :password)";

$stmt = $pdo->prepare($query);

$stmt->bindParam(":username", $username);
$stmt->bindParam(":email", $email);
$stmt->bindParam(":password", $password);

$stmt->execute();       

header("Location:../../frontend/login/login.php");
exit();
?>
