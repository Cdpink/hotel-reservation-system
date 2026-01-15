
<?php 

error_reporting(E_ALL);
ini_set('display_errors', 1);

include("../../../backend/config/database.php");

$id = isset($_GET['id']) ? $_GET['id'] : null;
if (!$id) {
    die('<h2>No room type ID provided.</h2><a href="read-all-form.php">Back</a>');
}

$query = "SELECT * FROM room_type WHERE id = :id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();

$roomtype = $stmt->fetch(PDO::FETCH_ASSOC); 
if (!$roomtype) {
    die('<h2>Room type not found.</h2><a href="read-all-form.php">Back</a>');
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Room Type</title>
</head>
<body>
    <h2>View Room Type</h2>

    <table>
        <tr>
            <td>ID</td>
            <td><?= htmlspecialchars($roomtype['id']) ?></td>
        </tr>
        <tr>
            <td>Room Class</td>
            <td><?= htmlspecialchars($roomtype['name']) ?></td>
        </tr>
        <tr>
            <td>Capacity</td>
            <td><?= htmlspecialchars($roomtype['capacity']) ?> Person(s)</td>
        </tr>
        <tr>
            <td>Price Per Night</td>
            <td>₱<?= number_format($roomtype['price_per_night'], 2) ?></td>
        </tr>
        <tr>
            <td>Amenities</td>
            <td><?= htmlspecialchars($roomtype['amenities']) ?></td>
        </tr>
        <tr>
            <td>Policy</td>
            <td><?= htmlspecialchars($roomtype['policy']) ?></td>
        </tr>
        <tr>
            <td>Status</td>
            <td><?= htmlspecialchars($roomtype['status']) ?></td>
        </tr>
        <tr>
            <td>Created At</td>
            <td><?= htmlspecialchars($roomtype['created_at']) ?></td>
        </tr>
    </table>

    <br>
    <a href="read-all-form.php" class="button">Back</a>

</body>
</html>
