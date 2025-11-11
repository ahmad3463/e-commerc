
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="asessts/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg fixed-top" id="navbar">
  <div class="container-fluid py-2 px-lg-5">
    <!-- Logo -->
    <a class="navbar-brand fw-bold fs-3" href="index.php">
      Sky<span class="logo">Way</span>
    </a>

    <!-- Mobile Toggle -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Links -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0 fw-semibold gap-lg-4">
        <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="shop.php">Shop</a></li>
        <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
        <li class="nav-item"><a class="nav-link" href="blog.php">Blog</a></li>
        <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
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
        <span id="cart-count" class="cart-count position-absolute top-0 start-100 translate-middle  text-dark ic0n-bg shadow-sm">
          <?= $cartCount ?>
        </span>
      </a>

      <?php if(isset($_SESSION['user_id'])): ?>
        <a href="account.php" class="btn-custom"><?= $_SESSION['user_name']?></a>

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
