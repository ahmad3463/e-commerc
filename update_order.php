<?php
include 'config/conn.php';

// Security check
if (!isset($_POST['order_id']) || !isset($_POST['status'])) {
    die("Invalid request.");
}

$order_id = $_POST['order_id'];
$status   = $_POST['status'];

try {
    $stmt = $conn->prepare("UPDATE orders SET status = ? WHERE id = ?");
    $stmt->execute([$status, $order_id]);

    // Redirect back to details page with success message
    header("Location: admin_orders_details.php?order_id=$order_id&success=1");
    exit;

} catch (PDOException $e) {
    die("Error updating order: " . $e->getMessage());
}
