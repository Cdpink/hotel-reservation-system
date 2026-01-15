<?php
include("../../config/database.php");

$id = $_POST['id'];
$name = $_POST['name'];
$price_per_night = $_POST['price_per_night'];
$capacity = $_POST['capacity'];
$amenities = $_POST['amenities'];
$policy = $_POST['policy'];
$status = $_POST['status'];

$query = "UPDATE room_type 
          SET name = :name,
              price_per_night = :price_per_night,
              capacity = :capacity,
              amenities = :amenities,
              policy = :policy,
              status = :status
          WHERE id = :id";

$stmt = $pdo->prepare($query);
$stmt->bindParam(":name", $name);
$stmt->bindParam(":price_per_night", $price_per_night);
$stmt->bindParam(":capacity", $capacity);
$stmt->bindParam(":amenities", $amenities);
$stmt->bindParam(":policy", $policy);
$stmt->bindParam(":status", $status);
$stmt->bindParam(":id", $id, PDO::PARAM_INT);
$stmt->execute();

header("Location: ../../../frontend/admin/room_types/read-all-form.php?updated=1");
exit();
?>
