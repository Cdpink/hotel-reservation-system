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

// Fetch reservation info
$query = "SELECT res.*, r.room_number, r.image AS room_image, r.description AS room_description,
                 rt.name AS room_type, rt.capacity, rt.price_per_night, rt.amenities, rt.policy
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
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Reservation</title>
</head>
<body>
<h2>Reservation Details</h2>

<table border="1" cellpadding="8">
    <tr>
        <td>ID</td>
        <td><?= htmlspecialchars($reservation['id']) ?></td>
    </tr>
    <tr>
        <td>Status</td>
        <td><?= htmlspecialchars($reservation['status']) ?></td>
    </tr>
    <tr>
        <td>Room Number</td>
        <td><?= htmlspecialchars($reservation['room_number']) ?></td>
    </tr>
    <tr>
        <td>Room Type</td>
        <td><?= htmlspecialchars($reservation['room_type']) ?></td>
    </tr>
    <tr>
        <td>Capacity</td>
        <td><?= htmlspecialchars($reservation['capacity']) ?> Person(s)</td>
    </tr>
    <tr>
        <td>Price Per Night</td>
        <td>₱<?= number_format($reservation['price_per_night'],2) ?></td>
    </tr>
    <tr>
        <td>Total Price</td>
        <td>₱<?= number_format($reservation['total_price'],2) ?></td>
    </tr>
    <tr>
        <td>Amenities</td>
        <td><?= htmlspecialchars($reservation['amenities']) ?></td>
    </tr>
    <tr>
        <td>Policy</td>
        <td><?= htmlspecialchars($reservation['policy']) ?></td>
    </tr>
    <tr><td>Image</td><td>
        <?php if($reservation['room_image']): ?>
            <img src="../../frontend/assets/images/<?= htmlspecialchars($reservation['room_image']) ?>" width="150">
        <?php else: ?>
            No Image
        <?php endif; ?>
    </td></tr>
    <tr><td>Description</td><td><?= htmlspecialchars($reservation['room_description']) ?></td></tr>
</table>

<br>
<a href="read-all-form.php">Back to list</a>
<a href="update-form.php?id=<?= $reservation['id'] ?>">Edit</a>
</body>
</html>
