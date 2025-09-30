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
  <?php include 'header.php' ?>

  <div id="fav-sidebar" class="fav-sidebar">
    <button id="close-sidebar-btn" class="close-sidebar-btn">X</button>
    <h4>Your Favorites</h4>
    <div id="fav-items"></div>
  </div>

  <!-- hero section or carosel -->
  <section class="carousel">

    <div id="hero-carousel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="0" class="active" aria-current="true"
          aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="5000">
          <img src="img/slide-01.jpg.webp" class="d-block w-100" alt="...">
          <div class="carousel-caption top-0 end-100 mt-lg-5 pt-lg-5 me-5 w-50 caro-text">
            <h3 class=" mt-5 pt-5 me-5 fs-5  text-dark ">women Collecton 2024</h3>
            <h1 class=" mt-2 me-5 text-dark">New season</h1>
            <button class="normal me-2 mt-3"> Shop now</button>
          </div>
        </div>
        <div class="carousel-item" data-bs-interval="2000">
          <img src="img/slide-02.jpg.webp" class="d-block w-100" alt="...">
          <div class="carousel-caption top-0 end-100 mt-5 pe-3 pt-5 me-5  w-50 caro-text">
            <h3 class=" mt-5 pt-5 me-5 fs-5 text-dark">Men New-Season</h3>
            <h1 class=" mt-2 me-5 pe-5 text-dark">Jackets & Coats</h1>
            <button class="normal me-2 mt-3"> Shop now</button>
          </div>
        </div>
        <div class="carousel-item">
          <img src="img/slide-03.jpg.webp" class="d-block w-100" alt="...">
          <div class="carousel-caption top-0 end-100 mt-5 pt-5 me-5  w-50 caro-text">
            <h3 class=" mt-5 pt-5 me-5 fs-5 text-dark">Men Collecton 2024</h3>
            <h1 class=" mt-2 me-5 text-dark">New Arrivals</h1>
            <button class="normal me-2 mt-3"> Shop now</button>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#hero-carousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#hero-carousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
  </section>

  <!-- banner section is start -->
  <div class="container text-center margin-m1">
    <div class="row justify-content-center">
      <div class="col-lg-4 col-md-6 mb-sm-2 position-relative hover-col">
        <div class="card">
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
  <div class="row g-4">
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
          <div class="card product-card h-100 shadow-sm border-0">
            <div class="card-img-wrapper">
              <img src="img/uploads/<?= $product['image_url'] ? $product['image_url'] : 'img/no-image.png'; ?>" 
                   class="card-img-top" alt="<?= htmlspecialchars($product['name']); ?>">
             
            </div>
            <div class="card-body">
              <h6 class="card-title mb-2"><?= htmlspecialchars($product['name']); ?></h6>
              <p class="card-price fw-bold text-primary mb-1">Rs <?= number_format($product['price'], 2); ?></p>
              <p class="card-text text-muted small"><?= substr($product['description'], 0, 50); ?>...</p>
              <div class="d-flex justify-content-between align-items-center">
                <a class="btn btn-sm btn-outline-primary" href="add_to_cart.php?id=<?= $product['id']?>">Add to Cart</a>
                <i class="fa-regular fa-heart heart-btn"></i>
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