<?php include 'config/conn.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>e-commerce</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="asessts/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
 
</head>

<body>
<p id="success-message"></p>
  <?php include 'header.php' ?> 

 <!-- Hero Section / Carousel -->
<section class="carousel-section">
  <div id="hero-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">

    <!-- Indicators -->
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="0" class="active" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>

    <!-- Slides -->
    <div class="carousel-inner">

      <!-- Slide 1 -->
      <div class="carousel-item active" data-bs-interval="5000">
        <img src="img/slide-01.jpg.webp" class="d-block w-100" alt="Women's Collection 2024">
        <div class="carousel-overlay"></div>
        <div class="carousel-caption text-start animate-caption">
          <h3 class="sub-heading">Women Collection 2024</h3>
          <h1 class="main-heading">New Season</h1>
          <a href="#" class="btn-custom mt-3">Shop Now</a>
        </div>
      </div>

      <!-- Slide 2 -->
      <div class="carousel-item" data-bs-interval="5000">
        <img src="img/slide-02.jpg.webp" class="d-block w-100" alt="Men's Jackets">
        <div class="carousel-overlay"></div>
        <div class="carousel-caption text-start animate-caption">
          <h3 class="sub-heading">Men New-Season</h3>
          <h1 class="main-heading">Jackets & Coats</h1>
          <a href="#" class="btn-custom mt-3">Shop Now</a>
        </div>
      </div>

      <!-- Slide 3 -->
      <div class="carousel-item" data-bs-interval="5000">
        <img src="img/slide-03.jpg.webp" class="d-block w-100" alt="Men's New Arrivals">
        <div class="carousel-overlay"></div>
        <div class="carousel-caption text-start animate-caption">
          <h3 class="sub-heading">Men Collection 2024</h3>
          <h1 class="main-heading">New Arrivals</h1>
          <a href="#" class="btn-custom mt-3">Shop Now</a>
        </div>
      </div>
    </div>

    <!-- Controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#hero-carousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#hero-carousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
    </button>
  </div>
</section>


  <!-- banner section is start -->
  <div class="container text-center margin-m1">
    <div class="row justify-content-center">
      <div class="col-lg-4 col-md-6 mb-sm-2 position-relative hover-col">
        <div class="card" >
          <img src="img/banner-01.jpg.webp" class="card-img-top" alt="...">
        </div>
        <div class="card-body position-absolute top-0  ms-5">
          <h3 class="card-text fw-bolder">Women</h3>
          <p class="fs-6 me-2">spring 2024</p>
        </div>
        <div class="button-container">
          <button class="animated-btn">Shop Now</button>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 position-relative hover-col">
        <div class="card">
          <img src="img/banner-02.jpg.webp" class="card-img-top" alt="...">
        </div>
        <div class="card-body position-absolute top-0  ms-5">
          <h3 class="card-text fw-bolder">Men</h3>
          <p class="fs-6 me-2">spring 2024</p>
        </div>
        <div class="button-container">
          <button class="animated-btn">Shop Now</button>
        </div>
      </div>
      <div class="col-lg-4 col-md-6  position-relative hover-col">
        <div class="card">
          <img src="img/banner-03.jpg.webp" class="card-img-top" alt="...">
        </div>
        <div class="card-body position-absolute top-0 mt-4 ms-5">
          <h3 class="card-text fw-bolder">Accessories</h3>
          <p class="fs-6 me-2">New Trend</p>
        </div>
        <div class="button-container">
          <button class="animated-btn">Shop Now</button>
        </div>
      </div>
    </div>
  </div>

  <!-- dynamic products -->
<div class="container-fluid margin-m1 position-relative py-5">
  <h1 class="fw-bold text-center mb-5">Product Overview</h1>
  <div class="row g-4" >
    <?php
    $stmt = $conn->prepare("SELECT p.id, p.name, p.description, p.price, p.stock, 
       (SELECT image_url FROM product_images WHERE product_id = p.id LIMIT 1) as image_url
          FROM products p
          ORDER BY p.id ASC");
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <?php if ($products): ?>
      <?php foreach ($products as $product): ?>
        <div class="col-lg-3 col-md-4 col-sm-6">
          <div class="card product-card h-100 shadow-sm border-0" >
            <div class="card-img-wrapper" onclick="viewDetail(<?= $product['id'] ?>)">
              <img src="img/uploads/<?= $product['image_url'] ? $product['image_url'] : 'img/no-image.png'; ?>" 
                   class="card-img-top" alt="<?= htmlspecialchars($product['name']); ?>">
             
            </div>
            <div class="card-body">
              <h6 class="card-title mb-2"><?= htmlspecialchars($product['name']); ?></h6>
              <p class="card-price fw-bold text-primary mb-1">Rs <?= number_format($product['price'], 2); ?></p>
              <p class="card-text text-muted small"><?= substr($product['description'], 0, 50); ?>...</p>
              <div class="d-flex justify-content-between align-items-center">
                <a class="btn btn-sm btn-outline-primary" onclick="addToCart(<?= $product['id'] ?>)">Add to Cart</a>
                <i class="fa-regular fa-heart heart-btn" onclick="whishlist(<?= $product['id']?>)"></i>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p class="text-center">No products available</p>
    <?php endif; ?>
  </div>

  <!-- Read more button -->
  <div class="row">
    <div class="col text-center mt-5">
      <a class="btn btn-primary px-4 py-2" href="shop.php">Read More</a>
    </div>
  </div>
</div>



  <!-- footer is start  -->
  <?php include 'footer.php' ?>


  <script src="asessts/js/bootstrap.bundle.min.js"></script>
  <script src="js/script.js"></script>
</body>

</html>

<script src="js/jquery-3.7.1.min.js"></script>


<script>
function addToCart(productId) {
  $.ajax({
    url: 'add_to_cart.php',
    type: 'GET',
    data: { id: productId },
    dataType: 'json',
    success: function(response) {
      if (response.status) {
        showSuccessMessage( response.message);
        $('#cart-count').text(response.count);
    
      } else {
        showSuccessMessage( response.message, true);
      }
    },
    error: function() {
      showSuccessMessage(' Something went wrong. Try again later.', true);
    }
  });
}

/*  Toast-like message display */
function showSuccessMessage(message, isError = false) {
  let $msg = $('#success-message');
  
  $msg.text(message)
      .css('background', isError ? 'linear-gradient(90deg, #dc3545, #ff6b6b)' : 'linear-gradient(90deg, #28a745, #20c997)')
      .addClass('show');

  setTimeout(() => {
    $msg.removeClass('show');
  }, 1500);
}

function viewDetail(productId) {
  window.location.href = "product_detail.php?id=" + productId;
}

function whishlist(productId){
  $.ajax({
    url: 'wishlist.php',
    type: "POST",
   data: {id: productId},
   dataType: 'json',
    success: function(response){
        alert(response.message);
    },
    error: function(xhr, status, error){
      console.log(xhr.responseText);
    }
  })
}
</script>
