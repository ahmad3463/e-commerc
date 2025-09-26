<?php
$current_page = 'products-list';
include 'top.php';

// Fetch products with one image and sizes
$stmt = $conn->prepare("
    SELECT p.id, p.name, p.description, p.price, p.stock, 
           (SELECT image_url FROM product_images WHERE product_id = p.id LIMIT 1) as image_url,
           GROUP_CONCAT(ps.size) as sizes
    FROM products p
    LEFT JOIN product_sizes ps ON p.id = ps.product_id
    GROUP BY p.id
    ORDER BY p.id ASC
");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-5">
  <div class="card shadow-lg border-0">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
      <h4 class="mb-0">Products List</h4>
      <a href="products.php" class="btn btn-light btn-sm">+ Add New Product</a>
    </div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead class="table-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Image</th>
              <th scope="col">Name</th>
              <th scope="col">Description</th>
              <th scope="col">Price</th>
              <th scope="col">Stock</th>
              <th scope="col">Sizes</th>
              <th scope="col" class="text-center">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php if(count($products) > 0): ?>
              <?php foreach($products as  $product): ?>
                <tr>
                  <td><?php echo $product['id']; ?></td>
                  <td>
                    <?php if($product['image_url']): ?>
                      <img src="img/uploads/<?php echo $product['image_url']; ?>" 
                           alt="<?php echo $product['name']; ?>" 
                           class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                    <?php else: ?>
                      <span class="text-muted">No Image</span>
                    <?php endif; ?>
                  </td>
                  <td><?php echo htmlspecialchars($product['name']); ?></td>
                  <td><?php echo substr(htmlspecialchars($product['description']), 0, 50) . '...'; ?></td>
                  <td><span class="badge bg-success">Rs. <?php echo number_format($product['price']); ?></span></td>
                  <td>
                    <?php if($product['stock'] > 0): ?>
                      <span class="badge bg-info"><?php echo $product['stock']; ?> In Stock</span>
                    <?php else: ?>
                      <span class="badge bg-danger">Out of Stock</span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <?php
                      if($product['sizes']){
                        $sizes = explode(',', $product['sizes']);
                        foreach($sizes as $size){
                          echo "<span class='badge bg-secondary me-1'>".htmlspecialchars($size)."</span>";
                        }
                      } else {
                        echo "<span class='text-muted'>No Sizes</span>";
                      }
                    ?>
                  </td>
                  <td class="text-center">
                    <a href="edit-product.php?id=<?php echo $product['id']; ?>" class="btn btn-sm btn-warning me-2">Edit</a>
                    <a href="delete-product.php?id=<?php echo $product['id']; ?>" class="btn btn-sm btn-danger"
                       onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="8" class="text-center text-muted py-4">No products available.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
