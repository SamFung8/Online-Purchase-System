<!doctype html>
<html lang="en">
<head>
    <title>Document</title>
</head>
<body>
<?php
$conn = mysqli_connect('127.0.0.1', 'root', '', 'projectdb') or die(mysqli_connect_error());
if (isset($_POST["shop_id"])) {
    $sql = "SELECT goodsID, goodsName, stockPrice, remainingStock FROM goods, shop, showcase
                where goods.showcaseID = showcase.showcaseID and showcase.shopID = shop.shopID and
                status = '1' and shop.shopID = '$_POST[shop_id]' and remainingStock > '0'";
    $rs_goods = mysqli_query($conn, $sql);

    while ($rc = mysqli_fetch_assoc($rs_goods)) {
        extract($rc);

        echo "
            <tr>
                <td > $goodsID</td >
                <td > $goodsName</td >
                <td >$ $stockPrice</td >
                <td > $remainingStock</td >
                <td ><input type = \"number\" max=\"$remainingStock\" min='0' name='selectStock' value='0' id='Stock$goodsID'></td>
                <td><input type=\"button\" value=\"ADD TO SHOPPING CART\" onclick='addProduct($goodsID)'></td>
            </tr>
        ";
    }

    mysqli_free_result($rs_goods);
    mysqli_close($conn);
}
?>
</body>
</html>