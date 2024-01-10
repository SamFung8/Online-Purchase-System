<?php
session_start();
$conn = mysqli_connect('127.0.0.1', 'root', '', 'projectdb');
$repeatProduct = false;
$checkSameShop = false;
$checkInputQty = false;

if (isset($_SESSION['goodsID'][0])) {

    for ($i = 0; $i < count($_SESSION['goodsID']); $i++) {
        if ($_POST['goodsId'] == $_SESSION['goodsID'][$i]) {
            echo "Sorry , you have already add this product!";
            $repeatProduct = true;
            break;
        }
    }

    $sql = "select shop.shopID, remainingStock from goods, showcase, shop where goods.showcaseID = showcase.showcaseID and
            showcase.shopID = shop.shopID and goodsID = '{$_SESSION['goodsID'][0]}'";
    $rs = mysqli_query($conn, $sql);
    $rc = mysqli_fetch_assoc($rs);
    extract($rc);
    if ($shopID != $_POST['shopID']) {
        echo "Sorry, you can't add this product!\n";
        echo "In an order, all purchase goods must be located in the SAME shop.";
        $checkSameShop = true;
    }
}

if ((!$repeatProduct) and (!$checkSameShop) and (!$checkInputQty)) {
    $sql = "select * from goods where goodsID = {$_POST['goodsId']}";
    $rs = mysqli_query($conn, $sql);
    $rc = mysqli_fetch_assoc($rs);
    extract($rc);

    if (($_POST['buyQty'] > $remainingStock) or ($_POST['buyQty'] < 1)) {
        echo "You need to input the number between 1 - $remainingStock!";
        $checkInputQty = true;
    }

    if (!$checkInputQty) {
        $_SESSION['goodsID'][] = $goodsID;
        $_SESSION['goodsName'][] = $goodsName;
        $_SESSION['goodsPrice'][] = $stockPrice;
        $_SESSION['buyQty'][] = $_POST['buyQty'];
        echo "Added!";
    }
}

?>
