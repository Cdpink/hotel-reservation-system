<?php 

include("../config/database.php");

$name = $_POST['name'];
$price_per_night = $_POST['price_per_night'];
$capacity = $_POST['capacity'];
$status = $_POST['status'];

$query = "INSERT INTO room_type (name, price_per_night, capacity, status)
          VALUES (:name, :price_per_night, :capacity, :status)";

$stmt = $pdo->prepare($query);

$stmt->bindParam(":name", $name);
$stmt->bindParam(":price_per_night", $price_per_night);
$stmt->bindParam(":capacity", $capacity);
$stmt->bindParam(":status", $status);

$stmt->execute();

header("location: ../../frontend/admin/room-type/room_type_management.php");
exit();
?>