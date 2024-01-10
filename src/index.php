<!DOCTYPE html>
<html>

<head>
  <title>Online Shop</title>
  <link rel="stylesheet" href="css/Customer/menu.css">
  <link rel="stylesheet" href="css/Customer/productList.css">
  <link rel="stylesheet" href="css/Customer/pageNumbering.css">
  <link rel="stylesheet" href="css/Customer/designTitle.css">
  <link rel="stylesheet" href="css/Customer/shoppingCartList.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" type="e2e68e2b28a3e84bcc07583e-text/javascript"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

  <?php
    if (isset($_COOKIE['loginStatus']) and $_COOKIE['loginStatus'] == 0) {
        echo '<script type="e2e68e2b28a3e84bcc07583e-text/javascript">
            window.setTimeout(function() {
            $(".starting").fadeOut(800)
            }, 0);
            window.setTimeout(function() {
            $(".main").fadeIn(800)
            }, 1000)
            </script>';

    }
    ?>

  <script>
    $(document).ready(function() {
      $('#selectLocation').change(function() {
        var shop_id = $(this).val();
        $.ajax({
          url: "changeIndexTable.php",
          method: "POST",
          data: {
            shop_id: shop_id
          },
          success: function(data) {
            $('#selectLocationTable').html(data);
          }
        });
      });
    });

  </script>


</head>

<body>
  <?php
if (isset($_COOKIE['loginStatus']) and $_COOKIE['loginStatus'] == 0) {
    echo '<div class="starting">
    <h1>Welcome!</h1>
    </div>

    <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js"
        data-cf-settings="e2e68e2b28a3e84bcc07583e-|49" defer=""></script>
    
<div class="main" id="main">';
} else {
    echo '<div class="main1" id="main1">';
}
setcookie('loginStatus', 1, time() + 60 * 60);

?>
  <h1 id="title">Product List</h1>

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


  <div class="customSelectLocation">
    <h3>Please select your shop Location: </h3>
    <select id="selectLocation">
      <?php
        $conn = mysqli_connect('127.0.0.1', 'root', '', 'projectdb') or die(mysqli_connect_error());
        $sql = "SELECT * FROM shop";
        $rs_shop = mysqli_query($conn, $sql);

        while ($rc = mysqli_fetch_assoc($rs_shop)) {
            extract($rc);

            echo "<option value ='$shopID'>$address</option>";
        }

        mysqli_free_result($rs_shop);
        mysqli_close($conn);
        ?>
    </select>
  </div>


  <script>
    function openNav() {
      $.ajax({
        url: "getShoppingCartProduct.php",
        success: function(data) {
          console.log(data);
          $('#mySidenav').html(data);
        }
      });
      document.getElementById("mySidenav").style.width = "650px";
    }

    /* Set the width of the side navigation to 0 */
    function closeNav() {
      document.getElementById("mySidenav").style.width = "0";
    }

  </script>

  <table id="productList">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Quantity you want to <br>buy this product</th>
        <th>Add to <br>shopping cart</th>
      </tr>
    </thead>
    <hr>
    <tbody id="selectLocationTable">

      <?php
    $conn = mysqli_connect('127.0.0.1', 'root', '', 'projectdb') or die(mysqli_connect_error());
    $sql = "SELECT goodsID, goodsName, stockPrice, remainingStock FROM goods, shop, showcase
                where goods.showcaseID = showcase.showcaseID and showcase.shopID = shop.shopID and
                status = '1' and shop.shopID = '1' and remainingStock > '0'";
    $rs_goods = mysqli_query($conn, $sql);

    while ($rc = mysqli_fetch_assoc($rs_goods)) {
        extract($rc);

        echo "
                <tr>
                    <td > $goodsID</td >
                    <td id='goodsName'> $goodsName</td >
                    <td id='goodsPrice'>$ $stockPrice</td >
                    <td > $remainingStock</td >
                    <td ><input type = \"number\" max=\"$remainingStock\" min='0' name='selectStock' value='0' id='Stock$goodsID'></td>
                    <td><input type=\"button\" value=\"ADD TO SHOPPING CART\" onclick='addProduct($goodsID)'></td>
                </tr>
            ";
    }

    mysqli_free_result($rs_goods);
    mysqli_close($conn);
    ?>

      <script>
        function addProduct(goodsId) {
          var buyQty = document.getElementById("Stock" + goodsId).value;
          var shopID = document.getElementById("selectLocation").options[document.getElementById("selectLocation").selectedIndex].value;
          $.ajax({
            url: "addProductToShoppingCart.php",
            method: "POST",
            data: {
              buyQty: buyQty,
              goodsId: goodsId,
              shopID: shopID
            },
            success: function(data) {
              console.log(data);
              alert(data);
            }
          });
        }

      </script>

    </tbody>
  </table>


  <!--the page number-->
  <div class="center">
    <div class="pagination">
      <a href="index.php">&laquo;</a>
      <a href="index.php" class="active">1</a>
      <a href="index.php">2</a>
      <a href="index.php">3</a>
      <a href="index.php">&raquo;</a>
    </div>
  </div>
  </div>

  <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  </div>

  <script>
    function deleteShoppingCartProduct(goodsID) {
      $.ajax({
        url: "deleteShoppingCartProduct.php",
        method: "POST",
        data: {
          goodsID: goodsID
        },
        success: function(data) {
          console.log(data);
        }
      });
      openNav();
    }

  </script>

</body>

</html>
