<?php
session_start();

if (isset($_POST['id'], $_POST['action'])) {
    $id = $_POST['id'];
    $action = $_POST['action'];

    if (isset($_SESSION['cart'][$id])) {
        if ($action === "increase") {
            if ($_SESSION['cart'][$id]['quantity'] < $_SESSION['cart'][$id]['stock']) {
                $_SESSION['cart'][$id]['quantity']++;
            }
        } elseif ($action === "decrease") {
            $_SESSION['cart'][$id]['quantity']--;
            if ($_SESSION['cart'][$id]['quantity'] <= 0) {
                unset($_SESSION['cart'][$id]);
                echo json_encode(["status" => true, "quantity" => 0, "removed" => true]);
                exit;
            }
        }

        echo json_encode([
            "status" => true,
            "quantity" => $_SESSION['cart'][$id]['quantity']
        ]);
        exit;
    }
}

echo json_encode(["status" => false, "message" => "Invalid request"]);
