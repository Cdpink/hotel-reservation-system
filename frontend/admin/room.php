<!DOCTYPE html>
<html>
    <head>
        <title>Good People - rooms</title>
    </head>
    <body>
        <form method="POST" action="../../backend/rooms/create-room.php">
            <input type="text" name="room_name" require placeholder="Room Name">
            <input type="text" name="price" require placeholder="Price">
            <select name="status">
                <option value="available">Available</option>
                <option value="accupied">Occupied</option>
            </select>
        </form>
    </body>
</html>