<?php
include 'config/conn.php';


//  Check if order id is provided

if(!isset($_GET['order_id'])){
    die("No order ID provided in URL.");
}
$orderId = $_GET['order_id'];




try {
    // ✅ Fetch order details
    $stmt = $conn->prepare("SELECT o.*, u.name as user_name, u.email 
                            FROM orders o 
                            JOIN users u ON o.user_id = u.id 
                            WHERE o.id = ?");
    $stmt->execute([$orderId]);
    $order = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$order) {
        die("Order not found.");
    }

    // ✅ Fetch order items
    $stmtItems = $conn->prepare("
        SELECT oi.*, p.name, pi.image_url 
        FROM order_items oi
        JOIN products p ON oi.product_id = p.id
        LEFT JOIN product_images pi ON p.id = pi.product_id
        WHERE oi.order_id = ?
        GROUP BY oi.id
    ");
    $stmtItems->execute([$orderId]);
    $items = $stmtItems->fetchAll(PDO::FETCH_ASSOC);

    // ✅ Handle status update
    if (isset($_POST['update'])) {
        $status = $_POST['status'];

        if ($status === "Delivered") {
            $update = $conn->prepare("UPDATE orders SET status=?, delivered_date=NOW() WHERE id=?");
            $update->execute([$status, $orderId]);
        } else {
            $update = $conn->prepare("UPDATE orders SET status=?, delivered_date=NULL WHERE id=?");
            $update->execute([$status, $orderId]);
        }

        header("Location: admin_order_details.php?id=" . $orderId . "&updated=1");
        exit;
    }

} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
<?php if(isset($_GET['success'])): ?>
    <div class="alert alert-success">Order updated successfully!</div>
<?php endif; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin - Order Details</title>
  <link href="asessts/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
    <h2 class="fw-bold mb-4">Order #<?= $order['id'] ?> Details</h2>

    <?php if (isset($_GET['updated'])): ?>
        <div class="alert alert-success">Order updated successfully!</div>
    <?php endif; ?>

    <!-- Order Info -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <p><strong>User:</strong> <?= htmlspecialchars($order['user_name']) ?> (<?= $order['email'] ?>)</p>
            <p><strong>Placed on:</strong> <?= $order['order_date'] ?></p>
            <p><strong>Delivery Date:</strong> <?= $order['delivered_date'] ?? 'Not Delivered' ?></p>
            <p><strong>Status:</strong> <?= $order['status'] ?></p>
            <p><strong>Total:</strong> Rs. <?= number_format($order['total_amount']) ?></p>
        </div>
    </div>

   <!-- Update Order Form -->
<div class="mt-4">
    <form action="update_order.php" method="POST">
        <input type="hidden" name="order_id" value="<?= $order['id'] ?>">

        <div class="mb-3">
            <label for="status" class="form-label">Update Status</label>
            <select name="status" id="status" class="form-select">
                <option value="Pending" <?= $order['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                <option value="Delivered" <?= $order['status'] == 'delivered' ? 'selected' : '' ?>>Delivered</option>
                <option value="Cancelled" <?= $order['status'] == 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Order</button>
    </form>
</div>


    <!-- Order Items -->
    <div class="card shadow-sm">
        <div class="card-body">
            <h5>Items</h5>
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
                        <td>
                            <?php if ($item['image_url']): ?>
                                <img src="img/uploads/<?= $item['image_url'] ?>" width="60" height="60">
                            <?php else: ?>
                                No Image
                            <?php endif; ?>
                        </td>
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
        <a href="admin_orders.php" class="btn btn-outline-secondary">Back to Orders</a>
    </div>
</div>
</body>
</html>
