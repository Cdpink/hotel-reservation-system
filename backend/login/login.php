<?php 
include("../config/database.php");

$email = $_POST["email"];
$password = $_POST["password"];

$query = "SELECT password FROM users WHERE email = :email";
$stmt = $pdo->prepare($query);
$stmt->bindParam(":email", $email);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    if (password_verify($password, $user["password"])) {
        header("Location: ../../frontend/reservation/reservations.php");
        exit();
    } else {
        echo "Wrong password";
    }
} else {
    echo "User not found";
}
?>
