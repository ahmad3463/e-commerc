<?php
$current_page = 'products';
include 'top.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Upload Product</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
      <h4 class="mb-0">Add New Product</h4>
    </div>
    <div class="card-body">
      <form id="productForm" method="POST" action="admin/add-product.php" enctype="multipart/form-data">

        <!-- Product Info -->
        <h5 class="mb-3">Product Information</h5>
        <div class="row mb-3">
          <div class="col-md-6">
            <label class="form-label">Product Name</label>
            <input type="text" class="form-control" name="name" placeholder="Enter product name">
          </div>
          <div class="col-md-6">
            <label class="form-label">Price</label>
            <input type="number" step="0.01" class="form-control" name="price" placeholder="0.00">
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Description</label>
          <textarea class="form-control" name="description" rows="3" placeholder="Enter product description"></textarea>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label class="form-label">Stock</label>
            <input type="number" class="form-control" name="stock" placeholder="Enter stock quantity">
          </div>
        </div>

        <!-- Product Media -->
        <h5 class="mb-3 mt-4">Product Images</h5>
        <div class="mb-3">
          <label class="form-label">Upload Images</label>
          <input type="file" class="form-control" name="images[]" multiple>
          <small class="text-muted">You can select multiple images.</small>
        </div>

        <!-- Product Sizes -->
        <h5 class="mb-3 mt-4">Available Sizes</h5>
        <div class="mb-3">
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="sizes[]" value="S">
            <label class="form-check-label">S</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="sizes[]" value="M">
            <label class="form-check-label">M</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="sizes[]" value="L">
            <label class="form-check-label">L</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="sizes[]" value="XL">
            <label class="form-check-label">XL</label>
          </div>
        </div>

        <!-- Submit -->
        <div class="mt-4">
          <button type="submit" class="btn btn-success">Submit Product</button>
          <button type="reset" class="btn btn-secondary">Reset</button>
        </div>

      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
