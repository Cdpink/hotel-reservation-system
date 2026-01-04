<?php 
include("../config/database.php");

$email = $_POST["email"];
$password = $_POST["password"];

$query = "SELECT password FROM guest WHERE email = :email";
$stmt = $pdo->prepare($query);
$stmt->bindParam(":email", $email);
$stmt->execute();

$guest = $stmt->fetch(PDO::FETCH_ASSOC);

if ($guest) {
    if (password_verify($password, $guest["password"])) {
        header("Location: ../../frontend/guest/home.php");
        exit();
    } else {
        echo "Wrong password";
    }
} else {
    echo "User not found";
}
?>
