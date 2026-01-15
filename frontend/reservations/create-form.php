<?php
session_start();
include(__DIR__ . "/../../backend/config/database.php");

$room_id = $_GET['id'] ?? null;
if (!$room_id) die("Room ID not provided.");

$query = "SELECT r.id, r.room_number, r.status, rt.price_per_night
          FROM room r
          JOIN room_type rt ON r.room_type_id = rt.id
          WHERE r.id = :room_id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(":room_id", $room_id);
$stmt->execute();
$room = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$room) die("Room not found.");
if ($room['status'] !== 'available') die("Sorry, this room is already booked.");

$room_number = $room['room_number'];
$price_per_night = $room['price_per_night'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Reservation</title>
</head>
<body>

<h2>Create Reservation</h2>

<form method="POST" action="../../backend/reservations/create-rec.php">
    <label>Room Number:</label><br>
    <input type="text" value="<?= htmlspecialchars($room_number) ?>" readonly>
    <input type="hidden" name="room_id" value="<?= $room_id ?>">
    <input type="hidden" id="price_per_night" value="<?= $price_per_night ?>"><br><br>

    <label>Check-in:</label><br>
    <input type="date" name="check_in" id="check_in" required><br><br>

    <label>Check-out:</label><br>
    <input type="date" name="check_out" id="check_out" required><br><br>

    <input type="hidden" name="number_of_guest" value="1">

    <label>Total Price:</label><br>
    <input type="number" name="total_price" id="total_price" readonly><br><br>

    <input type="hidden" name="status" value="pending">

    <button type="submit">Reserve</button>
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
