<?php
session_start();
include("../../backend/config/database.php");

if(!isset($_SESSION['guest_id'])){
    die("Please login first.");
}

$guest_id = $_SESSION['guest_id'];
$reservation_id = $_POST['reservation_id'] ?? null; 

if(!$reservation_id){
    die("Reservation ID not provided.");
}

$stmt = $pdo->prepare("SELECT room_id FROM reservation WHERE id = :reservation_id AND guest_id = :guest_id");
$stmt->execute(['reservation_id' => $reservation_id, 'guest_id' => $guest_id]);
$reservation = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$reservation){
    die("Reservation not found or you do not have permission to delete it.");
}

$updateRoom = $pdo->prepare("UPDATE room SET status = 'available' WHERE id = :room_id");
$updateRoom->execute(['room_id' => $reservation['room_id']]);

$delete = $pdo->prepare("DELETE FROM reservation WHERE id = :reservation_id AND guest_id = :guest_id");
$delete->execute(['reservation_id' => $reservation_id, 'guest_id' => $guest_id]);

header("Location: ../../frontend/reservations/read-all-form.php");
exit();
