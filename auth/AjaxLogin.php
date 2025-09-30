<?php
include '../config/conn.php';
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Decode raw JSON input
    $data = json_decode(file_get_contents("php://input"), true);

    $useremail = $data['email'] ?? '';
    $userpass  = $data['password'] ?? '';

    if (!$useremail || !$userpass) {
        echo json_encode(["message" => "email and password required", "status" => false]);
        exit;
    }

    try {
        // fetch by email only
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$useremail]);

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify($userpass, $user['password'])) {
                
                // session store 

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['role'] = $user['role'];

                echo json_encode([
                    "message" => "Login successful",
                    "status" => true,
                    "user" => [
                        "id" => $user['id'],
                        "name" => $user['name'],
                        "email" => $user['email'],
                        "role" => $user['role']
                    ]
                ]);
                    exit;
            } else {
                echo json_encode(["message" => "invalid password", "status" => false]);
            }
        } else {
            echo json_encode(["message" => "no account found on this email", "status" => false]);
        }
    } catch (PDOException $e) {
        echo json_encode(["message" => "Error: " . $e->getMessage(), "status" => false]);
    }
}
