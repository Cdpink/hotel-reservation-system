<?php
include("../../config/database.php");

$name = $_POST['name'];
$price_per_night = $_POST['price_per_night'];
$capacity = $_POST['capacity'];
$amenities = $_POST['amenities'];
$policy = $_POST['policy'];
$status = $_POST['status'] ?? 'active';

$query = "INSERT INTO room_type 
(name, price_per_night, capacity, amenities, policy, status, created_at)
VALUES
(:name, :price_per_night, :capacity, :amenities, :policy, :status, NOW())";

$stmt = $pdo->prepare($query);
$stmt->bindParam(":name", $name);
$stmt->bindParam(":price_per_night", $price_per_night);
$stmt->bindParam(":capacity", $capacity);
$stmt->bindParam(":amenities", $amenities);
$stmt->bindParam(":policy", $policy);
$stmt->bindParam(":status", $status);
$stmt->execute();

header("Location: ../../../frontend/admin/room_types/create-form.php");
exit();
?>
