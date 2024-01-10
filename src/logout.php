<!doctype html>
<html lang="en">

<head>
  <title>Document</title>
</head>

<body>
  <?php
if (isset($_COOKIE['userEmail'])) {
    setcookie('userEmail', '', time() - 60 * 60);
    setcookie('loginStatus', 1, time() - 60 * 60);
    echo "
    <script type='text/javascript'>
        alert('Logout success !');
      </script>
    ";
} else if (isset($_COOKIE['Tenent_ID'])) {
    setcookie('Tenent_ID', '', time() - 60 * 60);
    echo "
    <script type='text/javascript'>
        alert('Logout success !');
      </script>
    ";
} else {
    echo "
    <script type='text/javascript'>
        alert('Please login first !');
      </script>
    ";
}

echo "
    <script type='text/javascript'>
        window.location.href = 'index.php';
      </script>
    ";

?>
</body>

</html>
