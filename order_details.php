<?php
include 'config/conn.php';


// 1. Security checks
if (!isset($_SESSION['user_id']) || !isset($_GET['id'])) {
    header('Location: signup.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$orderId = $_GET['id'];

try {
    // 2. Fetch order info
    $stmt = $conn->prepare("SELECT * FROM orders WHERE id = ? AND user_id = ?");
    $stmt->execute([$orderId, $user_id]);
    $order = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$order) {
        die("Order not found or you don’t have access.");
    }

    // 3. Fetch order items with product details
    $stmtItems = $conn->prepare("
        SELECT  oi.*, p.name,  (SELECT pi.image_url FROM product_images pi WHERE pi.product_id = p.id  LIMIT 1) AS image_url
                FROM order_items oi
                JOIN products p ON oi.product_id = p.id
                WHERE oi.order_id = ?

    ");
    $stmtItems->execute([$orderId]);
    $items = $stmtItems->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Details</title>
  <link href="asessts/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
    <h2 class="fw-bold mb-4">Order Details</h2>

    <!-- Order Info Card -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h5 class="card-title">Order #<?= $order['id'] ?></h5>
            <p class="mb-1"><strong>Placed on:</strong> <?= $order['created_at'] ?></p>
            <p class="mb-1"><strong>Status:</strong> 
                <span class="badge 
                    <?php 
                        if ($order['status'] == 'Pending') echo 'bg-warning';
                        elseif ($order['status'] == 'Delivered') echo 'bg-success';
                        else echo 'bg-danger';
                    ?>">
                    <?= $order['status'] ?>
                </span>
            </p>
            <p class="mb-1"><strong>Delivery Date:</strong> 
                <?= $order['delivered_date'] ?? 'Not Delivered Yet' ?>
            </p>
            <p class="mb-0"><strong>Total Amount:</strong> Rs. <?= number_format($order['total_amount']) ?></p>
        </div>
    </div>

    <!-- Order Items Table -->
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="mb-3">Items in this Order</h5>
            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Product</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['name']) ?></td>
                        <td><img src="img/uploads/<?= $item['image_url'] ?>" width="60" height="60" class="rounded"></td>
                        <td>Rs. <?= number_format($item['price']) ?></td>
                        <td><?= $item['quantity'] ?></td>
                        <td>Rs. <?= number_format($item['price'] * $item['quantity']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Back Button -->
    <div class="mt-3">
        <a href="my_orders.php" class="btn btn-outline-secondary">Back to Orders</a>
    </div>
</div>
</body>
</html>
