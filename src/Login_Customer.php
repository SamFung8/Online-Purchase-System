<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Customer Login</title>
  <link rel="stylesheet" href="css/Login/designLg.css">
  <link rel="stylesheet" href="css/menu.css">
  <link rel="stylesheet" href="css/Login/btnLg.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

  <script>
    function show_PW() {
      var pw = document.getElementById('password');
      if (pw.type == "password") {
        pw.type = 'text';
      } else if (pw.type == "text") {
        pw.type = 'password';
      }
    }

    function goToRegister() {
      window.location.href = 'Register.html';
    }

  </script>

  <script>
    function checkLogin() {
      var password = document.getElementById('password').value;
      var email = document.getElementById('email').value;
      $.ajax({
        url: "checkCustomerLogin.php",
        method: "POST",
        data: {
          password: password,
          email: email
        },
        success: function(data) {
          console.log(data);
          if (data == "true") {
            alert("Login success!");
            window.location.href = 'index.php';
          } else {
            alert("Sorry, wrong password or email !");
          }
        }
      });
    }

  </script>
</head>

<body>
  <h1 id="title">Welcome to Hong Kong Cube Shop</h1>
  <br>

  <!--the menu-->

  <div class="menu">
    <li class="item" id='home'>
      <a href="index.php" class="btn"><i class="fas fa-home"></i>Home</a>
    </li>

    <li class="item" id="settings">
      <a href="#settings" class="btn"><i class="fa fa-user-secret" aria-hidden="true"></i>Account</a>
      <div class="smenu">
        <?php
            if (!isset($_COOKIE['userEmail']) and !isset($_COOKIE['Tenent_ID']))
                echo "<a href=\"Register.php\" class=\"sbtn\">Register</a>";
        
            if (!isset($_COOKIE['userEmail']) and !isset($_COOKIE['Tenent_ID']))
                    echo "<a href=\"Login_Type.php\" class=\"sbtn\">Login</a>";

            if (isset($_COOKIE['userEmail']) or isset($_COOKIE['Tenent_ID']))
                echo "<a href=\"logout.php\" class=\"sbtn\">Logout</a>";

            if (isset($_COOKIE['userEmail']))
                echo "<a href=\"updateCustomerData.php\" class=\"sbtn\">Info</a>";
            ?>
      </div>
    </li>

  </div>



  <div id="loginForm">
    <h1 id="lg">Login as Customer</h1>

    <label for="email"><b><a class="mustInPut">*</a>Email:</b></label>
    <input type="email" name="email" id="email" placeholder="Enter your email" required><br>

    <label for="password"><b><a class="mustInPut">*</a>Password:</b></label>
    <input type="password" name="password" class="pwd" id="password" placeholder="Enter Password" required>

    <input type="button" id="showPw" value="Show Password" onclick="show_PW()"><br><br>


    <input type="button" id="login" value="Login" onclick="checkLogin()">

    <input type="button" id="registerAccount" value="Register Account" onclick="goToRegister()">

  </div>


</body>

</html>
