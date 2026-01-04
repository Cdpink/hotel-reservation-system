<?php 
include("../config/database.php");

$fullname = $_POST['fullname'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$query = "INSERT INTO users (fullname, email, password)
          VALUES (:fullname, :email, :password)";

$stmt = $pdo->prepare($query);

$stmt->bindParam(":fullname", $fullname);
$stmt->bindParam(":email", $email);
$stmt->bindParam(":password", $password);

$stmt->execute();       

header("Location:../../frontend/login/login.php");
exit();
?>
