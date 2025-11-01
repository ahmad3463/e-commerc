<?php
include "config/conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // ====== 1. Get All Form Data ======
        $id = $_POST['id'];
        $name = trim($_POST['name']);
        $description = trim($_POST['description']);
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $sizes = $_POST['sizes'] ?? [];
        $old_image = $_POST['old_image'];
        $new_image = $_FILES['new_image'];

        // ====== 2. Handle Image Upload ======
        $imageToStore = $old_image; // default old image

        if (!empty($new_image['name'])) {
            // Define upload folder
            $uploadDir = "img/uploads/";

            // Generate unique file name
            $imageName = time() . "_" . basename($new_image['name']);
            $targetFilePath = $uploadDir . $imageName;

            // Move new file to uploads folder
            if (move_uploaded_file($new_image['tmp_name'], $targetFilePath)) {
                $imageToStore = $imageName;

                // Optionally delete old image from folder
                $oldImagePath = $uploadDir . $old_image;
                if (file_exists($oldImagePath) && !empty($old_image)) {
                    unlink($oldImagePath);
                }

                // Update or Insert image record
                $checkImage = $conn->prepare("SELECT COUNT(*) FROM product_images WHERE product_id = ?");
                $checkImage->execute([$id]);
                $exists = $checkImage->fetchColumn();

                if ($exists) {
                    $updateImg = $conn->prepare("UPDATE product_images SET image_url = ? WHERE product_id = ?");
                    $updateImg->execute([$imageToStore, $id]);
                } else {
                    $insertImg = $conn->prepare("INSERT INTO product_images (product_id, image_url) VALUES (?, ?)");
                    $insertImg->execute([$id, $imageToStore]);
                }
            }
        }

        // ====== 3. Update Product Table ======
        $updateProduct = $conn->prepare("
            UPDATE products 
            SET name = ?, description = ?, price = ?, stock = ? 
            WHERE id = ?
        ");
        $updateProduct->execute([$name, $description, $price, $stock, $id]);

        // ====== 4. Update Sizes ======
        // Delete old sizes
        $deleteSizes = $conn->prepare("DELETE FROM product_sizes WHERE product_id = ?");
        $deleteSizes->execute([$id]);

        // Insert new sizes
        if (!empty($sizes)) {
            $insertSize = $conn->prepare("INSERT INTO product_sizes (product_id, size) VALUES (?, ?)");
            foreach ($sizes as $size) {
                $insertSize->execute([$id, $size]);
            }
        }

        // ====== 5. Redirect on Success ======
        header("Location: products-list.php?msg=Product Updated Successfully");
        exit;

    } catch (PDOException $e) {
        echo " Error updating product: " . $e->getMessage();
    }
} else {
    echo "Invalid request!";
}
?>
