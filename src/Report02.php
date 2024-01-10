<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <link rel="stylesheet" href="css/Register/designRs.css">
  <link rel="stylesheet" href="css/menuGD.css">
  <link rel="stylesheet" href="css/Register/btnRs.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <script>




  </script>
</head>

<body>
  <h1 id="title">Welcome to Hong Kong Cube Shop</h1>
  <br>
  <!--this div is the menu bar-->
  <div class="menu1">

    <li class="item1" id="showcase">
      <a href="#product" class="btn1"><i class="fas fa-shopping-bag"></i>Showcase</a>
      <div class="smenu1">
        <a href="Goods_Information.php" class="sbtn">Information</a>

      </div>
    </li>

    <li class="item1" id="order">
      <a href="#about" class="btn1"><i class="fa fa-file-text-o"></i>Order</a>
      <div class="smenu1">
        <a href="Report01.php" class="sbtn">Report</a>
      </div>
    </li>

    <li class="item1" id="account">
      <a href="#settings" class="btn1"><i class="fa fa-user-secret"></i>Account</a>
      <div class="smenu1">
        <a href="logout.php" class="sbtn1">Logout</a>
      </div>
    </li>
  </div>





  <!--  this is the div that controls the left form-->
  <div id="form">
    <h1 id="urf">Required information report </h1>



    <?php
        extract($_GET);
        extract($_COOKIE);
        //var_dump($_GET);
        $total = "";

        if (isset($orderID)) { //submit button is clicked
          $conn = mysqli_connect("127.0.0.1", "root", "", "projectdb") or die(mysqli_connect_error());

          $sql = "
          SELECT orders.orderID, orders.orderDateTime, orders.status, orders.customerEmail, CONCAT(customer.lastName, ' ', customer.firstName)as name, shop.address FROM orders, customer, shop WHERE orders.orderID = '$orderID' and orders.shopID = shop.shopID and orders.customerEmail = customer.customerEmail
          ";

          $rs = mysqli_query($conn, $sql);
          while ($rc = mysqli_fetch_assoc($rs)) {
            echo'<br>';
            extract($rc);
            //var_dump($rc);
            
            echo "
            <table id='all' class='table table-hover'>
            
            <tr>
            <th>Order ID:</th>
            <td>$orderID</td>
            </tr>
            
            <tr>
            <th>Order Date/Time:</th>
            <td>$orderDateTime</td>
            </tr>
            
            <tr>
            <th>Order Status:</th>
            <td>$status</td>
            </tr>
            
            <tr>
            <th>Customer Email:</th>
            <td>$customerEmail</td>
            </tr>
            
            <tr>
            <th>Customer Name:</th>
            <td>$name</td>
            </tr>
            
            <tr>
            <th>Shop Address:</th>
            <td>$address</td>
            </tr>
            

            ";
          }
          echo'<br>';

          mysqli_free_result($rs);
          mysqli_close($conn);
          
          echo"
          
          </table>
            
          <table id='all' class='table table-hover'>
          <thead>
            <tr>
              <th>Goods ID</th>
              <th>Goods Name</th>
              <th>Quantity</th>
              <th>Selling price of each goods</th>
            </tr>
          </thead>
          ";
          
          
          
          
          $conn = mysqli_connect("127.0.0.1", "root", "", "projectdb") or die(mysqli_connect_error());

          $sql = "
          SELECT orderitem.orderID, goods.goodsID, goods.goodsName, orderitem.quantity, orderitem.sellingPrice 
          FROM orderitem, goods, showcase
          WHERE orderitem.orderID = '$orderID' and orderitem.goodsID = goods.goodsID and showcase.showcaseID = goods.showcaseID and
          showcase.tenantID = '$Tenent_ID'
          ";

          $rs = mysqli_query($conn, $sql);
          while ($rc = mysqli_fetch_assoc($rs)) {
            echo'<br>';
            extract($rc);
            //var_dump($rc);
            
            $total += $sellingPrice * $quantity;
            
            echo"
            <tr>
            <td>$goodsID</td>
            <td>$goodsName</td>
            <td>$quantity</td>
            <td>$sellingPrice</td>
            </tr>
            
            ";
            
          }
            echo"
            </table>
            <table id='all' class='table table-hover'>
            <thead>
              <tr>
                <th>Total Price</th>
                <th>$$total</th>
              </tr>
            </thead>
            ";
          mysqli_free_result($rs);
          mysqli_close($conn);
          
          
        }
      ?>



  </div>


</body>

</html>
