<?php
  extract($_POST);
  //var_dump($_POST);

  $conn = mysqli_connect("127.0.0.1", "root", "", "projectdb") or die(mysqli_connect_error());
  $sql = "SELECT * FROM `customer` WHERE `customerEmail` = '$email' ";
  $rs = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($rs);

  if ($num != 0) {
    echo '<script language="javascript">';
    echo 'alert("This email has been used.")';
    echo '</script>';
    mysqli_close($conn);
    header("Refresh:0.1; url=Register.html");
  } else {
    $sql = "INSERT INTO `customer` VALUES ('$email', '$fname', '$lname', '$password', '$phone')";
    mysqli_query($conn, $sql) or print(mysqli_error($conn));
    $num = mysqli_affected_rows($conn);
    mysqli_close($conn);
    echo '<script language="javascript">';
    echo 'alert("Registration Successful!.")';
    echo '</script>';
    header("Refresh:0.1; url=Login_Type.php");
  }
?>