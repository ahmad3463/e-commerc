<?php
include "config/conn.php";

if (isset($_GET['id'])) {
    $p_editID = $_GET['id'];

    $stmt = $conn->prepare("
        SELECT 
            p.id, 
            p.name, 
            p.description, 
            p.price, 
            p.stock, 
            (SELECT image_url FROM product_images WHERE product_id = p.id LIMIT 1) AS image_url, 
            GROUP_CONCAT(ps.size) AS sizes
        FROM products p 
        LEFT JOIN product_sizes ps ON p.id = ps.product_id
        WHERE p.id = ?
        GROUP BY p.id
    ");
    $stmt->execute([$p_editID]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    // ✅ Split sizes into an array (to avoid undefined variable)
    $product_sizes = !empty($product['sizes']) ? explode(',', $product['sizes']) : [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Product</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="card shadow-lg border-0 rounded-4">
    <div class="card-header bg-primary text-white text-center py-3">
      <h3 class="mb-0">Edit Product</h3>
    </div>

    <div class="card-body p-4">
      <form action="update_product.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $product['id']; ?>">

        <div class="mb-3">
          <label class="form-label fw-semibold">Product Name</label>
          <input type="text" name="name" class="form-control" 
                 value="<?= htmlspecialchars($product['name']); ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold">Description</label>
          <textarea name="description" class="form-control" rows="3" required><?= htmlspecialchars($product['description']); ?></textarea>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Price (Rs)</label>
            <input type="number" name="price" class="form-control" 
                   value="<?= htmlspecialchars($product['price']); ?>" required>
          </div>

          <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Stock</label>
            <input type="number" name="stock" class="form-control" 
                   value="<?= htmlspecialchars($product['stock']); ?>" required>
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label ">Image URL</label><br>
          <img src="img/uploads/<?php echo $product['image_url'] ?>" alt="" style="width:20%;">
          <div class="mt-3">
            <label class="form-label fw-semibold">Upload New Image</label>
            <input type="file" name="new_image" class="form-control" accept="image/*">
            <input type="hidden" name="old_image" value="<?= $product['image_url']; ?>">
            </div>
        </div>

        <div class="mb-4">
          <label class="form-label fw-semibold d-block mb-2">Available Sizes</label>
          <?php
            $allSizes = ['S', 'M', 'L', 'XL'];
            foreach ($allSizes as $s) {
              $checked = in_array($s, $product_sizes) ? 'checked' : '';
              echo "
              <div class='form-check form-check-inline'>
                <input class='form-check-input' type='checkbox' name='sizes[]' value='$s' id='size_$s' $checked>
                <label class='form-check-label' for='size_$s'>$s</label>
              </div>
              ";
            }
          ?>
        </div>

        <div class="text-center">
          <button type="submit" class="btn btn-success px-5">Update Product</button>
          <a href="products-list.php" class="btn btn-secondary ms-2">Cancel</a>
        </div>
      </form>
    </div>
  </div>
</div>

</body>
</html>
