<?php
include 'header.php';
session_start();
$cart = $_SESSION['cart'] ?? [];
$total = 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Shopping Cart</title>
    <link href="asessts/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-light">

    <div class="container my-5">
        <h2 class="mb-4"><i class="fa-solid fa-cart-shopping"></i> Your Cart</h2>

        <?php if (empty($cart)): ?>
            <div class="alert alert-warning">Your cart is empty!</div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table align-middle shadow-sm">
                    <thead class="table-dark">
                        <tr>
                            <th>Product</th>
                            <th>Image</th>
                            <th>Size</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cart as $item): ?>
                            <?php $subtotal = $item['price'] * $item['quantity']; ?>
                            <?php $total += $subtotal; ?>
                            <tr>
                                <td><?= htmlspecialchars($item['name']) ?></td>
                                <td>
                                    <img src="img/uploads/<?= htmlspecialchars($item['image_url']) ?>"
                                        alt="<?= htmlspecialchars($item['name']) ?>" width="70" class="rounded shadow-sm">
                                </td>
                                <td><?= htmlspecialchars(is_array($item['sizes']) ? implode(', ', $item['sizes']) : ($item['sizes'] ?? '-')) ?></td>

                                <td>Rs. <?= number_format($item['price']) ?></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-secondary update-qty" data-id="<?= $item['id'] ?>"
                                        data-action="decrease">-</button>
                                    <span id="qty-<?= $item['id'] ?>"><?= $item['quantity'] ?></span>
                                    <button class="btn btn-sm btn-outline-secondary update-qty" data-id="<?= $item['id'] ?>"
                                        data-action="increase">+</button>
                                </td>

                                <td><strong>Rs. <?= number_format($subtotal) ?></strong></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" class="text-end"><strong>Total:</strong></td>
                            <td><strong>Rs. <?= number_format($total) ?></strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="shop.php" class="btn btn-outline-secondary">
                    <i class="fa-solid fa-arrow-left"></i> Continue Shopping
                </a>
                <a href="checkout.php" class="btn btn-primary">
                    Proceed to Checkout <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        <?php endif; ?>
    </div>

</body>

</html>

<script src="js/jquery-3.7.1.min.js" ></script>
<script>
$(document).ready(function(){
    $(".update-qty").on("click", function(){
        let id = $(this).data("id");
        let action = $(this).data("action");

        $.ajax({
            url: "update_cart.php",
            method: "POST",
            data: { id: id, action: action },
            dataType: "json",
            success: function(response){
                if(response.status){
                    $("#qty-" + id).text(response.quantity);
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr, status, error){
                console.log(error);
            }
        });
    });
});

</script>