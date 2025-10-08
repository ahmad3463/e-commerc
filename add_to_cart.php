<?php
header('Content-Type: application/json');
include 'config/conn.php';

if (!isset($_GET['id'])) {
    echo json_encode(["status" => false, "message" => "No product ID provided"]);
    exit;
}

$product_id = $_GET['id'];

try {
    // ✅ Fetch product details from database
    $stmt = $conn->prepare("
        SELECT p.id, p.name, p.description, p.price, p.stock,
               (SELECT image_url FROM product_images WHERE product_id = p.id LIMIT 1) AS image_url,
               GROUP_CONCAT(ps.size) AS sizes
        FROM products p
        LEFT JOIN product_sizes ps ON p.id = ps.product_id
        WHERE p.id = ?
        GROUP BY p.id, p.name, p.description, p.price, p.stock
    ");
    $stmt->execute([$product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product) {

        $product['sizes'] = $product['sizes'] ? explode(',' , $product['sizes']) : [];

        //  Initialize cart if empty
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        //  Add or update product quantity
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['quantity'] += 1;
        } else {
            $_SESSION['cart'][$product_id] = [
                "id" => $product['id'],
                "name" => $product['name'],
                "description" => $product['description'],
                "price" => $product['price'],
                "stock" => $product['stock'],
                "image_url" => $product['image_url'],
                "sizes" => $product['sizes'],
                "quantity" => 1
            ];
        }

        //  Return JSON response with updated count
        echo json_encode([
            "status" => true,
            "message" => "Product added to cart",
            "count" => count($_SESSION['cart'])
        ]);
    } else {
        echo json_encode(["status" => false, "message" => "Product not found"]);
    }

} catch (PDOException $e) {
    echo json_encode(["status" => false, "message" => "Error: " . $e->getMessage()]);
}
?>
