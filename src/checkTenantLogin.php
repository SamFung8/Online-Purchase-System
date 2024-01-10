<?php

$conn = mysqli_connect('127.0.0.1', 'root', '', 'projectdb') or die(mysqli_connect_error());
$sql = "SELECT password, tenantID FROM tenant";

$rs = mysqli_query($conn, $sql);

$checkLogin = false;

while ($rc = mysqli_fetch_assoc($rs)) {
    extract($rc);

    if (($tenantID == $_POST['Tenent_ID']) and ($password == $_POST['password'])) {
        $checkLogin = true;
        echo "true";
        setcookie('Tenent_ID', $tenantID, time() + 60 * 60);
        break;
    }
}

if (!$checkLogin)
    echo "false";

?>