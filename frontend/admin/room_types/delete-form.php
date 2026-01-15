<?php
include("../../../backend/config/database.php");


if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo '<p No room type ID specified.</p>';
    echo '<a href="read-all-form.php">Back to Room Types List</a>';
    exit;
}
$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM room_type WHERE id = :id");
$stmt->bindParam(":id", $id, PDO::PARAM_INT);
$stmt->execute();
$roomType = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Room Type</title>
</head>
<body>
    <h2>Delete Room Type</h2>

    <table border="1" cellpadding="8">
        <tr>
            <td>ID</td>
            <td><?= htmlspecialchars($roomType['id']) ?></td>
        </tr>
        <tr>
            <td>Room Class</td>
            <td><?= htmlspecialchars($roomType['name']) ?></td>
        </tr>
        <tr>
            <td>Price Per Night</td>
            <td><?= htmlspecialchars($roomType['price_per_night']) ?></td>
        </tr>
        <tr>
            <td>Capacity</td>
            <td><?= htmlspecialchars($roomType['capacity']) ?></td>
        </tr>
        <tr>
            <td>Amenities</td>
            <td><?= htmlspecialchars($roomType['amenities']) ?></td>
        </tr>
        <tr>
            <td>Policy</td>
            <td><?= htmlspecialchars($roomType['policy']) ?></td>
        </tr>
        <tr>
            <td>Status</td>
            <td><?= htmlspecialchars($roomType['status']) ?></td>
        </tr>
    </table>

    <br>
    <form method="POST" action="../../../backend/admin/room_types/delete-rec.php">
        <input type="hidden" name="id" value="<?= htmlspecialchars($roomType['id']) ?>">
        <button type="submit">Delete</button>
        <a href="read-all-form.php">Back to Room Types List</a>
    </form>
</body>
</html>
