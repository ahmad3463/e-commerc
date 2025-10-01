<?php
include 'config/conn.php';

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header('Location: cart.php');
    exit;
}

if (!isset($_SESSION['user_id'])) {
    header('Location: signup.php');
    exit;
}


?>

<?php include 'header.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Page</title>
    <link href="asessts/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/checkout.css">
</head>

<body class="bg-light">

    <div class="container py-5 mt-5">
        <div class="row g-4">

            <!-- Left Side -->
            <div class="col-lg-8">
                <!-- Shipping Info -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h4 class="fw-bold">Shipping info</h4>
                        <p><b>Name :</b> <?= $_SESSION['user_name'] ?></p>
                        <p><b>Email :</b> <?= $_SESSION['user_email'] ?></p>
                    </div>
                </div>

                <!-- Package Section -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="mb-3 fw-bold">Shipping & Billing</h5>

                        <!-- Delivery Option -->
                        <div class="border rounded p-3 mb-3">
                            <form id="frominfo" action="checkout_process.php" method="POST" class="needs-validation" novalidate>

                                <!-- Name -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                    <div class="invalid-feedback">Please enter your full name.</div>
                                </div>

                                <!-- Email -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                    <div class="invalid-feedback">Please enter a valid email.</div>
                                </div>

                                <!-- Address -->
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea class="form-control" id="address" name="address" rows="3"
                                        required></textarea>
                                    <div class="invalid-feedback">Please enter your address.</div>
                                </div>

                                <!-- Phone -->
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" pattern="[0-9]{11}"
                                        required>
                                    <div class="invalid-feedback">Please enter a valid 11-digit phone number.</div>
                                </div>
  
                            </form>

                        </div>

                        <!-- Product -->
                        <div class=" align-items-center border-top pt-3">
                            <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
                                <?php foreach ($_SESSION['cart'] as $item): ?>
                                    <div class="d-flex align-items-center border-top pt-3">
                                        <img src="img/uploads/<?= $item['image_url'] ?>" class="rounded me-3" width="80"
                                            height="80" alt="<?= $item['name'] ?>">
                                        <div class="flex-grow-1">
                                            <p class="mb-1"><?= $item['name'] ?></p>
                                            <small class="text-muted">Product ID: <?= $item['id'] ?></small>
                                            <p class="text-danger small mb-1">Qty Available: <?= $item['stock'] ?></p>
                                        </div>
                                        <div class="text-end">
                                            <p class="fw-bold text-orange mb-1">Rs. <?= number_format($item['price']) ?></p>
                                            <p class="mb-0">Qty: <?= $item['quantity'] ?></p>
                                            <p class="fw-bold text-success">Subtotal: Rs.
                                                <?= number_format($item['price'] * $item['quantity']) ?>
                                            </p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="text-muted">Your cart is empty.</p>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>


            <!-- Right Side -->
            <?php
            $totalAmount = 0;
            $totalItems = 0;

            if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $item) {
                    $subtotal = $item['price'] * $item['quantity'];
                    $totalAmount += $subtotal;
                    $totalItems += $item['quantity'];
                }
            }
            $deliveryFee = 0; // set to fixed value if needed, e.g., 160
            $grandTotal = $totalAmount + $deliveryFee;
            ?>

            <div class="col-lg-4">
                <div class="order-summary shadow-sm p-3">

                    <!-- Promotion -->
                    <div class="mb-3">
                        <label for="promo" class="form-label fw-bold">Promotion</label>
                        <div class="input-group">
                            <input type="text" id="promo" class="form-control" placeholder="Enter Promo Code">
                            <button class="btn btn-outline-primary">Apply</button>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <h6 class="fw-bold">Order Summary</h6>
                    <div class="d-flex justify-content-between">
                        <span>Items Total (<?= $totalItems ?> item<?= $totalItems > 1 ? 's' : '' ?>)</span>
                        <span>Rs. <?= number_format($totalAmount) ?></span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Delivery Fee</span>
                        <span><?= $deliveryFee > 0 ? "Rs. " . number_format($deliveryFee) : "Free" ?></span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between fw-bold">
                        <span>Total:</span>
                        <span class="text-danger">Rs. <?= number_format($grandTotal) ?></span>
                    </div>

                    <!-- Checkout Button -->
                    <div class="d-grid mt-3">
                        <button form="frominfo" class="btn btn-checkout py-2">Proceed to Pay</button>
                    </div>
                </div>
            </div>


        </div>
    </div>


</body>

</html>
<script>
    // Bootstrap form validation
    (() => {
        'use strict'
        const forms = document.querySelectorAll('.needs-validation')
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>