<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Order</title>
    <link rel="stylesheet" href="css/Customer/designTitle.css">
    <link rel="stylesheet" href="css/Customer/shoppingCartList.css">
    <link rel="stylesheet" href="css/Customer/menu.css">
    <link rel="stylesheet" href="css/Customer/viewOrder.css">
    <link rel="stylesheet" href="css/Customer/productList.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
</head>

<body>
<h1 id="title">View Order</h1>
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

    
    
<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <table class="shoppingCartList">
        <thead>
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Total Pricr</th>
        <th></th>
        </thead>
        <tbody>
        <tr>
            <td>1</td>
            <td>Bracelet</td>
            <td>$100</td>
            <td>2</td>
            <td>$200</td>
            <td><input type="button" value="delete"></td>
        </tr>
        <tr></tr>
        </tbody>
    </table>
    <label id="shoppingCartTotalPrice">Total Price of all product : $200</label>
    <br><br>
    <input id="btPay" type="button" value="Pay" onclick="window.location.href='makeOrder.html'">
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

<?php
$color = 1;
$conn = mysqli_connect('127.0.0.1', 'root', '', 'projectdb') or die(mysqli_connect_error());
$sql = "SELECT orders.orderID, address, orderDateTime, status
                    FROM orders, shop
                    where shop.shopID = orders.shopID and customerEmail = '{$_COOKIE['userEmail']}'";
$rs_orders = mysqli_query($conn, $sql);

while ($rc_order = mysqli_fetch_assoc($rs_orders)) {
    $totalAllItemsPrice = 0;

    extract($rc_order);

    if ($status == "1")
        $statusName = "Delivery";
    else if ($status == "2")
        $statusName = "Awaiting";
    else
        $statusName = "Completed";


    echo "<button class=\"viewOrder$color\">Order: $orderID - Shop Name: $address - Order Date: $orderDateTime - Status: $statusName</button>
<div class=\"viewSubOrder\">
    <div id=\"orderBorder\">
        <h3>Your Order ID: $orderID - Status: $statusName</h3>
        <table class=\"makeOrderList\">
            <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total Pricr</th>
            </thead>
            <tbody>";

    $sql = "SELECT goods.goodsID, goodsName, sellingPrice, quantity
                    FROM goods, orderitem
                    where goods.goodsID = orderitem.goodsID and orderitem.orderID = '$orderID'";
    $rs_orderItem = mysqli_query($conn, $sql);

    while ($rc_item = mysqli_fetch_assoc($rs_orderItem)) {
        extract($rc_item);
        $sumPrice = ($sellingPrice * $quantity);

        echo "
                <tr>
                    <td> $goodsID</td>
                    <td> $goodsName</td>
                    <td> $ $sellingPrice</td>
                    <td> $quantity</td>
                    <td>$ $sumPrice</td>
                </tr>
                ";
        $totalAllItemsPrice = ($totalAllItemsPrice + $sumPrice);
    }

    mysqli_free_result($rs_orderItem);

    echo "</tbody>
        </table> 
    <label id=\"makeOrderTotalPrice\">Total Price of all product : $$totalAllItemsPrice</label>
    </div>
    </div>";

    if ($color === 1)
        $color = 2;
    else
        $color = 1;
}

mysqli_free_result($rs_orders);
mysqli_close($conn);

?>

<input type="button" id="btViewOrderBack" value="BACK TO HOME PAGE">

<script>
    var acc = document.getElementsByClassName("viewOrder1");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function () {
            this.classList.toggle("active");
            var viewSubOrder = this.nextElementSibling;
            if (viewSubOrder.style.maxHeight) {
                viewSubOrder.style.maxHeight = null;
            } else {
                viewSubOrder.style.maxHeight = viewSubOrder.scrollHeight + "px";
            }
        });
    }
</script>

<script>
    var acc = document.getElementsByClassName("viewOrder2");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function () {
            this.classList.toggle("active");
            var viewSubOrder = this.nextElementSibling;
            if (viewSubOrder.style.maxHeight) {
                viewSubOrder.style.maxHeight = null;
            } else {
                viewSubOrder.style.maxHeight = viewSubOrder.scrollHeight + "px";
            }
        });
    }
</script>

</body>
</html>