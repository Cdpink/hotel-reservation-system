<!DOCTYPE html>
<html>
<head>
    <title>All Rooms</title>
</head>
<body>
    <h1>All Rooms</h1>
    <a href='../../../frontend/admin/rooms/create-form.php'>Create Rooms</a>
    <table width="100%" border="1" cellpadding="5">
        <tr>
            <th>ID</th>
            <th>Room Number</th>
            <th>Room Type</th>
            <th>Capacity</th>
            <th>Price Per Night</th>
            <th>Status</th>
            <th>Amenities</th>
            <th>Policy</th>
            <th>Image</th>
            <th>Description</th>
            <th>Action</th>
        </tr>

        <?php 
        include("../../../backend/config/database.php");
        
        $query = "SELECT r.id, r.room_number, rt.name AS room_type, rt.capacity, rt.price_per_night, r.status, rt.amenities, rt.policy, r.image, r.description
              FROM room r
              JOIN room_type rt ON r.room_type_id = rt.id
              ORDER BY r.id DESC";

        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($rooms as $room) {
            $id = $room['id'];
            $room_number = $room['room_number'];
            $room_type = $room['room_type'];
            $capacity = $room['capacity'];
            $price = number_format($room['price_per_night'], 2);
            $status = $room['status'];
            $amenities = $room['amenities'];
            $policy = $room['policy'];
            $description = $room['description'];
            $image = $room['image'];

            echo "<tr>
                    <td>$id</td>
                    <td>$room_number</td>
                    <td>$room_type</td>
                    <td>$capacity</td>
                    <td>₱$price</td>
                    <td>$status</td>
                    <td>$amenities</td>
                    <td>$policy</td>
                    <td>";
            if($image) {
                echo "<img src='../../../frontend/assets/images/$image' height='100' alt='Room Image'>";
            } else {
                echo "No Image";
            }
            echo "</td>
                  <td>$description</td>
                  <td>
                    <a href='read-one-form.php?id=$id' class='button'>View</a>
                    <a href='update-form.php?id=$id' class='button'>Edit</a>
                    <a href='delete-form.php?id=$id' class='button'>Delete</a>
                  </td>
                  </tr>";
        }
        ?>
    </table>
</body>
</html>
