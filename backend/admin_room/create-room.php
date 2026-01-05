<?php 

include("../config/database.php");

$room_number = $_POST['room_number'];
$room_type_id = $_POST['room_type_id'];
$status = $_POST['status'];

$image_name = $_FILES['image']['name'];
$tmp        = $_FILES['image']['tmp_name'];

move_uploaded_file($tmp, "../../frontend/assets/images/" . $image_name);
$description = $_POST['description'];

$query = "INSERT INTO room (room_number, room_type_id, status, image, description)
          VALUES (:room_number, :room_type_id, :status, :image, :description)";

$stmt = $pdo->prepare($query);

$stmt->bindParam(":room_number", $room_number);
$stmt->bindParam(":room_type_id", $room_type_id);
$stmt->bindParam(":status", $status);
$stmt->bindParam(":image", $image_name);
$stmt->bindParam(":description", $description);

$stmt->execute();

header("location: ../../frontend/admin/rooms/create-room.php");
exit();
?>