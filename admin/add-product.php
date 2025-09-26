<?php
include '../config/conn.php';

if($_SERVER['REQUEST_METHOD'] === "POST"){

    try{
        $conn->beginTransaction();

        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];

        $stmt = $conn->prepare('INSERT INTO products (name , description , price , stock , created_at ) 
                                 VAlUES (:name , :description , :price , :stock , NOW())');
        $stmt->execute([
            ":name" => $name,
            ":description" => $description,
            ":price" => $price,
            ":stock" => $stock,
        ]);
        
        $product_id = $conn->lastInsertId();


        // ................ insert product size ............... //

        if(!empty($_POST['sizes'])){
            $sizes = $_POST['sizes'];

            $stmtSize = $conn->prepare("INSERT INTO product_sizes (product_id , size) VALUES(:product_id , :size)");
            foreach($sizes as $size){
                $stmtSize->execute([
                    ":product_id" => $product_id,
                    ":size" => $size
                ]);
            }
        }

        //............... insert product images .............//

        if (!empty($_FILES['images']['name'][0])) {
            $uploadDir = "../img/uploads/"; // with slash
            $stmtImages = $conn->prepare("INSERT INTO product_images (product_id, image_url) VALUES (:product_id , :image_path)");
        
            foreach ($_FILES['images']['name'] as $key => $imageName) {
                $tmpName = $_FILES['images']['tmp_name'][$key];
                $uniqueName = uniqid() . "_" . basename($imageName);
                $targetFile = $uploadDir . $uniqueName;
        
                if (move_uploaded_file($tmpName, $targetFile)) {
                    // ✅ only store filename
                    $stmtImages->execute([
                        ":product_id" => $product_id,
                        ":image_path" => $uniqueName
                    ]);
                }
            }
        }
        

        $conn->commit();

        echo json_encode(["message" => "product add successfully" , "status" => true]);


    }catch(PDOException  $e){
        $conn->rollBack();
        echo json_encode(["message" => "Error" . $e->getMessage() , "status" => false]);
    }
}



?>