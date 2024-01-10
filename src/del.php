<?php
  extract($_GET);
  //var_dump($_GET);

  if (isset($orderID)) {
    $conn = mysqli_connect("127.0.0.1", "root", "", "projectdb") or die(mysqli_connect_error());
    $sql = "SELECT * FROM orderitem WHERE orderID = '$orderID'";
    $rs = mysqli_query($conn,$sql);
    $num = mysqli_num_rows($rs);
    //var_dump($num);
    if ($num == 1) {
      $sql = "DELETE FROM orderitem WHERE orderID = '$orderID'";
      mysqli_query($conn, $sql) or print(mysqli_error($conn));
      $sql = "DELETE FROM orders WHERE orderID = '$orderID'";
      mysqli_query($conn, $sql) or print(mysqli_error($conn));
      header("Location:Report01.php");
    }else{
      echo '<script type="text/javascript">';
      echo "alert('You can\'t delete this order!')";
      echo '</script>';
      header("Refresh:0.1;url=Report01.php");
    } 
    mysqli_free_result($rs);
    mysqli_close($conn);
  }
?>