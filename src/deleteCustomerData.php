<!doctype html>
<html lang="en">
<head>
    <title>Document</title>
</head>
<body>
<?php
$conn = mysqli_connect('127.0.0.1', 'root', '', 'projectdb');

$sql_selectOrder = "select orderID from orders where customerEmail = '{$_COOKIE['userEmail']}'";
$rs_selectOrder = mysqli_query($conn, $sql_selectOrder);

while($rc =mysqli_fetch_assoc($rs_selectOrder)) {
    extract($rc);
    $sql_orderItem = "delete from orderitem where orderID = $orderID";
    mysqli_query($conn, $sql_orderItem);

    $sql_order = "delete from orders where customerEmail = '{$_COOKIE['userEmail']}'";
    mysqli_query($conn,$sql_order);
}

mysqli_free_result($rs_selectOrder);

$sql = "delete from customer where customerEmail = '{$_COOKIE['userEmail']}'";
mysqli_query($conn, $sql);

mysqli_close($conn);
?>
</body>
</html>
