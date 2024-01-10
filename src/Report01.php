<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="css/Goods/order.css">
  <link rel="stylesheet" href="css/menuGD.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <meta charset="UTF-8">
  <title>Order</title>

  <script>
    //    <?php
    //    echo '
    //      function show() {
    //        window.location.href = "Report01.php?orderID=$orderID";
    //      }
    //    ';
    //    ?>

    function del(orderID) {
      window.location.href = "del.php?orderID=" + orderID;
    }

    function show(orderID) {
      window.location.href = "Report02.php?orderID=" + orderID;
    }

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






  <div id="LG_Container">
    <table id="all" class="table table-hover">
      <thead>
        <tr>
          <th scope="col">Order ID</th>
          <th scope="col">Customer Email</th>
          <th scope="col">Shop ID</th>
          <th scope="col">Order Date/Time</th>
          <th scope="col">Order status</th>
          <th scope="col"></th>

        </tr>
      </thead>

      <tbody>

        <?php
        extract($_COOKIE); 
        
        
        
        
        
        
        
          // connect database
          $conn = mysqli_connect("127.0.0.1", "root", "", "projectdb") or die(mysqli_connect_error());
          $sql = "SELECT DISTINCT orders.orderID, orders.customerEmail, orders.shopID,
		  orders.orderDateTime, orders.status
          FROM orders, orderitem, goods, showcase
          WHERE orderitem.orderID = orders.orderID and
		  goods.goodsID = orderitem.goodsID and
		  showcase.showcaseID = goods.showcaseID and
		  showcase.tenantID = '$Tenent_ID' 
          ORDER BY orders.orderDateTime DESC";
          $rs = mysqli_query($conn, $sql);
          $num = mysqli_num_rows($rs);
          
          while ($rc = mysqli_fetch_assoc($rs)) {
            extract($rc); 
            $countnum = 0;
           
            
          

            if ($status == "1") {
              $sta = "Delivery";
            } else if ($status == "2") {
              $sta = "Awaiting";
            } else if ($status == "3") {
              $sta = "Completed";
            }
            
            if ($status == "1") {
              $display = 'inline';
            } else {
              $display = 'none';
            }
          
            //var_dump($rc);

            echo "
            <tr>
            <td>$orderID</td>
            <td>$customerEmail</td>
            <td>$shopID</td>
            <td>$orderDateTime</td>
            <td>$sta</td>
            <td>

                <input type='button' class='show' id='show1' value='Show' onclick='show($orderID)'>

              
                <input type='button' class='delect' id='delect' value='Delect' onclick='del($orderID)' style='display: $display;'>
              
            </td>
            </tr>
            ";  
          }
          mysqli_free_result($rs);
          mysqli_close($conn);
        ?>


      </tbody>
    </table>
  </div>

</body>

</html>
