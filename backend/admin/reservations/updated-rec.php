<?php
include("../../config/database.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $status = $_POST['status'] ?? null;
    $room_status = $_POST['room_status'] ?? null;

    if (!$id || !$status || !$room_status) {
        echo '<p style="color:red;">Missing required fields.</p>';
        echo '<a href="../../../frontend/admin/reservations/read-all-form.php">Back to Reservations List</a>';
        exit;
    }

    $stmt = $pdo->prepare("UPDATE reservation SET status = :status WHERE id = :id");
    $stmt->bindParam(":status", $status);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();

    $stmt2 = $pdo->prepare("SELECT room_id FROM reservation WHERE id = :id");
    $stmt2->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt2->execute();
    $room = $stmt2->fetch(PDO::FETCH_ASSOC);

    if ($room) {
        $room_id = $room['room_id'];
        $stmt3 = $pdo->prepare("UPDATE room SET status = :room_status WHERE id = :room_id");
        $stmt3->bindParam(":room_status", $room_status);
        $stmt3->bindParam(":room_id", $room_id, PDO::PARAM_INT);
        $stmt3->execute();
    }

    echo '<p Reservation and room status updated successfully.</p>';
    echo '<a href="../../../frontend/admin/reservations/read-all-form.php">Back to Reservations List</a>';
    exit;
} else {
    echo '<p Invalid request method.</p>';
    echo '<a href="../../../frontend/admin/reservations/read-all-form.php">Back to Reservations List</a>';
    exit;
}
