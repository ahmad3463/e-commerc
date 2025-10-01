
<?php include 'config/conn.php'?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>product</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="asessts/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>

<?php include 'header.php'?>
   <!-- product section is start  -->
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


  <?php include 'footer.php'?>
  <script src="js/script.js"></script>
    
</body>
</html>