<?php 

$room_name = $_POST['room_name'];
$price = $_POST['price'];
$status = $_POST['status'];

$query = "INSERT INTO rooms VALUES(room_name, price, status)";

$stmt = $pdo ->prepare($query);

$stmt -> bindParam(":room_name", $room_name);
$stmt -> bindParam(":price", $price);
$stmt ->bindParam(":status", $status);

$stmt->execute();

header("location: ../../admin/room.php")

?>