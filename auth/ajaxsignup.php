<?php
include '../config/conn.php';
header("Content-Type: application/json");

    $data = json_decode(file_get_contents("php://input") , true);

    $username = $data['username'] ?? '';
    $useremail = $data['useremail'] ?? '';
    $userpass = $data['userpass'] ?? '';
    $role = $data['role'] ?? 'users';

    if(!$username || !$userpass || !$useremail ){
        echo json_encode(["message" => "All fields are required" , "status" => false]);
        exit;
    }


    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$useremail]);
    if($stmt->rowCount() > 0){
        echo json_encode(["message" => "email already registered" ,  "status" => false]);
        exit;
    }


    $hashpassword = password_hash($userpass , PASSWORD_DEFAULT);
    if($useremail === "admin@admin.com"){
       $role = "admin";   
    }

    try{
        
 
        $stmt = $conn->prepare("INSERT INTO users (name, email, password , role) VALUES (?,?,?,?)");
        $stmt->execute([$username , $useremail , $hashpassword , $role]);
      
        echo json_encode(["message" => " Successfully Registered" , "status" => true , "role" => $role]);
    }
     catch (PDOException $e) {
        echo json_encode(["message" => "Error :" . $e->getMessage() , "status" => false]);
    }



?>