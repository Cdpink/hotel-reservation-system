<?php
session_start();

include(__DIR__ . "/../config/database.php");

if (!isset($_SESSION['guest_id'])) {
    die("Please log in first.");
}

$guest_id = $_SESSION['guest_id'];

$room_id = $_POST['room_id'];
$check_in = $_POST['check_in'];
$check_out = $_POST['check_out'];

$checkInDate = new DateTime($check_in);
$checkOutDate = new DateTime($check_out);
$interval = $checkInDate->diff($checkOutDate);
$number_of_nights = $interval->days > 0 ? $interval->days : 1;

$stmt = $pdo->prepare("
    SELECT rt.price_per_night 
    FROM room r
    JOIN room_type rt ON r.room_type_id = rt.id
    WHERE r.id = :room_id
");
$stmt->bindParam(":room_id", $room_id, PDO::PARAM_INT);
$stmt->execute();
$room = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$room) {
    die("Room not found.");
}

$total_price = $number_of_nights * $room['price_per_night'];
$status = 'pending'; 

$stmt = $pdo->prepare("
    INSERT INTO reservation
    (guest_id, room_id, check_in, check_out, total_price, status, created_at)
    VALUES
    (:guest_id, :room_id, :check_in, :check_out, :total_price, :status, NOW())
");
$stmt->bindParam(":guest_id", $guest_id);
$stmt->bindParam(":room_id", $room_id);
$stmt->bindParam(":check_in", $check_in);
$stmt->bindParam(":check_out", $check_out);
$stmt->bindParam(":total_price", $total_price);
$stmt->bindParam(":status", $status);
$stmt->execute();

$updateRoom = $pdo->prepare("UPDATE room SET status='occupied' WHERE id = :room_id");
$updateRoom->bindParam(":room_id", $room_id);
$updateRoom->execute();

header("Location: ../../frontend/reservations/read-all-form.php");
exit();
?>
