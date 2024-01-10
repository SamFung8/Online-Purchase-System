<!doctype html>
<html lang="en">
<head>
    <title>Document</title>
</head>
<body>
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
    <?php
    session_start();
    if (isset($_SESSION['goodsID'][0])){
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
                <td><input type=\"button\" value=\"delete\" onclick='deleteShoppingCartProduct({$_SESSION['goodsID'][$i]})'></td>
            </tr>
            ";
            $totalItemPrice += $totalQtyPrice;
    }
    ?>
    </tbody>
</table>
<label id="shoppingCartTotalPrice"> Total Price of all product :<?php echo "\$ $totalItemPrice" ?></label>
<br><br>
<input id="btPay" type="button" value="Pay" onclick="window.location.href='makeOrder.php'">
<?php
}
?>
</body>
</html>