<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Make Order</title>
  <link rel="stylesheet" href="css/Customer/designTitle.css">
  <link rel="stylesheet" href="css/Customer/productList.css">
  <link rel="stylesheet" href="css/Customer/menu.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
</head>

<body>
  <h1 id="title">Makeing Order</h1>
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

    <li class="item" id='shoppingCart'>
      <a href="#shoppingCart" class="btn" onclick="openNav()"><i class="fas fa-shopping-cart"></i>Shopping
        Cart</a>
    </li>
  </div>

  <script>
    function openNav() {
      document.getElementById("mySidenav").style.width = "650px";
    }

    /* Set the width of the side navigation to 0 */
    function closeNav() {
      document.getElementById("mySidenav").style.width = "0";
    }

  </script>

  <form action="createOrder.php" method="post">

    <div id="orderBorder">
      <h1>Creating New Order</h1>
      <table class="makeOrderList">
        <thead>
          <th>ID</th>
          <th>Name</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Total Pricr</th>
        </thead>
        <tbody>

          <?php
            session_start();
            if (isset($_SESSION['goodsID'][0])) {
                $totalItemPrice = 0;
                for ($i = 0; $i < count($_SESSION['goodsID']); $i++) {
                    $totalQtyPrice = $_SESSION['goodsPrice'][$i] * $_SESSION['buyQty'][$i];
                    echo "
            <tr>
                <td>{$_SESSION['goodsID'][$i]}</td>
                <td>{$_SESSION['goodsName'][$i]}</td>
                <td>\$ {$_SESSION['goodsPrice'][$i]}</td>
                <td>{$_SESSION['buyQty'][$i]}</td>
                <td>\$ $totalQtyPrice</td>
                <td><input type=\"checkbox\" value='{$_SESSION['goodsID'][$i]}' name='makeorderCheckbox{$_SESSION['goodsID'][$i]}' checked> BUY</td>
            </tr>
            ";
                    $totalItemPrice += $totalQtyPrice;
                }
            }
            ?>

        </tbody>
      </table>
      <label id="makeOrderTotalPrice">Total Price of all product : $<?php echo "$totalItemPrice" ?></label>
    </div>

    <div id="selectShop">
      <h1>Now You Need To Select The Pick-up Shop</h1>
      <div class="customSelectLocation">Location:
        <select id="selectLocation" name='pickUpLocation'>
          <?php
                $conn = mysqli_connect('127.0.0.1', 'root', '', 'projectdb') or die(mysqli_connect_error());
                $sql = "SELECT * FROM shop";
                $rs_shop = mysqli_query($conn, $sql);
                var_dump($rs_shop);

                while ($rc = mysqli_fetch_assoc($rs_shop)) {
                    extract($rc);

                    echo "<option value ='$shopID'>$address</option>";
                }

                mysqli_free_result($rs_shop);
                mysqli_close($conn);
                ?>
        </select>
      </div>
    </div>

    <div><input id="btBackToHome" type="button" value="BACK" onclick="window.location.href='index.php'"></div>
    <?php
    if (isset($_COOKIE['userEmail']))
        echo '<div><input id="btMakeOrderFinish" type="submit" value="FINISH"></div>';
    else
        echo '<div><input id="btMakeOrderFinish" type="button" value="FINISH" onclick="window.location.href=\'Login_Customer.php\'"></div>';
    ?>
  </form>

</body>

</html>
