<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <link rel="stylesheet" href="css/Register/designRs.css">
  <link rel="stylesheet" href="css/menu.css">
  <link rel="stylesheet" href="css/Register/btnRs.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">

  <script>
    //this function wil change the input type between text and password
    function show_PW() {
      var pw = document.getElementById('password');
      var cpw = document.getElementById('conPassword');
      if (cpw.type == "password") {
        pw.type = 'text';
        cpw.type = 'text';
      } else if (cpw.type == "text") {
        pw.type = 'password';
        cpw.type = 'password';
      }
    }

    //this function wil check all the input of the form step by step
    function Validata() {
      var fname = document.getElementById("fname").value;
      var lname = document.getElementById("lname").value;
      var phone = document.getElementById("phone").value;
      var checkPhone = /^\d+$/;
      var email = document.getElementById("email").value;
      var pw = document.getElementById("password").value;
      var cpw = document.getElementById("conPassword").value;
      var notes = document.getElementById("notes");

      //check name is it null
      if (fname.length == 0) {
        notes.innerHTML = "Please enter your First Name.";
        notes.style.display = 'block';
        return false;
      }

      if (lname.length == 0) {
        notes.innerHTML = "Please enter your Last Name.";
        notes.style.display = 'block';
        return false;
      }

      //check phone is it null
      if (phone.length == 0) {
        notes.innerHTML = "Please enter your phone number.";
        notes.style.display = 'block';
        return false;
      }
      //check phone is it only number
      if (phone.match(checkPhone)) {} else {
        notes.innerHTML = "Phone number only have number.";
        notes.style.display = 'block';
        return false;
      }
      //check phone is it have 8 number
      if (phone.length < 8) {
        notes.innerHTML = "Phone number need to enter 8 number.";
        notes.style.display = 'block';
        return false;
      }

      //check email is it null
      if (email.length == 0) {
        notes.innerHTML = "Please enter your email address.";
        notes.style.display = 'block';
        return false;
      }

      //check password is it null
      if (pw.length == 0) {
        notes.innerHTML = "Please enter your password.";
        notes.style.display = 'block';
        return false;
      }
      //check confirm password is it null
      if (cpw.length == 0) {
        notes.innerHTML = "Please confirm your password.";
        notes.style.display = 'block';
        return false;
      }

      //check password and confirm password is it less than 8 number
      if (pw.length < 8) {
        notes.innerHTML = "Passwords please more than 8 character.";
        notes.style.display = 'block';
        return false;
      } else if (cpw.length < 8) {
        notes.innerHTML = "Confirm Passwords please more than 8 character.";
        notes.style.display = 'block';
        return false;
      }

      //check password and confirm password is it match
      if (pw != cpw) {
        notes.innerHTML = "Passwords do not match.";
        notes.style.display = 'block';
        return false;
      }
      return true;
    }

    //hide the h4
    function hideNotes() {
      var notes = document.getElementById("notes");
      notes.style.display = 'none';
    }

    //change the text that in the h4 and show it to user
    function nameNotes() {
      var notes = document.getElementById("notes");
      notes.innerHTML = "You need to enter 8 number as your phone number.";
      notes.style.display = 'block';
    }

    //change the text that in the h4 and show it to user
    function pwNotes() {
      var notes = document.getElementById("notes");
      notes.innerHTML = "You need to enter at least 8 characters as your password.";
      notes.style.display = 'block';
    }

    //change the text that in the h4 and show it to user
    function cpwNotes() {
      var notes = document.getElementById("notes");
      notes.innerHTML = "You need to enter your password again.";
      notes.style.display = 'block';
    }

  </script>
</head>

<body>
  <h1 id="title">Welcome to Hong Kong Cube Shop</h1>
  <br>
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

  </div>



  <form id="flex-container" method="post" action="Registration.php">


    <div id="form">
      <h1 id="urf">User Registration Form</h1>
      <h3 id="message">The red * mean you must enter it.</h3>


      <label for="fname"><b><a class="mustInPut">*</a>First name:</b></label>
      <input type="text" name="fname" id="fname" placeholder="Enter First Name" onblur="hideNotes()" required><br>

      <label for="lname"><b><a class="mustInPut">*</a>Last Name:</b></label>
      <input type="text" name="lname" id="lname" placeholder="Enter Last name" onblur="hideNotes()" required><br>


      <label for="phone"><b><a class="mustInPut">*</a>Phone:</b></label>
      <input type="tel" name="phone" id="phone" placeholder="Enter HK phone number" maxlength="8" onclick="nameNotes()" onblur="hideNotes()" required><br>

      <label for="email"><b><a class="mustInPut">*</a>Email:</b></label>
      <input type="email" name="email" id="email" placeholder="Enter your email" onblur="hideNotes()" required><br>

      <label for="password"><b><a class="mustInPut">*</a>Password:</b></label>
      <input type="password" name="password" class="pwd" id="password" placeholder="Enter Password" onclick="pwNotes()" onblur="hideNotes()" required><br>

      <label for="conPassword"><b><a class="mustInPut">*</a>Confirm Password:</b></label>
      <input type="password" name="confirmPassword" class="pwd" id="conPassword" onclick="cpwNotes()" onblur="hideNotes()" placeholder="Enter Password Again" required>

      <input type="button" id="showPw" value="Show Password" onclick="show_PW()"><br>


      <input type="submit" id="submit" value="Submit" onclick="hideNotes();return Validata()">


      <input type="reset" id="clearData" value="Clear Data">
      <!--this part will show the message to the user by the js.-->
      <h4 id="notes"></h4>

    </div>
  </form>
</body>

</html>
