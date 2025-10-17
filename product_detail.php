<?php
include 'config/conn.php';

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    $stmt = $conn->prepare("SELECT 
    p.id,
    p.name,
    p.description,
    p.price,
    img.image_url,
    GROUP_CONCAT(ps.size) AS sizes
FROM 
    products p
LEFT JOIN 
    product_images img ON p.id = img.product_id
LEFT JOIN 
    product_sizes ps ON p.id = ps.product_id
WHERE 
    p.id = ?
GROUP BY 
    p.id, p.name, p.description, p.price, img.image_url
LIMIT 1
");


    $stmt->execute([$product_id]);

    $product = $stmt->fetch(PDO::FETCH_ASSOC);


}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/product_detail.css">
    <link rel="stylesheet" href="asessts/css/bootstrap.min.css">
</head>

<body class="bg-gray">
    <p id="success-message"></p>

    <?php include 'header.php' ?>
    <div class="container py-5 mt-5">
        <div class="row g-5 align-items-center">

            <!-- Left: Product Image -->
            <div class="col-md-6 text-center">
                <div class="product-image-wrapper shadow-sm rounded-4 p-3 bg-white">
                    <img src="img/uploads/<?= $product['image_url']; ?>" class="img-fluid rounded-3 main-image"
                        alt="<?= htmlspecialchars($product['name']); ?>">
                </div>
            </div>

            <!-- Right: Product Details -->
            <div class="col-md-6">
                <h2 class="fw-bold mb-3"><?= htmlspecialchars($product['name']); ?></h2>
                <p class="text-muted"><?= htmlspecialchars($product['description']); ?></p>
                <h4 class="text-primary fw-semibold mb-3">Rs <?= number_format($product['price'], 2); ?></h4>

                <div class="mb-4">
  <h6 class="fw-semibold mb-2">Available Sizes:</h6>
  <?php 
    $sizes = explode(',', $product['sizes']); 
    foreach ($sizes as $size): 
  ?>
    <button class="btn btn-outline-secondary btn-sm me-2 mb-2 size-btn"><?= trim($size); ?></button>
  <?php endforeach; ?>
</div>

                <!-- Buttons -->
                <div class="d-flex gap-3">
                    <button onclick="addToCart(<?= $product['id'] ?>)" class="btn btn-primary px-4 py-2"><i
                            class="bi bi-cart3 me-2"></i>Add to Cart</button>
                    <button class="btn btn-outline-danger px-4 py-2"><i class="bi bi-heart"></i></button>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php' ?>

</body>

</html>

<script src="js/jquery-3.7.1.min.js"></script>

<script>
let selectedSize = null;

    function addToCart(productId) {
        $.ajax({
            url: 'add_to_cart.php',
            type: 'GET',
            data: { id: productId },
            dataType: 'json',
            success: function (response) {
                if (response.status) {
                    showSuccessMessage('' + response.message);
                    $('#cart-count').text(response.count);
                    // let $count = $('#cart-count');
                    // let currentCount = parseInt($count.text()) || 0;
                    // $count.text(currentCount + 1);
                } else {
                    showSuccessMessage('⚠️ ' + response.message, true);
                }
            },
            error: function () {
                showSuccessMessage(' Something went wrong. Try again later.', true);
            }
        });
    }
    function showSuccessMessage(message, isError = false) {
        let $msg = $('#success-message');

        $msg.text(message)
            .css('background', isError ? 'linear-gradient(90deg, #dc3545, #ff6b6b)' : 'linear-gradient(90deg, #28a745, #20c997)')
            .addClass('show');

        setTimeout(() => {
            $msg.removeClass('show');
        }, 1500);
    }

     //When user clicks a size
  $('.size-btn').on('click', function() {
    $('.size-btn').removeClass('active btn-primary').addClass('btn-outline-secondary');
    $(this).addClass('active btn-primary').removeClass('btn-outline-secondary');
    selectedSize = $(this).text().trim();
  });

  // Add to Cart Click
  $('#addToCartBtn').on('click', function() {
    const productId = $(this).data('id');

    if (!selectedSize) {
      alert('Please select a size first!');
      return;
    }

    $.ajax({
      url: 'add_to_cart.php',
      type: 'GET',
      data: { id: productId, size: selectedSize },
      dataType: 'json',
      success: function(response) {
        if (response.status) {
          alert('Product added to cart!');
        } else {
          alert(response.message);
        }
      },
      error: function() {
        alert('Something went wrong! Try again.');
      }
    });
  });


</script>