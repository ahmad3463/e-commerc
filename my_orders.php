<?php
include 'config/conn.php';


if(!isset($_SESSION['user_id'])){
    header('Location: signup.php');
    exit;
}

if($_SESSION['user_id']){

    $userid = $_SESSION['user_id'];

    try {
        $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC ");
        $stmt->execute([$userid]);

        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error" . $e->getMessage();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Orders</title>
  <link href="asessts/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/my_order.css" rel="stylesheet">
</head>
<body>
  
  <div class="container py-5">
    <h2 class="mb-4 fw-bold">My Orders</h2>
    <?php foreach($orders as $order) : ?>
    <!-- Order Card -->
    <div class="card mb-3 order-card shadow-sm">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div>
          <h5 class="mb-1">#<?= $order['id']?></h5>
          <p class="mb-1 text-muted">order on: <?= $order['order_date']?></p>
          <p class="mb-1 text-muted">Placed on: <?= $order['delivered_date']?></p>
          <span class="order-status status-pending"><?= $order['status']?></span>
        </div>
        <div class="text-end">
          <p class="fw-bold mb-1">Total: <?= $order['total_amount'] ?></p>
          <a href="order_details.php?id=<?= $order['id']?>" class="btn btn-outline-primary btn-sm">View Details</a>
        </div>
      </div>
    </div>
    <?php endforeach ?>
  </div>

</body>
</html>
