<?php
include("../../../backend/config/database.php");


if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo '<p style="color:red;">No room type ID specified.</p>';
    echo '<a href="read-all-form.php">Back to Room Types List</a>';
    exit;
}
$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM room_type WHERE id = :id");
$stmt->bindParam(":id", $id, PDO::PARAM_INT);
$stmt->execute();

$roomType = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$roomType) {
    echo '<p Room type not found or query error.</p>';
    echo '<a href="read-all-form.php">Back to Room Types List</a>';
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Room Type</title>
</head>
<body>
    <h2>Update Room Type</h2>

    <form method="POST" action="../../../backend/admin/room_types/update-rec.php">
        <input type="hidden" name="id" value="<?= htmlspecialchars($roomType['id']) ?>">

        <label>Room Class:</label>
        <select name="name" required>
            <option value="Deluxe" <?= htmlspecialchars($roomType['name']) == 'Deluxe' ? 'selected' : '' ?>>Deluxe</option>
            <option value="Suite" <?= htmlspecialchars($roomType['name']) == 'Suite' ? 'selected' : '' ?>>Suite</option>
            <option value="Standard" <?= htmlspecialchars($roomType['name']) == 'Standard' ? 'selected' : '' ?>>Standard</option>
            <option value="Single" <?= htmlspecialchars($roomType['name']) == 'Single' ? 'selected' : '' ?>>Single</option>
            <option value="Family" <?= htmlspecialchars($roomType['name']) == 'Family' ? 'selected' : '' ?>>Family</option>
        </select>
        <br><br>

        <label>Price Per Night:</label>
        <input type="number" name="price_per_night" step="0.01" required value="<?= htmlspecialchars($roomType['price_per_night']) ?>">
        <br><br>

        <label>Capacity:</label>
        <select name="capacity" required>
            <?php
            for ($i = 1; $i <= 6; $i++) {
                $selected = htmlspecialchars($roomType['capacity']) == $i ? 'selected' : '';
                echo "<option value='$i' $selected>$i Person(s)</option>";
            }
            ?>
        </select>
        <br><br>

        <label>Amenities:</label>
        <input type="text" name="amenities" required value="<?= htmlspecialchars($roomType['amenities']) ?>">
        <br><br>

        <label>Policy:</label>
        <select name="policy" required>
            <option value="Refundable" <?= htmlspecialchars($roomType['policy']) == 'Refundable' ? 'selected' : '' ?>>Refundable</option>
            <option value="Non-Refundable" <?= htmlspecialchars($roomType['policy']) == 'Non-Refundable' ? 'selected' : '' ?>>Non-Refundable</option>
            <option value="No Cancellation" <?= htmlspecialchars($roomType['policy']) == 'No Cancellation' ? 'selected' : '' ?>>No Cancellation</option>
        </select>
        <br><br>

        <label>Status:</label>
        <select name="status">
            <option value="active" <?= htmlspecialchars($roomType['status']) == 'active' ? 'selected' : '' ?>>Active</option>
            <option value="inactive" <?= htmlspecialchars($roomType['status']) == 'inactive' ? 'selected' : '' ?>>Inactive</option>
        </select>
        <br><br>

        <button type="submit">Update Room Type</button>
    </form>

    <br>
    <a href="read-all-form.php">Back to Room Types List</a>
</body>
</html>
