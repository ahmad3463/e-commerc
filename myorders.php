<?php
include 'config/conn.php';
include 'header.php';

if(!isset($_SESSION['user_id'])){
    header('Location: index.php');
    exit;
}

try {
    $user_id = $_SESSION['user_id'];
    
    // Get all orders for this user
    $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY order_date DESC");
    $stmt->execute([$user_id]);
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>

<div class="container mt-5 mb-5 pt-5">
    <h2 class="mb-4">My Orders</h2>

    <?php if(!empty($orders)): ?>
        <?php foreach($orders as $order): ?>

            <?php
            // Fetch items for each order
            $stmt_items = $conn->prepare("
                SELECT oi.*, p.name, 
                       (SELECT pi.image_url FROM product_images pi WHERE pi.product_id = p.id LIMIT 1) AS image_url
                FROM order_items oi
                JOIN products p ON oi.product_id = p.id
                WHERE oi.order_id = ?
            ");
            $stmt_items->execute([$order['id']]);
            $items = $stmt_items->fetchAll(PDO::FETCH_ASSOC);
            ?>

            <div class="card mb-4 shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <strong>Order #<?php echo $order['id']; ?></strong>
                        <span class="ml-3 text-muted"><?php echo date('d M Y', strtotime($order['order_date'])); ?></span>
                    </div>
                    <span class="badge 
                        <?php 
                            if($order['status'] == 'Delivered') echo 'badge-success';
                            elseif($order['status'] == 'Pending') echo 'badge-warning';
                            elseif($order['status'] == 'Cancelled') echo 'badge-danger';
                            else echo 'badge-info';
                        ?>
                    ">
                        <?php echo $order['status']; ?>
                    </span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php foreach($items as $item): ?>
                        <div class="col-md-2 text-center">
                            <img src="img/uploads/<?php echo $item['image_url'] ?? 'placeholder.jpg'; ?>" alt="Product Image" class="img-fluid mb-2" style="height:150px;">
                            <p class="small mb-0"><?php echo htmlspecialchars($item['name']); ?></p>
                            <p class="small text-muted mb-0">Qty: <?php echo $item['quantity']; ?></p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center">
                        <strong>Total: <?php echo number_format($order['total_amount']); ?> PKR</strong>
                      
                    </div>
                </div>
            </div>

        <?php endforeach; ?>
    <?php else: ?>
        <div class="alert alert-info">You have no orders yet.</div>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
