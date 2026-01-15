<?php 

error_reporting(0);

include("../../../backend/config/database.php");

$id = $_GET['id'];


$query = "SELECT r.id, r.room_number, rt.name AS room_type, rt.capacity, rt.price_per_night, rt.amenities, rt.policy, r.status, r.image, r.description
          FROM room r
          JOIN room_type rt ON r.room_type_id = rt.id
          WHERE r.id = ?";

$stmt = $pdo->prepare($query);
$stmt->bindValue(1, $id, PDO::PARAM_INT);
$stmt->execute();

$room = $stmt->fetch(PDO::FETCH_ASSOC); 

?>

<!DOCTYPE html>
<html>
<head>
    <title>View Room Record</title>
</head>
<body>
    <h2>View Room Record</h2>

    <table border="1" cellpadding="8">
        <tr>
            <td>ID</td>
            <td><?= htmlspecialchars($room['id']) ?></td>
        </tr>
        <tr>
            <td>Room Number</td>
            <td><?= htmlspecialchars($room['room_number']) ?></td>
        </tr>
        <tr>
            <td>Room Type</td>
            <td><?= htmlspecialchars($room['room_type']) ?></td>
        </tr>
        <tr>
            <td>Capacity</td>
            <td><?= htmlspecialchars($room['capacity']) ?></td>
        </tr>
        <tr>
            <td>Price Per Night</td>
            <td>₱<?= number_format($room['price_per_night'], 2) ?></td>
        </tr>
        <tr>
            <td>Amenities</td>
            <td><?= htmlspecialchars($room['amenities']) ?></td>
        </tr>
        <tr>
            <td>Policy</td>
            <td><?= htmlspecialchars($room['policy']) ?></td>
        </tr>
        <tr>
            <td>Status</td>
            <td><?= htmlspecialchars($room['status']) ?></td>
        </tr>
        <tr>
            <td>Image</td>
            <td>
                <?= $room['image'] ? '<img src="../../../frontend/assets/images/' . htmlspecialchars($room['image']) . '" width="150">' : 'No image'; ?>
            </td>
        </tr>
        <tr>
            <td>Description</td>
            <td><?= htmlspecialchars($room['description']) ?></td>
        </tr>
    </table>
        <tr>
            <td>
                <a href='read-all-form.php' class='button'>Back</a>
            </td>
        </tr>
</body>
</html>
