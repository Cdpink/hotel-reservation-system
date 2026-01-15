<?php
include("../../config/database.php");

$id = $_POST['id'];

$stmt = $pdo->prepare("DELETE FROM room_type WHERE id = :id");
$stmt->bindParam(":id", $id, PDO::PARAM_INT);
$stmt->execute();

header("Location: ../../../frontend/admin/room_types/read-all-form.php?deleted=1");
exit();
?>
