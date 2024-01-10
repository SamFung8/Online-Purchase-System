<?php
  extract($_GET);

  if(isset($goodsID)){
    $conn = mysqli_connect("127.0.0.1", "root", "", "projectdb") or die(mysqli_connect_error());
    $sql = "UPDATE goods SET status = '2' WHERE  goods.goodsID ='$goodsID'";
    mysqli_query($conn, $sql) or print(mysqli_error($conn));
    if (mysqli_affected_rows($conn) > 0) {
      echo '<script type="text/javascript">';
      echo "alert('You deleted this good \(Set the Stock Quantity to Unavilable\)')";
      echo '</script>';
      mysqli_close($conn);
      header("Refresh:0.1;url=Goods_Information.php");
    } else {
      echo '<script type="text/javascript">';
      echo "alert('This good has been Deleted')";
      echo '</script>';
      mysqli_close($conn);
      header("Refresh:0.1;url=Goods_Information.php");
    }
  }

?>