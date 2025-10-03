<?php 
$current_page = 'admin_orders';
include 'top.php';



try {
    $stmt = $conn->prepare("
        SELECT 
            o.id ,
            o.total_amount,
            o.created_at AS order_date,
            o.status,
            o.delivered_date,
            u.name AS customer_name,
            u.email AS customer_email
        FROM orders o
        JOIN users u ON o.user_id = u.id
        ORDER BY o.created_at DESC
    ");
    $stmt->execute();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin - Orders</title>
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
    <h2 class="fw-bold mb-4">All Orders</h2>

    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>#Order ID</th>
                <th>Customer</th>
                <th>Email</th>
                <th>Order Date</th>
                <th>Delivered Date</th>
                <th>Status</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
            <tr>
                <td>#<?= $order['id'] ?></td>
                <td><?= htmlspecialchars($order['customer_name']) ?></td>
                <td><?= htmlspecialchars($order['customer_email']) ?></td>
                <td><?= $order['order_date'] ?></td>
                <td><?= $order['delivered_date'] ?? 'N/A' ?></td>
                <td>
                    <span class="badge 
                        <?php 
                            if ($order['status'] == 'pending') echo 'bg-warning';
                            elseif ($order['status'] == 'delivered') echo 'bg-success';
                            else echo 'bg-danger';
                        ?>">
                        <?= $order['status'] ?>
                    </span>
                </td>
                <td>Rs. <?= number_format($order['total_amount']) ?></td>
                <td>
                    <a href="admin_orders_details.php?order_id=<?= $order['id'] ?>" class="btn btn-sm btn-primary">View</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html> 
