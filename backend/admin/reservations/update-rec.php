<?php
session_start();
include("../../../backend/config/database.php");

$id = $_GET['id'] ?? null;
$new_status = $_GET['status'] ?? null;

if (!$id || !$new_status) {
    die("Reservation ID or status not provided.");
}

$stmt = $pdo->prepare("UPDATE reservation SET status = ? WHERE id = ?");
$stmt->execute([$new_status, $id]);

$stmt2 = $pdo->prepare("SELECT room_id FROM reservation WHERE id = ?");
$stmt2->execute([$id]);
$room = $stmt2->fetch(PDO::FETCH_ASSOC);

if ($room) {
    if ($new_status == 'confirmed') {
        $updateRoom = $pdo->prepare("UPDATE room SET status='occupied' WHERE id=?");
        $updateRoom->execute([$room['room_id']]);
    } elseif ($new_status == 'cancelled') {
        $updateRoom = $pdo->prepare("UPDATE room SET status='available' WHERE id=?");
        $updateRoom->execute([$room['room_id']]);
    }
}


header("Location: ../../../frontend/admin/reservations/read-all-form.php");
exit();
?>
