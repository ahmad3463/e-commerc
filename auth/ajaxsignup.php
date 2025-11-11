<?php
include '../config/conn.php';
header("Content-Type: application/json");


// Only allow POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["message" => "Invalid request method", "status" => false]);
    exit;
}

// Get JSON input
$data = json_decode(file_get_contents("php://input"), true);

$username  = trim($data['username'] ?? '');
$useremail = trim($data['useremail'] ?? '');
$userpass  = trim($data['userpass'] ?? '');
$role      = 'users'; // default role

// Validate fields
if (!$username || !$useremail || !$userpass) {
    echo json_encode(["message" => "All fields are required", "status" => false]);
    exit;
}

try {
    // Check if email already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$useremail]);
    if ($stmt->rowCount() > 0) {
        echo json_encode(["message" => "Email already registered", "status" => false]);
        exit;
    }

    // Hash password
    $hashpassword = password_hash($userpass, PASSWORD_DEFAULT);

    // Special case for admin
    if ($useremail === "admin@admin.com") {
        $role = "admin";
    }

    // Insert user
    $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->execute([$username, $useremail, $hashpassword, $role]);

    // Get inserted user ID
    $user_id = $conn->lastInsertId();

    // Auto-login: set session
    $_SESSION['user_id']    = $user_id;
    $_SESSION['user_name']  = $username;
    $_SESSION['user_email'] = $useremail;
    $_SESSION['role']       = $role;

    // Respond success
    echo json_encode([
        "message" => "Successfully Registered & Logged In",
        "status" => true,
        "user" => [
            "id" => $user_id,
            "name" => $username,
            "email" => $useremail,
            "role" => $role
        ]
    ]);

} catch (PDOException $e) {
    echo json_encode(["message" => "Error: " . $e->getMessage(), "status" => false]);
}
