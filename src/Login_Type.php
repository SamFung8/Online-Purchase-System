<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Login Type</title>
  <link rel="stylesheet" href="css/Login/designLg.css">
  <link rel="stylesheet" href="css/menu.css">
  <link rel="stylesheet" href="css/Login/btnLg_type.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">

  <script>
    //go to the Customer Login pages
    function goToCustomer() {
      window.location.href = 'Login_Customer.php';
    }

    //go to the Tenant Login pages
    function goToTenant() {
      window.location.href = 'Login_Tenant.php';
    }

    //go to the Register pages
    function goToRegister() {
      window.location.href = 'Register.php';
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




  <form id="flex-container" method="post" enctype="multipart/form-data" onSubmit="submited();return false" action="">

    <div id="loginForm_type">
      <h1 id="lg">Please select your login type.</h1>
      <input type="button" id="customer" onClick="goToCustomer()" value="Customer">
      <br>
      <br>
      <input type="button" id="tenant" onclick="goToTenant()" value="Tenant">
      <br>
      <br>
      <input type="button" id="register" onclick="goToRegister()" value="Register Account">

    </div>
  </form>
</body>

</html>
