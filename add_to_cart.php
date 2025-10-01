<?php
    include 'config/conn.php';


    if(isset($_GET['id'])){

        $product_id = $_GET['id'];

        try{
            $stmt = $conn->prepare("SELECT  p.id , p.name , p.description , p.price , p.stock , (SELECT image_url FROM product_images where product_id  = p.id LIMIT 1) as image_url, GROUP_CONCAT(ps.size) as sizes 
            FROM products p 
            LEFT JOIN product_sizes ps ON p.id = ps.product_id WHERE p.id = ?
            GROUP BY p.id, p.name , p.description, p.price , p.stock
            ");

            $stmt->execute([$product_id]);
            $product = $stmt->fetch(PDO::FETCH_ASSOC);

            if($product){
                if(!isset($_SESSION['cart'])){
                    $_SESSION['cart'] = [];
                }

                if(isset($_SESSION['cart'][$product_id])){
                    $_SESSION['cart'][$product_id]['quantity'] += 1;
                }else{
                    $_SESSION['cart'][$product_id] = [
                        "id" => $product['id'],
                        "name" => $product['name'],
                        "description" => $product['description'],
                        "price" => $product['price'],
                        "stock" => $product['stock'],
                        "image_url" => $product['image_url'],
                        "sizes" => $product['sizes'], // comma-separated
                        "quantity" => 1
                    ];
                }


               header("Location: cart.php");
            }else{
                echo json_encode(["message" => "Product not found", "status" => false]);
            }

        }catch(PDOException $e){
            echo json_encode(["message" => "Error " . $e->getMessage() , "status" => false]);
        }

    }

?>

