<!doctype html>
<html lang="en">
<head>
    <title>Document</title>
</head>
<body>
<?php
$conn = mysqli_connect('127.0.0.1', 'root','','projectdb');
$sql = "update customer set firstName = '{$_POST['firstName']}' , lastName = '{$_POST['lastName']}'
        , password = '{$_POST['password']}' , phoneNumber = '{$_POST['phone']}'
        where customerEmail = '{$_COOKIE['userEmail']}'";
mysqli_query($conn,$sql);
?>
</body>
</html>