<?php
include 'config/conn.php';
include 'header.php';

if(!isset($_SESSION['user_id'])){
header("Location: login.php");
exit;
}


try{
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("SELECT name , email  FROM  users where id = ? ");
    $stmt->execute([$user_id]);

    $user_data = $stmt->fetch(PDO::FETCH_ASSOC);

}catch(PDOException $e){

  echo "Error". $e->getMessage();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage My Account</title>
    <style>
        .card {
  border-radius: 12px;
  transition: all 0.2s ease-in-out;
}
.card:hover {
  box-shadow: 0 4px 15px rgba(0,0,0,0.08);
}
.btn-outline-primary i {
  font-size: 14px;
  margin-right: 3px;
}

    </style>
</head>
<body>
<div class="container mt-5 pt-5">
  <div class="row g-4">
    <!-- Name Box -->
    <div class="col-md-6">
      <div class="card shadow-sm border-0 p-3 position-relative">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h6 class="text-muted mb-1">Full Name</h6>
            <h5 class="fw-semibold mb-0" id="userName"><?= $user_data['name']?></h5>
          </div>
          <button class="btn btn-sm btn-outline-primary">
            <i class="bi bi-pencil"></i> Edit
          </button>
        </div>
      </div>
    </div>

    <!-- Email Box -->
    <div class="col-md-6">
      <div class="card shadow-sm border-0 p-3 position-relative">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h6 class="text-muted mb-1">Email Address</h6>
            <h5 class="fw-semibold mb-0" id="userEmail"><?=  $user_data['email'] ?></h5>
          </div>
          <button class="btn btn-sm btn-outline-primary">
            <i class="bi bi-pencil"></i> Edit
          </button>
        </div>
      </div>
    </div>
  </div>
</div>


</body>
</html>