<?php include 'config/conn.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link href="asessts/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      min-height: 100vh;
      display: flex;
    }
    .sidebar {
      width: 250px;
      height: 100vh;
      background: #343a40;
      color: #fff;
    }
    .sidebar .nav-link {
      color: #adb5bd;
    }
    .sidebar .nav-link.active,
    .sidebar .nav-link:hover {
      background: #495057;
      color: #fff;
    }
    .content {
      flex-grow: 1;
      padding: 20px;
      background: #f8f9fa;
    }
  </style>
</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar d-flex flex-column p-3">
    <h4 class="text-white mb-4"><?php echo $_SESSION['user_name'] ?></h4>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="dashboard.php" class="nav-link <?php echo ($current_page == 'dashboard') ? 'active' : ''; ?> ">Dashboard</a>
      </li>
        <a href="products.php" class="nav-link  <?php echo ($current_page == 'products') ? 'active' : ''; ?> ">Add-Products</a>
      </li>
      <li>
        <a href="#" class="nav-link"  <?php echo ($current_page == 'orders') ? 'active' : ''; ?> >Orders</a>
      </li>
      <li>
        <a href="#" class="nav-link  <?php echo ($current_page == 'users') ? 'active' : ''; ?> ">Users</a>
      </li>
    </ul>
    <hr>
    <a href="logout.php" class="nav-link text-danger">Logout</a>
  </div>

  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
