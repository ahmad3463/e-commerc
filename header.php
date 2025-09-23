<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top" id="navbar">
  <div class="container-fluid">
    <!-- Logo -->
    <a class="navbar-brand fw-bold ps-4" href="#">
      Sky<span class="logo">Way</span>
    </a>

    <!-- Mobile toggle -->
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

    <!-- Login/Signup button -->
    <div class="d-flex">
      <a href="login.php" class="btn-custom me-2">Login</a>
      <a href="signup.php" class="btn-custom-outline">Sign Up</a>
    </div>
  </div>
</nav>

<!-- Custom CSS -->
<style>
  /* Navbar glass effect */
  #navbar {
    background: rgba(255, 255, 255, 0.7);
    backdrop-filter: blur(10px);
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
  }

  /* Logo style */
  .navbar-brand {
    font-size: 1.6rem;
    color: #2c3e50;
    letter-spacing: 1px;
  }
  .navbar-brand .logo {
    color: #667eea;
  }

  /* Nav links */
  .nav-link {
    color: #2c3e50 !important;
    position: relative;
    transition: color 0.3s ease;
  }
  .nav-link:hover {
    color: #667eea !important;
  }
  .nav-link.active::after {
    content: "";
    position: absolute;
    bottom: -6px;
    left: 0;
    width: 100%;
    height: 2px;
    background: #667eea;
    border-radius: 5px;
  }

  /* Buttons */
  .btn-custom {
    background: #667eea;
    color: #fff;
    padding: 8px 18px;
    border-radius: 25px;
    text-decoration: none;
    transition: 0.3s;
  }
  .btn-custom:hover {
    background: #5563c1;
    color: #fff;
  }
  .btn-custom-outline {
    border: 2px solid #667eea;
    padding: 8px 18px;
    border-radius: 25px;
    text-decoration: none;
    color: #667eea;
    transition: 0.3s;
  }
  .btn-custom-outline:hover {
    background: #667eea;
    color: #fff;
  }
</style>
