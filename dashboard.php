<?php
$current_page = 'dashboard';
include "top.php";



?>

<div class="container-fluid p-4">
  <h2 class="mb-4">Admin Dashboard</h2>

  <div class="row">
    <!-- Cards / Stats -->
    <div class="col-md-3">
      <div class="card text-center shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Total Users</h5>
          <p class="card-text fs-4 fw-bold">1,250</p>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card text-center shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Products</h5>
          <p class="card-text fs-4 fw-bold">320</p>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card text-center shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Orders</h5>
          <p class="card-text fs-4 fw-bold">540</p>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card text-center shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Revenue</h5>
          <p class="card-text fs-4 fw-bold">$12,800</p>
        </div>
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
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
      datasets: [{
        label: 'Sales',
        data: [1200, 1900, 3000, 2500, 3200, 4000],
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
