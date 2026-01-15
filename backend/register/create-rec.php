<?php 
include("../config/database.php");

$fullname = $_POST['fullname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$query = "INSERT INTO guest (fullname, email, phone, password)
          VALUES (:fullname, :email, :phone, :password)";

$stmt = $pdo->prepare($query);

$stmt->bindParam(":fullname", $fullname);
$stmt->bindParam(":email", $email);
$stmt->bindParam(":phone", $phone);
$stmt->bindParam(":password", $password);

$stmt->execute();       

header("Location:../../frontend/login/login.php");
exit();
?>
