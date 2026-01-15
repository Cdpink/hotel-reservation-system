<?php
session_start();
include("../../../backend/config/database.php");

$query = "SELECT res.id, g.fullname AS guest_name, g.email AS guest_email, g.phone AS guest_phone, r.room_number, rt.name AS room_type, res.check_in, res.check_out, res.total_price, res.status, res.created_at
          FROM reservation res
          JOIN guest g ON res.guest_id = g.id
          JOIN room r ON res.room_id = r.id
          JOIN room_type rt ON r.room_type_id = rt.id
          ORDER BY res.created_at DESC";

$stmt = $pdo->prepare($query);
$stmt->execute();
$reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>All Reservations</h2>

<table border="1" cellpadding="5">
    <tr>
           <th>ID</th>
           <th>Guest</th>
           <th>Email</th>
           <th>Phone</th>
           <th>Room</th>
           <th>Room Type</th>
           <th>Check-in</th>
           <th>Check-out</th>
           <th>Total Price</th>
           <th>Status</th>
           <th>Action</th>
    </tr>

<?php foreach($reservations as $reservation): ?>
<tr>
    <td><?= $reservation['id'] ?></td>
    <td><?= htmlspecialchars($reservation['guest_name']) ?></td>
        <td><?= htmlspecialchars($reservation['guest_email']) ?></td>
        <td><?= htmlspecialchars($reservation['guest_phone']) ?></td>
    <td><?= htmlspecialchars($reservation['room_number']) ?></td>
    <td><?= htmlspecialchars($reservation['room_type']) ?></td>
    <td><?= $reservation['check_in'] ?></td>
    <td><?= $reservation['check_out'] ?></td>
    <td>₱<?= number_format($reservation['total_price'], 2) ?></td>
    <td><?= ucfirst($reservation['status']) ?></td>
    <td>
        <?php if($reservation['status'] == 'pending'): ?>
              <a href="../../../backend/admin/reservations/update-rec.php?id=<?= $reservation['id'] ?>&status=confirmed">Confirm</a> |
              <a href="../../../backend/admin/reservations/update-rec.php?id=<?= $reservation['id'] ?>&status=cancelled">Cancel</a>
        <?php else: ?>
            <a href="read-one-form.php?id=<?= $reservation['id'] ?>">Edit Room Status</a>
        <?php endif; ?>
    </td>
</tr>
<?php endforeach; ?>
</table>
