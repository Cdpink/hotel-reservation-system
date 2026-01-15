<?php
session_start();
include("../../backend/config/database.php");

$guest_id = $_SESSION['guest_id'];

$query = "SELECT res.*, r.room_number, r.image AS room_image, rt.name AS room_type, rt.capacity, rt.price_per_night, rt.amenities, rt.policy, r.description
          FROM reservation res
          JOIN room r ON res.room_id = r.id
          JOIN room_type rt ON r.room_type_id = rt.id
          WHERE res.guest_id = :guest_id
          ORDER BY res.created_at DESC";

$stmt = $pdo->prepare($query);
$stmt->execute(['guest_id' => $guest_id]);
$reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Reservations</title>
</head>
<body>
<h2>All Reservations</h2>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Room Number</th>
        <th>Room Type</th>
        <th>Price Per Night</th>
        <th>Total Price</th>
        <th>Check In</th>
        <th>Check Out</th>
        <th>Status</th>
        <th>Action</th>
    </tr>

    <?php foreach($reservations as $reservation): ?>
        <tr>
            <td><?= htmlspecialchars($reservation['id']) ?></td>
            <td><?= htmlspecialchars($reservation['room_number']) ?></td>
            <td><?= htmlspecialchars($reservation['room_type']) ?></td>
            <td>₱<?= number_format($reservation['price_per_night'], 2) ?></td>
            <td>₱<?= number_format($reservation['total_price'], 2) ?></td>
            <td><?= htmlspecialchars($reservation['check_in']) ?></td>
            <td><?= htmlspecialchars($reservation['check_out']) ?></td>
            <td><?= htmlspecialchars($reservation['status']) ?></td>
            <td>
                <a href="read-one-form.php?id=<?= $reservation['id'] ?>">View</a>
                <a href="update-form.php?id=<?= $reservation['id'] ?>">Edit</a>
                <a href="delete-form.php?id=<?= $reservation['id'] ?>">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
