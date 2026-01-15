<?php
include("../../config/database.php");

// Directly get the ID from POST
$id = $_POST['id'];

// Delete the room
$stmt = $pdo->prepare("DELETE FROM room WHERE id = :id");
$stmt->bindParam(":id", $id, PDO::PARAM_INT);
$stmt->execute();

// Redirect back to all Rooms page
header("Location: ../../../frontend/admin/rooms/read-all-form.php?deleted=1");
exit();
?>
