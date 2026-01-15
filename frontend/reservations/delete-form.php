<?php
session_start();
include("../../backend/config/database.php");

$guest_id = $_SESSION['guest_id'];
$reservation_id = $_GET['id'] ?? null;

if (!$reservation_id) {
    die("Reservation ID not provided.");
}

$query = "SELECT res.*, r.room_number, r.image AS room_image, rt.name AS room_type, rt.capacity, rt.price_per_night, rt.amenities, rt.policy, r.description
          FROM reservation res
          JOIN room r ON res.room_id = r.id
          JOIN room_type rt ON r.room_type_id = rt.id
          WHERE res.id = :reservation_id AND res.guest_id = :guest_id";

$stmt = $pdo->prepare($query);
$stmt->execute(['reservation_id' => $reservation_id, 'guest_id' => $guest_id]);
$reservation = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$reservation) {
    die("Reservation not found.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Reservation</title>
</head>
<body>
<h2>View Reservation</h2>

<table border="1" cellpadding="8">
    <tr><td>ID</td><td><?= htmlspecialchars($reservation['id']) ?></td></tr>
    <tr><td>Room Number</td><td><?= htmlspecialchars($reservation['room_number']) ?></td></tr>
    <tr><td>Room Type</td><td><?= htmlspecialchars($reservation['room_type']) ?></td></tr>
    <tr><td>Capacity</td><td><?= htmlspecialchars($reservation['capacity']) ?></td></tr>
    <tr><td>Price Per Night</td><td>₱<?= number_format($reservation['price_per_night'], 2) ?></td></tr>
    <tr><td>Status</td><td><?= htmlspecialchars($reservation['status']) ?></td></tr>
    <tr><td>Amenities</td><td><?= htmlspecialchars($reservation['amenities']) ?></td></tr>
    <tr><td>Policy</td><td><?= htmlspecialchars($reservation['policy']) ?></td></tr>
    <tr><td>Image</td>
        <td>
            <?= $reservation['room_image'] ? '<img src="../../frontend/assets/images/' . htmlspecialchars($reservation['room_image']) . '" width="150">' : 'No image'; ?>
        </td>
    </tr>
    <tr><td>Description</td><td><?= htmlspecialchars($reservation['description']) ?></td></tr>
    <tr><td>Total Price</td><td>₱<?= number_format($reservation['total_price'], 2) ?></td></tr>
</table>

<br>

<form method="POST" action="../../backend/reservations/delete-rec.php">
    <input type="hidden" name="reservation_id" value="<?= $reservation['id'] ?>">
    <button type="submit">Delete Reservation</button>
<a href="read-all-form.php">Back to List</a>
</form>


</body>
</html>
