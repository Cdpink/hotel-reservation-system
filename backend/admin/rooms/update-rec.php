<?php
include("../../config/database.php");

$id = $_POST['id'];
$room_number = $_POST['room_number'];
$room_type_id = $_POST['room_type_id'];
$status = $_POST['status'];
$description = $_POST['description'];

// Get current image if no new image is uploaded
$image_name = null;
if (isset($_FILES['image']) && $_FILES['image']['name']) {
    $image_name = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];
    move_uploaded_file($tmp, "../../../frontend/assets/images/" . $image_name);
} else {
    // Fetch current image from DB
    $stmt = $pdo->prepare("SELECT image FROM room WHERE id = :id");
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $image_name = $row ? $row['image'] : null;
}

$query = "UPDATE room SET room_number = :room_number, room_type_id = :room_type_id, status = :status, image = :image, description = :description WHERE id = :id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(":room_number", $room_number);
$stmt->bindParam(":room_type_id", $room_type_id);
$stmt->bindParam(":status", $status);
$stmt->bindParam(":image", $image_name);
$stmt->bindParam(":description", $description);
$stmt->bindParam(":id", $id, PDO::PARAM_INT);
$stmt->execute();

header("Location: ../../../frontend/admin/rooms/read-all-form.php?updated=1");
exit();
