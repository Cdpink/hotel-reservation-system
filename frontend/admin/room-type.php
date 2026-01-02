<!DOCTYPE html>
<html>
    <head>
        <title>Good People - rooms</title>
    </head>
    <body>
        <form name="frmrooms" method="POST" action="../../backend/room type/create-room-type.php">
            <input type="text" name="room_type" required placeholder="Room Type">
            <input type="text" name="price" required placeholder="Price">
            <input type="text" name="room_number" required placeholder="Room Number">
            <select name="status">
                <option name="Available">Available</option>
                <option name="Occupied">Occupied</option>
                <option name="Active">Active</option>
                <option name="Inactive">Inactive</option>
            </select>
            <button type="submit">Login</button>
        </form>
    </body>
</html>