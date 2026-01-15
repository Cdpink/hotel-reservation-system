<?php
session_start();
include("../../backend/config/database.php");

if(!isset($_SESSION['guest_id'])){
    die("Please login first.");
}

$guest_id = $_SESSION['guest_id'];
$reservation_id = $_GET['id'] ?? null;

if(!$reservation_id){
    die("Reservation ID not provided.");
}

$query = "SELECT res.*, r.room_number, rt.price_per_night
          FROM reservation res
          JOIN room r ON res.room_id = r.id
          JOIN room_type rt ON r.room_type_id = rt.id
          WHERE res.id = :reservation_id AND res.guest_id = :guest_id";

$stmt = $pdo->prepare($query);
$stmt->execute(['reservation_id' => $reservation_id, 'guest_id' => $guest_id]);
$reservation = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$reservation){
    die("Reservation not found.");
}

$price_per_night = $reservation['price_per_night'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Reservation</title>
</head>
<body>
<h2>Edit Reservation</h2>

<form method="POST" action="../../backend/reservations/update-rec.php">
    <input type="hidden" name="reservation_id" value="<?= $reservation_id ?>">
    <input type="hidden" id="price_per_night" value="<?= $price_per_night ?>">

    <label>Room Number:</label><br>
    <input type="text" value="<?= htmlspecialchars($reservation['room_number']) ?>" readonly><br><br>

    <label>Check-in:</label><br>
    <input type="date" name="check_in" id="check_in" value="<?= $reservation['check_in'] ?>" required><br><br>

    <label>Check-out:</label><br>
    <input type="date" name="check_out" id="check_out" value="<?= $reservation['check_out'] ?>" required><br><br>

    <label>Total Price:</label><br>
    <input type="number" name="total_price" id="total_price" value="<?= $reservation['total_price'] ?>" readonly><br><br>

    <button type="submit">Update Reservation</button>
    <a href="read-all-form.php">Back to list</a>
</form>

<script>
const checkIn = document.getElementById('check_in');
const checkOut = document.getElementById('check_out');
const totalInput = document.getElementById('total_price');
const pricePerNight = parseFloat(document.getElementById('price_per_night').value);

function calculateTotal() {
    if (!checkIn.value || !checkOut.value) {
        totalInput.value = 0;
        return;
    }
    const inDate = new Date(checkIn.value);
    const outDate = new Date(checkOut.value);
    let nights = (outDate - inDate) / (1000*60*60*24);
    if (nights <= 0) nights = 1;
    totalInput.value = nights * pricePerNight;
}

checkIn.addEventListener('change', calculateTotal);
checkOut.addEventListener('change', calculateTotal);
</script>

</body>
</html>
