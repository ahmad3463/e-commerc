<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <link rel="stylesheet" href="asessts/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/detail.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'header.php'?>

  
    <div class="container d-flex">
        <img id="card-image" src="" alt="Product Image">
        <div class="cont-text mt-5 pt-5 ms-4 ps-3">
            <div id="card-parah" class="fw-bold pt-2"></div>
            <p id="card-price"></p>
            <div class="d-inline-flex align-items-center mb-3">
                <button class="btn btn-outline-secondary" id="decrement">-</button>
                <input type="text" id="quantity" class="form-control text-center mx-2" value="1" style="width: 50px;" readonly>
                <button class="btn btn-outline-secondary" id="increment">+</button>
            </div>
            <button class="normal mb-3" data-bs-toggle="modal" data-bs-target="#myModal" >ADD TO CART</button>
            <p id="card-description"></p>    
            <button class="normal mt-3" onclick="goBack();">Go Back</button>
        </div>  
    </div>
    
    <!-- modal is start  -->

    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
          <div class="modal-content">
            <div class="modal-body text-center">
              <h4 class="mt-5">Front Pocket Jumper</h4>
              <p> is added to cart !</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Okay</button>
            </div>
          </div>
        </div>
      </div>


      <?php include 'footer.php'; ?>
    <script src="asessts/js/bootstrap.bundle.min.js"></script>
    <script src="js/detail.js"></script>
</body>
</html>
