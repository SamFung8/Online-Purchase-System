<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
session_start();
extract($_POST);

if (count($_POST) > 1) {
    $toDayeTime = date("Y-m-d H:i:s");

    $conn = mysqli_connect('127.0.0.1', 'root', '', 'projectdb') or die(mysqli_connect_error());
    $sql_createOrder = "INSERT INTO orders (customerEmail, shopID, orderDateTime, status)
        VALUES ('{$_COOKIE['userEmail']}', '{$_POST['pickUpLocation']}', '$toDayeTime', '1')";
    mysqli_query($conn, $sql_createOrder);
    $sql_findOrder = "select orderID from orders
        where customerEmail = '{$_COOKIE['userEmail']}' and shopID = '{$_POST['pickUpLocation']}' and 
        orderDateTime = '$toDayeTime' and status = '1'";
    $rs = mysqli_query($conn, $sql_findOrder);
    $rc = mysqli_fetch_assoc($rs);
    extract($rc);


    for ($i = 0; $i < count($_SESSION['goodsID']); $i++) {
        $checkQty = false;

        $sql_productQty = "select remainingStock from goods where goodsID = {$_SESSION['goodsID'][$i]}";
        $rs_checkQty = mysqli_query($conn, $sql_productQty);
        $rc_checkQty = mysqli_fetch_assoc($rs_checkQty);
        if ($rc_checkQty['remainingStock'] > 0) {
            $goodsID = "makeorderCheckbox" . $_SESSION['goodsID'][$i];
            if (isset($_POST["$goodsID"])) {
                $sql_createOrderItem = "INSERT INTO orderitem (orderID, goodsID, quantity, sellingPrice)
        VALUES ('$orderID', '{$_SESSION['goodsID'][$i]}', '{$_SESSION['buyQty'][$i]}', '{$_SESSION['goodsPrice'][$i]}')";
                mysqli_query($conn, $sql_createOrderItem);

                $sql_findStock = "select * from goods
        where goodsID = {$_SESSION['goodsID'][$i]}";
                $rs = mysqli_query($conn, $sql_findStock);
                $rc = mysqli_fetch_assoc($rs);
                extract($rc);
                $newStock = ($remainingStock - $_SESSION['buyQty'][$i]);
                $sql_updateStock = "update goods set remainingStock = '$newStock' where goodsID = '{$_SESSION['goodsID'][$i]}'";
                mysqli_query($conn, $sql_updateStock);
            }
        } else {
            echo "<script type='text/javascript'>
                    alert('Sorry,the product is insufficient quantity with product ID {$_SESSION['goodsID'][$i]} !');
                    window.location.href = 'index.php';
                    </script>";
            $checkQty = true;
            break;
        }
    }
}

if (!$checkQty) {
    session_destroy();
    if (count($_POST) > 1) {
        echo "<script type='text/javascript'>
        alert('The system save the data !');
        window.location.href = 'index.php';
      </script>";
    } else {
        echo "<script type='text/javascript'>
        alert('Sorry,no product are selected to buy !');
        window.location.href = 'index.php';
      </script>";
    }
}
?>
</body>
</html>

