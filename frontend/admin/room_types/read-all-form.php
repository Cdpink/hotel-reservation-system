<!DOCTYPE html>
<html>
<head>
    <title>All Room Types</title>
</head>
<body>
    <h1>All Room Types</h1>
    <a href='create-form.php' class="create">Create Room Type</a>
    <br><br>
    <table width="100%" border="1" cellpadding="5">
        <tr>
            <th>ID</th>
            <th>Room Class</th>
            <th>Capacity</th>
            <th>Price Per Night</th>
            <th>Amenities</th>
            <th>Policy</th>
            <th>Status</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>

        <?php 
        include("../../../backend/config/database.php");

        $query = "SELECT * FROM room_type ORDER BY id DESC";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $roomtypes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($roomtypes as $roomtype) {
            $id = $roomtype['id'];
            $name = $roomtype['name'];
            $capacity = $roomtype['capacity'];
            $price = number_format($roomtype['price_per_night'], 2);
            $amenities = $roomtype['amenities'];
            $policy = $roomtype['policy'];
            $status = $roomtype['status'];
            $created_at = $roomtype['created_at'];

            echo "<tr>
                    <td>$id</td>
                    <td>$name</td>
                    <td>$capacity Person(s)</td>
                    <td>₱$price</td>
                    <td>$amenities</td>
                    <td>$policy</td>
                    <td>$status</td>
                    <td>$created_at</td>
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
