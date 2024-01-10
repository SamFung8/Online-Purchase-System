<?php
extract($_POST);
//var_dump($_POST);
extract($_COOKIE); 

  $conn = mysqli_connect("127.0.0.1", "root", "", "projectdb") or die(mysqli_connect_error());
  $sql = "SELECT showcase.showcaseID
  FROM   orders, orderitem, goods, showcase
  WHERE orderitem.orderID = orders.orderID and
  goods.goodsID = orderitem.goodsID and
  showcase.showcaseID = goods.showcaseID and
  showcase.tenantID = '$Tenent_ID'";
  $rs = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($rs);

  if ($num == 0) {
    echo '<script language="javascript">';
    echo 'alert("You don\'t have this showcase.")';
    echo '</script>';
    mysqli_close($conn);
    header("Refresh:0.1; url=Goods_Information.php");
  } else {
  $conn = mysqli_connect("127.0.0.1", "root", "", "projectdb") or die(mysqli_connect_error());
  $sql = "INSERT INTO `goods` (`goodsID`, `showcaseID`, `goodsName`, `stockPrice`, `remainingStock`, `status`) VALUES (NULL, '$showcaseid', '$goodName', '$stockPrice', '$remianStock', '$status');";
  mysqli_query($conn, $sql) or print(mysqli_error($conn));
  $num = mysqli_affected_rows($conn);
  //echo "$num";
  mysqli_close($conn);
  header("Location:Goods_Information.php");
  }

?>