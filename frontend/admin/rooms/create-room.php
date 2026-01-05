<?php 

include("../../../backend/config/database.php");

$query = "SELECT id, name FROM room_type WHERE status ='active'";
$stmt = $pdo->prepare($query);
$stmt ->execute();

?>

<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    <body>
        <form name="frmRoom" method="POST" action="../../../backend/admin_room/create-room.php" enctype="multipart/form-data">
            <input type="number" name="room_number" required placeholder="Room Number">
            <select name="room_type_id" required> 
                <option value="">Select Room Type </option>

                <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {?>

                <option value="<?= $row['id'] ?>">
                    <?= htmlspecialchars($row['name']) ?>
                </option>
                <?php } ?>
            </select>
            
            <select name="status" required>
                <option value="">Status</option>
                <option value="available">Available</option>
                <option value="occupied">Occupied</option>
                <option value="maintenance">maintenance</option>
            </select>

            <input type="file" name="image" accept="image/*">
            <textarea name="description" required placeholder="Description"></textarea>

            <button type="submit">Submit</button>
        </form>
    </body>
</html>