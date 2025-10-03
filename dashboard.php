<?php
$current_page = 'dashboard';
include "top.php";
try {
    // ✅ Total Users
    $stmt = $conn->query("SELECT COUNT(*) AS total_users FROM users");
    $total_users = $stmt->fetch(PDO::FETCH_ASSOC)['total_users'];

    // ✅ Total Products
    $stmt = $conn->query("SELECT COUNT(*) AS total_products FROM products");
    $total_products = $stmt->fetch(PDO::FETCH_ASSOC)['total_products'];

    // ✅ Total Orders
    $stmt = $conn->query("SELECT COUNT(*) AS total_orders FROM orders");
    $total_orders = $stmt->fetch(PDO::FETCH_ASSOC)['total_orders'];

    // ✅ Total Revenue (sum of all order totals where status is Delivered)
    $stmt = $conn->query("SELECT SUM(total_amount) AS total_revenue FROM orders WHERE status = 'Delivered'");
    $total_revenue = $stmt->fetch(PDO::FETCH_ASSOC)['total_revenue'] ?? 0;

} catch (PDOException $e) {
    die("Error fetching dashboard data: " . $e->getMessage());
}

$stmt = $conn->query("
    SELECT MONTH(order_date) as month, SUM(total_amount) as sales
    FROM orders
    WHERE status = 'Delivered'
    GROUP BY MONTH(order_date)
    ORDER BY month
");
$salesData = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Prepare for JS
$months = [];
$sales = [];
foreach ($salesData as $row) {
    $months[] = date("M", mktime(0,0,0,$row['month'],1));
    $sales[] = (int)$row['sales'];
}

?>

<div class="container-fluid p-4">
  <h2 class="mb-4">Admin Dashboard</h2>

  <div class="row">
    <!-- Cards / Stats -->
    <div class="col-md-3">
  <div class="card text-center shadow-sm">
    <div class="card-body">
      <h5 class="card-title">Total Users</h5>
      <p class="card-text fs-4 fw-bold"><?= number_format($total_users) ?></p>
    </div>
  </div>
</div>

<div class="col-md-3">
  <div class="card text-center shadow-sm">
    <div class="card-body">
      <h5 class="card-title">Products</h5>
      <p class="card-text fs-4 fw-bold"><?= number_format($total_products) ?></p>
    </div>
  </div>
</div>

<div class="col-md-3">
  <div class="card text-center shadow-sm">
    <div class="card-body">
      <h5 class="card-title">Orders</h5>
      <p class="card-text fs-4 fw-bold"><?= number_format($total_orders) ?></p>
    </div>
  </div>
</div>

<div class="col-md-3">
  <div class="card text-center shadow-sm">
    <div class="card-body">
      <h5 class="card-title">Revenue</h5>
      <p class="card-text fs-4 fw-bold">Rs. <?= number_format($total_revenue) ?></p>
    </div>
  </div>
</div>


  <!-- Charts -->
  <div class="row mt-4">
    <div class="col-md-6">
      <div class="card shadow-sm">
        <div class="card-header">Sales Overview</div>
        <div class="card-body">
          <canvas id="salesChart"></canvas>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card shadow-sm">
        <div class="card-header">User Growth</div>
        <div class="card-body">
          <canvas id="userChart"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  // Sales Chart
  const ctx1 = document.getElementById('salesChart');
  new Chart(ctx1, {
    type: 'line',
    data: {
      labels:  <?= json_encode($months) ?>,
      datasets: [{
        label: 'Sales',
        data: <?= json_encode($sales) ?>,
        borderColor: '#007bff',
        backgroundColor: 'rgba(0,123,255,0.2)',
        tension: 0.4,
        fill: true
      }]
    }
  });

  // User Chart
  const ctx2 = document.getElementById('userChart');
  new Chart(ctx2, {
    type: 'bar',
    data: {
      labels: ['2019', '2020', '2021', '2022', '2023'],
      datasets: [{
        label: 'Users',
        data: [500, 1200, 1800, 2500, 3200],
        backgroundColor: '#28a745'
      }]
    }
  });
</script>
