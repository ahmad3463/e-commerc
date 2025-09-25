<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="asessts/css/bootstrap.min.css">
  <title>Signup</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #667eea, #764ba2);
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
      animation: fadeIn 1s ease;
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
      background: #667eea;
      border: none;
      border-radius: 8px;
      color: #fff;
      font-size: 16px;
      cursor: pointer;
      transition: 0.3s;
    }
    .form-container button:hover {
      background: #5563c1;
    }
    .form-container p {
      margin-top: 1rem;
      font-size: 14px;
    }
    .form-container a {
      color: #667eea;
      text-decoration: none;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Create Account</h2>
    <form method="POST" action="" id="signup">
      <input type="text" placeholder="Full Name" name="username" required>
      <input type="email"  placeholder="Email Address" name="useremail" required>
      <input type="password" placeholder="Password"  name="userpass" required>
      <button type="submit">Sign Up</button>
    </form>
    <p>Already have an account? <a href="login.php">Login</a></p>
    <p id="datamessage" class="text-danger"></p>
  </div>
</body>
</html>

<script src="js/jquery-3.7.1.min.js"></script>
<script>
$(document).ready(function () {

   $("#signup").submit(function (e) {
    e.preventDefault();


    var formData = {
      username: $("input[name='username']").val(),
      useremail: $("input[name='useremail']").val(),
      userpass: $("input[name='userpass']").val()
    }

    $.ajax({
      url: 'auth/ajaxsignup.php',
      method: 'POST',
      dataType: 'json',
      contentType: 'application/json',
      data: JSON.stringify(formData),
      success: function(data){
        $('#datamessage').html(data.message);
      },
     
    })
   })
})
</script>