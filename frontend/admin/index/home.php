<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../../login/admin-login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <nav>
            <ul>
                <li><a href="#">Dashboard</a></li>
                <li><a href="../../reservations/read-all-form.php">Reservations</a></li>
                <li><a href="../room_types/read-all-form.php">Room Types</a></li>
                <li><a href="../rooms/read-all-form.php">Rooms</a></li>
            </ul>
        </nav>
    </body>
</html>