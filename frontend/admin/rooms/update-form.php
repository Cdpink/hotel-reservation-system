<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("../../../backend/config/database.php");

if (!isset($_GET['id'])) {
    echo "No ID provided";
    exit;
}

$id = $_GET['id'];

$query = "
    SELECT r.id,r. room_number, r.room_type_id, rt.name AS room_type, r.status, r.image, r.description
    FROM room r
    JOIN room_type rt ON r.room_type_id = rt.id
    WHERE r.id = ?";
    
$stmt = $pdo->prepare($query);
$stmt->bindValue(1, $id, PDO::PARAM_INT);
$stmt->execute();

$room = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$room) {
    echo "Room not found";
    exit;
}

$types = $pdo->query("SELECT * FROM room_type")->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Room</title>
</head>
<body>

<h2>Edit Room</h2>

<form action="../../../backend/admin/rooms/update-rec.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $room['id'] ?>">

    <label>Room Number:</label><br>
    <input type="text" name="room_number" value="<?= $room['room_number'] ?>" required><br><br>

    <label>Room Type:</label><br>
    <select name="room_type_id" required>
        <?php foreach ($types as $type): ?>
            <option value="<?= $type['id'] ?>" <?= $type['id'] == $room['room_type_id'] ? 'selected' : '' ?>>
                <?= $type['name'] ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Status:</label><br>
    <select name="status" required>
        <option value="available" <?= $room['status'] == 'available' ? 'selected' : '' ?>>Available</option>
        <option value="occupied" <?= $room['status'] == 'occupied' ? 'selected' : '' ?>>Occupied</option>
        <option value="maintenance" <?= $room['status'] == 'maintenance' ? 'selected' : '' ?>>Maintenance</option>
    </select><br><br>

    <label>Description:</label><br>
    <textarea name="description" rows="4" cols="50"><?= $room['description'] ?></textarea><br><br>

    <label>Current Image:</label><br>
    <?php if ($room['image']) { ?>
        <img src="../../../frontend/assets/images/<?= $room['image'] ?>" width="150"><br>
    <?php } else { ?>
        No image<br>
    <?php } ?>
    <label>Change Image:</label><br>
    <input type="file" name="image"><br><br>

    <button type="submit">Update Room</button>
</form>

<br>
<a href="read-all-form.php">⬅ Back</a>

</body>
</html>
