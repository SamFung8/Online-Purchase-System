<?php
extract($_POST);
//var_dump($_POST);



//var_dump({$_POST['Stock_Quantity'.$goodsID]});

    $conn = mysqli_connect("127.0.0.1", "root", "", "projectdb") or die(mysqli_connect_error());
    $sql = "UPDATE `goods` SET `stockPrice` = '$Change_SP', `status` = '{$_POST['Stock_Quantity'.$goodsID]}' WHERE `goods`.`goodsID` = '$goodsID';";
    mysqli_query($conn, $sql) or print(mysqli_error($conn));
    $num = mysqli_affected_rows($conn);
    //echo "$num";
    mysqli_close($conn);
    header("Location:Goods_Information.php");



?>
