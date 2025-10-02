<?php
include 'config/conn.php';

// 1. Check if cart exists
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header('Location: cart.php');
    exit;
}

// 2. Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: signup.php');
    exit;
}

// 3. Get form inputs
$name    = trim($_POST['name']);
$email   = trim($_POST['email']);
$address = trim($_POST['address']);
$phone   = trim($_POST['phone']);

// Basic validation
if (empty($name) || empty($email) || empty($address) || empty($phone)) {
    die("All fields are required.");
}

// 4. Insert order into DB
try {
    $conn->beginTransaction();

    // Insert order
    $stmt = $conn->prepare("INSERT INTO orders (user_id, name, email, address, phone, total_amount, created_at)
                            VALUES (?, ?, ?, ?, ?, ?, now())");

    $totalAmount = 0;
    foreach ($_SESSION['cart'] as $item) {
        $totalAmount += $item['price'] * $item['quantity'];
    }

    $stmt->execute([$_SESSION['user_id'], $name, $email, $address, $phone, $totalAmount]);
    $orderId = $conn->lastInsertId();

    // Insert order items
    $stmtItem = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price)
                                VALUES (?, ?, ?, ?)");
    foreach ($_SESSION['cart'] as $item) {
        $stmtItem->execute([$orderId, $item['id'], $item['quantity'], $item['price']]);
    }

    $conn->commit();

    // 5. Clear cart
    unset($_SESSION['cart']);

    // 6. Redirect to success page
    header("Location: order_success.php?order_id=$orderId");
    exit;

} catch (Exception $e) {
    $conn->rollBack();
    die("Error processing order: " . $e->getMessage());
}
