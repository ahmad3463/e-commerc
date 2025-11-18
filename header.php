
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/PHP-projects/E-CommerceAPI/css/style.css">
<link rel="stylesheet" href="/PHP-projects/E-CommerceAPI/asessts/css/bootstrap.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">


  <style>
    .dropdown-menu{
      display: none;
      position: absolute;
      top: 90%;
      right: 15px;
      background-color: #fff;
      border: 1px solid #ddd;
      border-radius: 8px;
      min-width: 150px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
      z-index: 1000;
    }

    .dropdown-menu li {
      list-style: none;
    }
    .dropdown-menu li a {
  display: block;
  padding: 10px 15px;
  color: #333;
  text-decoration: none;
}

.dropdown-menu li a:hover {
  background: #f0f0f0;
}
.dropdown-menu li a i {
  margin-right: 10px;
}
  </style>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg fixed-top" id="navbar">
  <div class="container-fluid py-2 px-lg-5">
    <!-- Logo -->
    <a class="navbar-brand fw-bold fs-3" href="/PHP-projects/E-CommerceAPI/index.php">
      Sky<span class="logo">Way</span>
    </a>

    <!-- Mobile Toggle -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
<?php
  $active_page = basename($_SERVER['PHP_SELF']);
?>
    <!-- Links -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0 fw-semibold gap-lg-4">
        <li class="nav-item"><a class="nav-link <?= ($active_page == 'index.php') ? 'active' : '' ?>" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link <?= ($active_page == 'shop.php') ? 'active' : '' ?>" href="shop.php">Shop</a></li>
        <li class="nav-item"><a class="nav-link <?= ($active_page == 'about.php') ? 'active' : '' ?>" href="about.php">About</a></li>
        <li class="nav-item"><a class="nav-link <?= ($active_page == 'blog.php') ? 'active' : '' ?>" href="blog.php">Blog</a></li>
        <li class="nav-item"><a class="nav-link <?= ($active_page == 'contact.php') ? 'active' : '' ?>" href="contact.php">Contact</a></li>
      </ul>
    </div>

    <!-- Right Section -->
    <div class="d-flex align-items-center gap-3">
      
      <!-- Favorite Icon -->
      <a href="favorites.php" class="icon-link position-relative">
        <i class="bi bi-heart"></i>
        <span class="fav-count position-absolute top-0 start-100 translate-middle  text-dark shadow-sm ic0n-bg">
        
        </span>
      </a>
      <?php

$cartCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>
      <!-- Cart Icon -->
      <a href="cart.php" class="icon-link position-relative me-5">
        <i class="bi bi-cart3"></i>
        <span id="cart-count" class="cart-count position-absolute top-0 start-100 translate-middle  text-dark icon-bg shadow-sm">
          <?= $cartCount ?>
        </span>
      </a>

      <?php if(isset($_SESSION['user_id'])): ?>
        <div class="account-dropdown">

          <button id="user-btn" class="btn-custom fw-bold"><?= $_SESSION['user_name']?>'s Account</button>
          <ul class="dropdown-menu">
            <li><a href="account.php"><i class="bi bi-person"></i>Manage My Account</a></li>
            <li><a href="myorders.php"><i class="bi bi-box-seam"></i>My Orders</a></li>
            <li><a href="whishlist.php"><i class="bi bi-heart"></i>My Wishlist</a></li>
            <li><a href="logout.php"><i class="bi bi-box-arrow-left"></i>Logout</a></li>
          
          </ul>
        </div>
        <?php else :?>
      <!-- Buttons -->
      <a href="login.php" class="btn-custom">Login</a>
      <a href="signup.php" class="btn-custom-outline">Sign Up</a>
      <?php endif; ?>
    </div>
  </div>
</nav>

</body>
</html>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $('#user-btn').click(function() {
  $('.dropdown-menu').toggle();
});

// Optional: hide when clicking outside
$(document).click(function(e) {
  if (!$(e.target).closest('.account-dropdown').length) {
    $('.dropdown-menu').hide();
  }
});

</script>


