<?php
include 'config/conn.php';


if (!isset($_GET['order_id'])) {
    header("Location: cart.php");
    exit;
}

$orderId = (int)$_GET['order_id'];

// Fetch order details
$stmt = $conn->prepare("SELECT * FROM orders WHERE id = ?");
$stmt->execute([$orderId]);
$order = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$order) {
    echo "<div class='container mt-5'><div class='alert alert-danger'>Order not found.</div></div>";
    exit;
}

// Fetch order items
$stmtItems = $conn->prepare("
    SELECT oi.*, p.name AS product_name 
    FROM order_items oi
    JOIN products p ON oi.product_id = p.id
    WHERE oi.order_id = ?
");
$stmtItems->execute([$orderId]);
$orderItems = $stmtItems->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include 'header.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success</title>
    <link href="asessts/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5 mt-5">
    <div class="card shadow-sm">
        <div class="card-body text-center">
            <h2 class="text-success fw-bold">🎉 Thank You!</h2>
            <p class="lead">Your order has been placed successfully.</p>
            <p class="fw-bold">Order ID: #<?= $order['id'] ?></p>
            <hr>

            <h5 class="fw-bold mb-3">Order Summary</h5>
            <ul class="list-group mb-3">
                <?php foreach ($orderItems as $item): ?>
                    <li class="list-group-item d-flex justify-content-between">
                        <div>
                            <?= htmlspecialchars($item['product_name']) ?>
                            <small class="text-muted">(x<?= $item['quantity'] ?>)</small>
                        </div>
                        <span>Rs. <?= number_format($item['price'] * $item['quantity']) ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>

            <h4 class="fw-bold text-danger">Total: Rs. <?= number_format($order['total_amount']) ?></h4>

            <div class="mt-4">
                <a href="shop.php" class="btn btn-primary">🛍 Continue Shopping</a>
                <a href="my_orders.php" class="btn btn-outline-secondary">📦 View My Orders</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>
