<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="asessts/css/bootstrap.min.css">
  <title>Login</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #43cea2, #185a9d);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .form-container {
      background: #fff;
      padding: 2rem;
      border-radius: 16px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.15);
      width: 350px;
      text-align: center;
      animation: slideIn 1s ease;
    }
    .form-container h2 {
      margin-bottom: 1rem;
      color: #333;
    }
    .form-container input {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: none;
      border-radius: 8px;
      background: #f0f0f0;
      transition: 0.3s;
    }
    .form-container input:focus {
      background: #e0e0e0;
      outline: none;
    }
    .form-container button {
      width: 100%;
      padding: 12px;
      background: #43cea2;
      border: none;
      border-radius: 8px;
      color: #fff;
      font-size: 16px;
      cursor: pointer;
      transition: 0.3s;
    }
    .form-container button:hover {
      background: #2f7f6f;
    }
    .form-container p {
      margin-top: 1rem;
      font-size: 14px;
    }
    .form-container a {
      color: #43cea2;
      text-decoration: none;
    }
    @keyframes slideIn {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Welcome Back</h2>
    <form method="POST" action="" id='loginForm'>
      <input type="email" name="email" placeholder="Email Address" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Login</button>
    </form>
    <p>Dont have an account? <a href="signup.php">Sign Up</a></p>
    <p id="message" class="text-danger"></p>
  </div>
</body>
</html>



<script src="js/jquery-3.7.1.min.js"></script>
<script>


$(document).ready(function () {
  $('#loginForm').submit(function (e) {
    e.preventDefault(); // stop page reload

    // Collect form data
    var formData = {
      email: $("input[name='email']").val(),
      password: $("input[name='password']").val()
    };

    $.ajax({
      url: 'auth/AjaxLogin.php',
      method: 'POST',
      contentType: 'application/json',
      dataType: 'json',
      data: JSON.stringify(formData),
      success: function (data) {
        if (data.status) {
         
          if (data.user.role === 'admin') {
            window.location.href = "dashboard.php"; 
          } else {
            window.location.href = "index.php"; 
          }
        } else {
        
          $('#message').html(data.message);
        }
      },
      error: function () {
        $('#message').html("Something went wrong. Please try again.");
      }
    });
  });
});

</script>

