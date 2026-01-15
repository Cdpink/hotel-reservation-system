<?php
session_start();
include("../../backend/config/database.php");

if(!isset($_SESSION['guest_id'])){
    die("Please login first.");
}

$guest_id = $_SESSION['guest_id'];
$reservation_id = $_POST['reservation_id'] ?? null;
$check_in = $_POST['check_in'] ?? null;
$check_out = $_POST['check_out'] ?? null;

if(!$reservation_id || !$check_in || !$check_out){
    die("Missing required data.");
}

$query = "SELECT r.id, rt.price_per_night
          FROM reservation res
          JOIN room r ON res.room_id = r.id
          JOIN room_type rt ON r.room_type_id = rt.id
          WHERE res.id = :reservation_id AND res.guest_id = :guest_id";

$stmt = $pdo->prepare($query);
$stmt->execute(['reservation_id' => $reservation_id, 'guest_id' => $guest_id]);
$reservation = $stmt->fetch(PDO::FETCH_ASSOC);

$checkInDate = new DateTime($check_in);
$checkOutDate = new DateTime($check_out);
$interval = $checkInDate->diff($checkOutDate);
$number_of_nights = $interval->days > 0 ? $interval->days : 1;
$total_price = $number_of_nights * $reservation['price_per_night'];

$update = $pdo->prepare("UPDATE reservation SET check_in = :check_in, check_out = :check_out, total_price = :total_price
                         WHERE id = :reservation_id AND guest_id = :guest_id");

$update->execute([
    'check_in' => $check_in,
    'check_out' => $check_out,
    'total_price' => $total_price,
    'reservation_id' => $reservation_id,
    'guest_id' => $guest_id
]);

header("Location: ../../frontend/reservations/read-all-form.php");
exit();
