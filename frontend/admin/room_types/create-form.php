<!DOCTYPE html>
<html>
<head>
    <title>Create Room Type</title>
</head>
<body>
    <h2>Create Room Type</h2>
    <form method="POST" action="../../../backend/admin/room_types/create-rec.php">
        
        <label>Room Class:</label>
        <select name="name" required>
            <option value="">Select Room Class</option>
            <option value="Deluxe">Deluxe</option>
            <option value="Suite">Suite</option>
            <option value="Standard">Standard</option>
            <option value="Single">Single</option>
            <option value="Family">Family</option>
        </select>
        <br><br>

        <label>Price Per Night:</label>
        <input type="number" name="price_per_night" step="0.01" required placeholder="Price Per Night">
        <br><br>

        <label>Capacity:</label>
        <select name="capacity" required>
            <option value="">Select Capacity</option>
            <option value="1">1 Person</option>
            <option value="2">2 Persons</option>
            <option value="3">3 Persons</option>
            <option value="4">4 Persons</option>
            <option value="5">5 Persons</option>
            <option value="6">6 Persons</option>
        </select>
        <br><br>

        <label>Amenities:</label>
        <input type="text" name="amenities" required placeholder="Amenities (comma-separated)">
        <br><br>

        <label>Policy:</label>
        <select name="policy" required>
            <option value="">Select Policy</option>
            <option value="Refundable">Refundable</option>
            <option value="Non-Refundable">Non-Refundable</option>
            <option value="No Cancellation">No Cancellation</option>
        </select>
        <br><br>

        <label>Status:</label>
        <select name="status">
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </select>
        <br><br>

        <button type="submit">Create Room Type</button>
    </form>
</body>
</html>
