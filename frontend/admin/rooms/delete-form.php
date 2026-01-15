<?php
include("../../../backend/config/database.php");


if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo '<p No room ID specified.</p>';
    echo '<a href="read-all-form.php">Back to Room List</a>';
    exit;
}
$id = $_GET['id'];

$query = "SELECT r.id, r.room_number, r.status, r.image, r.description, rt.name AS room_type
          FROM room r
          JOIN room_type rt ON r.room_type_id = rt.id
          WHERE r.id = :id";

$stmt = $pdo->prepare($query);
$stmt->bindParam(":id", $id, PDO::PARAM_INT);
$stmt->execute();


$room = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$room) {
    echo '<p Room not found or query error.</p>';
    echo '<a href="read-all-form.php">Back to Room List</a>';
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Room</title>
</head>
<body>
    <h2>Delete Room</h2>

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

    <br>

    <form method="POST" action="../../../backend/admin/rooms/delete-rec.php">
        <input type="hidden" name="id" value="<?= htmlspecialchars($room['id']) ?>">
        <button type="submit">Delete</button>
        <a href="read-all-form.php">Back to Room Types List</a>
    </form>
</body>
</html>
