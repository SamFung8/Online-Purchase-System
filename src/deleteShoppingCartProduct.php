<?php
session_start();
$totalItems = count($_SESSION['goodsID']);

for ($i = 0; $i < $totalItems; $i++) {
    if ($_SESSION['goodsID'][$i] == $_POST['goodsID']) {

        for ($j = $i + 1 ; $j < count($_SESSION['goodsID']); $j++) {
            $_SESSION['goodsID'][$j-1] = $_SESSION['goodsID'][$j];
            $_SESSION['goodsPrice'][$j-1] = $_SESSION['goodsPrice'][$j];
            $_SESSION['goodsName'][$j-1] = $_SESSION['goodsName'][$j];
            $_SESSION['buyQty'][$j-1] = $_SESSION['buyQty'][$j];
        }

        unset($_SESSION['goodsID'][$totalItems-1]);
        unset($_SESSION['goodsPrice'][$totalItems-1]);
        unset($_SESSION['goodsName'][$totalItems-1]);
        unset($_SESSION['buyQty'][$totalItems-1]);
        break;
    }

}

?>
