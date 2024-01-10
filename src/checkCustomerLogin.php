<?php

$conn = mysqli_connect('127.0.0.1', 'root', '', 'projectdb') or die(mysqli_connect_error());
$sql = "SELECT password, customerEmail FROM customer";

$rs = mysqli_query($conn, $sql);

$checkLogin = false;

while ($rc = mysqli_fetch_assoc($rs)) {
    extract($rc);

    if (($customerEmail == $_POST['email']) and ($password == $_POST['password'])) {
        $checkLogin = true;
        echo "true";
        setcookie('userEmail', $customerEmail, time() + 60 * 60);
        setcookie('loginStatus', 0, time() + 60 * 60);
        break;
    }
}

if (!$checkLogin){
    echo "false";
}
?>