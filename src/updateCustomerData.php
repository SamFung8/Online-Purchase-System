<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>UpdateCustomerData</title>
    <link rel="stylesheet" href="css\Customer\designTitle.css">
    <link rel="stylesheet" href="css\Customer\shoppingCartList.css">
    <link rel="stylesheet" href="css\Customer\customerInfoUpdate.css">
    <link rel="stylesheet" href="css\Customer\menu.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
</head>

<body>
<h1 id="title">Customer Profile</h1>

    <!--the menu-->

  <div class="menu">
    <li class="item" id='home'>
      <a href="index.php" class="btn"><i class="fas fa-home"></i>Home</a>
    </li>

    <li class="item" id="settings">
      <a href="#settings" class="btn"><i class="fa fa-user-secret" aria-hidden="true"></i>Account</a>
      <div class="smenu">
        <?php
            if (!isset($_COOKIE['userEmail']) and !isset($_COOKIE['Tenent_ID']))
                echo "<a href=\"Register.php\" class=\"sbtn\">Register</a>";
        
            if (!isset($_COOKIE['userEmail']) and !isset($_COOKIE['Tenent_ID']))
                    echo "<a href=\"Login_Type.php\" class=\"sbtn\">Login</a>";

            if (isset($_COOKIE['userEmail']) or isset($_COOKIE['Tenent_ID']))
                echo "<a href=\"logout.php\" class=\"sbtn\">Logout</a>";

            if (isset($_COOKIE['userEmail']))
                echo "<a href=\"updateCustomerData.php\" class=\"sbtn\">Info</a>";
            ?>
      </div>
    </li>

    <li class="item" id='shoppingCart'>
      <a href="#shoppingCart" class="btn" onclick="openNav()"><i class="fas fa-shopping-cart"></i>Shopping
        Cart</a>
    </li>
  </div>


<script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "650px";
        $.ajax({
            url: "getShoppingCartProduct.php",
            success: function (data) {
                console.log(data);
                $('#mySidenav').html(data);
            }
        });
    }

    /* Set the width of the side navigation to 0 */
    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
</script>

<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
</div>

<script>
    function deleteShoppingCartProduct(goodsID) {
        $.ajax({
            url: "deleteShoppingCartProduct.php",
            method: "POST",
            data: {
                goodsID: goodsID
            },
            success: function (data) {
                console.log(data);
            }
        });
        openNav();
    }
</script>


<div class="customerInfo">
    <?php
    $conn = mysqli_connect('127.0.0.1', 'root', '', 'projectdb');
    $sql = "select * from customer where customerEmail = '{$_COOKIE['userEmail']}'";
    $rs = mysqli_query($conn, $sql);
    $rc = mysqli_fetch_assoc($rs);
    extract($rc)
    ?>

    <h1>Email: <?php echo "$customerEmail" ?></h1>
    <div class=info>
        <label>First Name: <label class="firstName"><?php echo "$firstName" ?></label> </label><br></div>
    <div class=info>
        <label>Last Name: <label class="lastName"><?php echo "$lastName" ?></label> </label><br></div>
    <div class=info>
        <label>Phone: <label class="phone"><?php echo "$phoneNumber" ?></label> </label><br></div>
    <div class=info>
        <label>Password: <label class="password"><?php echo "$password" ?></label></label><br></div>
    <button href="#" id="btnEdit" class="infoEdit">Edit</button>

    <button href="#" id="btnDelete" class="infoDelete">Delete</button>
    <button type="submit" id="btnSave" class="infoSave">Save</button>

    <script>
        $('#btnEdit').click(function () {
            document.getElementById("btnSave").style.display = "block";
            document.getElementById("btnEdit").style.display = "none";
            document.getElementById("btnDelete").style.display = "none";

            var textFirstName = $('.firstName').text();
            var inputFirstName = $('<input id="updateFirstName" type="text" value="' + textFirstName + '" />')
            $('.firstName').text('').append(inputFirstName);

            var textLastName = $('.lastName').text();
            var inputLastName = $('<input id="updateLastName" type="text" value="' + textLastName + '" />')
            $('.lastName').text('').append(inputLastName);

            var textPhone = $('.phone').text();
            var inputPhone = $('<input id="updatePhone" type="text" value="' + textPhone + '" />')
            $('.phone').text('').append(inputPhone);

            var textPassword = $('.password').text();
            var inputPassword = $('<input id="updatePassword" type="text" value="' + textPassword + '" />')
            $('.password').text('').append(inputPassword);
        });

        $(document).ready(function () {
            $('#btnSave').click(function () {
                var email = "<?php echo "$customerEmail" ?>"
                var firstName = document.getElementById("updateFirstName").value;
                var lastName = document.getElementById("updateLastName").value;
                var phone = document.getElementById("updatePhone").value;
                var password = document.getElementById("updatePassword").value;
                $.ajax({
                    url: "changeCustomerData.php",
                    method: "POST",
                    data: {
                        email: email,
                        firstName: firstName,
                        lastName: lastName,
                        phone: phone,
                        password: password
                    },
                    success: function (data) {
                        alert("Changed!");
                        location.replace("updateCustomerData.php");
                    }
                });
            });
        });

        $(document).ready(function () {
            $('#btnDelete').click(function () {
                var check = confirm("Are you sure delete your account ?");
                if (check == true) {
                    $.ajax({
                        url: "deleteCustomerData.php",
                        method: "POST",
                        data: {},
                        success: function (data) {
                            alert("Deleted!");
                            location.replace("index.php");
                        }
                    });
                }
                if (check == true) {
                    $.ajax({
                        url: "logout.php",
                        method: "POST",
                        data: {},
                        success: function (data) {
                        }
                    });
                }
            });
        });

    </script>
</div>
</body>
</html>