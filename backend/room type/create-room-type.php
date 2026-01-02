<?php 

include("../config/database.php");

$room_type = $_POST['room_type'];
$price = $_POST['price'];
$room_number = $_POST['room_number'];
$status = $_POST['status'];

$query = "INSERT INTO room (room_type, price, room_number, status)
       VALUES(:room_type, :price, :room_number, :status)";

$stmt = $pdo->prepare($query);

$stmt->bindParam(":room_type", $room_type);
$stmt->bindParam(":price", $price);
$stmt->bindParam(":room_number", $room_number);
$stmt->bindParam(":status", $status);

$stmt->execute();

header("location: ../../frontend/admin/room-type.php");
exit();

?>