<?php
include("../../../backend/config/database.php");

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo '<p style="color:red;">No reservation ID specified.</p>';
    echo '<a href="read-all-form.php">Back to Reservations List</a>';
    exit;
}
$id = $_GET['id'];

$query = "SELECT res.*, r.status AS room_status FROM reservation res JOIN room r ON res.room_id = r.id WHERE res.id = :id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(":id", $id, PDO::PARAM_INT);
$stmt->execute();
$reservation = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$reservation) {
    echo '<p style="color:red;">Reservation not found.</p>';
    echo '<a href="read-all-form.php">Back to Reservations List</a>';
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Reservation</title>
</head>
<body>
    <h2>Edit Reservation</h2>
    <form method="POST" action="../../../backend/admin/reservations/updated-rec.php">
        <input type="hidden" name="id" value="<?= htmlspecialchars($reservation['id']) ?>">
        <label>Status:</label>
        <select name="status">
            <option value="pending" <?= $reservation['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
            <option value="confirmed" <?= $reservation['status'] == 'confirmed' ? 'selected' : '' ?>>Confirmed</option>
            <option value="cancelled" <?= $reservation['status'] == 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
        </select>
        <br><br>
        <label>Room Status:</label>
        <select name="room_status">
            <option value="available" <?= $reservation['room_status'] == 'available' ? 'selected' : '' ?>>Available</option>
            <option value="occupied" <?= $reservation['room_status'] == 'occupied' ? 'selected' : '' ?>>Occupied</option>
            <option value="maintenance" <?= $reservation['room_status'] == 'maintenance' ? 'selected' : '' ?>>Maintenance</option>
        </select>
        <br><br>
        <button type="submit">Update Reservation</button>
        <a href="read-all-form.php">Back to Reservations List</a>
    </form>
</body>
</html>
