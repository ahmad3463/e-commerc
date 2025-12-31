<?php


include "config/conn.php";


 if(!$_SESSION['user_id']){
  echo json_encode([
    "status" => false,
    "message" => "please login to add wishlist"
  ]);
  exit;
}

$user_id = $_SESSION['user_id'];
$product_id = $_POST ['id'];

$check = $conn->prepare("SELECT * FROM  wishlist where user_id  = ? AND product_id = ? ");
$check->execute([$user_id, $product_id]);

if($check->rowCount() > 0){
    echo json_encode([
        "status" => false,
        "message" => "already in wishlist"
    ]);
    exit;
}


$insert = $conn->prepare("INSERT INTO wishlist (user_id , product_id) VALUES (?,?)");
$insert->execute([$user_id, $product_id]);


echo json_encode([
    "status" => true,
    "message" => "add to wishlist!"
]);


?>