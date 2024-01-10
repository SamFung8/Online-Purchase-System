<!DOCTYPE html>
<html>

<head>

  <link rel="stylesheet" href="css/menu.css">
  <link rel="stylesheet" href="css/Goods/goodsInfo.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <title>Goods Information</title>


  <script>
    // Get the elements with class="column"
    var elements = document.getElementsByClassName("column");

    // Declare a loop variable
    var i;

    // List View
    function listView() {
      for (i = 0; i < elements.length; i++) {
        elements[i].style.width = "100%";
      }
    }

    // Grid View
    function gridView() {
      for (i = 0; i < elements.length; i++) {
        elements[i].style.width = "50%";
      }
    }

    /* Optional: Add active class to the current button (highlight it) */
    var container = document.getElementById("btnContainer");
    var btns = container.getElementsByClassName("btn_LG");
    for (var i = 0; i < btns.length; i++) {
      btns[i].addEventListener("click", function() {
        var current = document.getElementsByClassName("active");
        current[0].className = current[0].className.replace(" active", "");
        this.className += " active";
      });
    }



    function edit_PAQ(goodID) {

      var btn_cancel = document.getElementById('btn_cancel' + goodID);
      var submit = document.getElementById('submit' + goodID);
      var edit = document.getElementById('edit' + goodID);
      var delect = document.getElementById('delect' + goodID);

      btn_cancel.style.display = 'inline';
      submit.style.display = 'inline';
      edit.style.display = 'none';
      delect.style.display = 'none';


      var goodsprice = document.getElementById('Change_Stock_Price' + goodID);

      goodsprice.readOnly = false;
      goodsprice.placeholder = "New Stock Price";


      var Available = document.getElementById('Available' + goodID);
      var Unavailable = document.getElementById('Unavailable' + goodID);

      Available.disabled = false;
      Unavailable.disabled = false;
    }


    function cancel_edit(goodID, price, status) {

      var btn_cancel = document.getElementById('btn_cancel' + goodID);
      var submit = document.getElementById('submit' + goodID);
      var edit = document.getElementById('edit' + goodID);
      var delect = document.getElementById('delect' + goodID);

      btn_cancel.style.display = 'none';
      submit.style.display = 'none';
      edit.style.display = 'inline';
      delect.style.display = 'inline';


      var goodsprice = document.getElementById('Change_Stock_Price' + goodID);

      goodsprice.readOnly = true;
      goodsprice.placeholder = "$" + price;
      goodsprice.value = "";


      var Available = document.getElementById('Available' + goodID);
      var Unavailable = document.getElementById('Unavailable' + goodID);


      if (status == "1") {
        Available.checked = true;
        Unavailable.disabled = true;
      } else if (status == "2") {
        Available.disabled = true;
        Unavailable.checked = true;
      }
    }



    function cl_add() {
      var add_form = document.getElementById('add01');
      var add = document.getElementById('add');
      var d_add = document.getElementById('d_add');


      add_form.style.display = 'none';
      add.style.display = 'inline';
      d_add.style.display = 'none';
    }

    function op_add() {
      var add_form = document.getElementById('add01');
      var add = document.getElementById('add');
      var d_add = document.getElementById('d_add');


      add_form.style.display = 'inline';
      add.style.display = 'none';
      d_add.style.display = 'inline';
    }

    function del(orderID) {
      window.location.href = "Goods_del.php?goodsID=" + orderID;
    }
    
  </script>

</head>

<body>


  <h1 id="title">Welcome to Hong Kong Cube Shop</h1>

  <br>
  <!--this div is the menu bar-->
  <div class="menu">
    <li class="item" id="showcase">
      <a href="#product" class="btn"><i class="fas fa-shopping-bag"></i>Showcase</a>
      <div class="smenu">
        <a href="Goods_Information.php" class="sbtn">Information</a>
      </div>
    </li>

    <li class="item" id="order">
      <a href="#about" class="btn"><i class="fa fa-file-text-o"></i>Order</a>
      <div class="smenu">
        <a href="Report01.php" class="sbtn">Report</a>
      </div>
    </li>

    <li class="item" id="account">
      <a href="#settings" class="btn"><i class="fas fa-cog"></i>Account</a>
      <div class="smenu">
        <a href="logout.php" class="sbtn">Logout</a>
      </div>
    </li>
  </div>


  <div id="LG_Container">

    <h1 id="urf">Goods Information</h1>

    <div id="btnContainer">
      <button id="d_add" class="btn_LG" onclick="cl_add()">-</button>
      <button id="add" class="btn_LG" onclick="op_add()">+</button>
      <button class="btn_LG" onclick="listView()"><i class="fa fa-bars"></i> List</button>
      <button class="btn_LG active" onclick="gridView()"><i class="fa fa-th-large"></i> Grid</button>
    </div>
    <br>

    <div id="add01">

      <form method="post" action="Goods_Add.php" class="form-add">

        <hr>
        <label for='Tenant_showcaseid'>Your Showcase ID:</label>
        <?php
        extract($_COOKIE);  
        
        $conn = mysqli_connect("127.0.0.1", "root", "", "projectdb") or die(mysqli_connect_error());
        $sql = "SELECT showcase.showcaseID FROM showcase
        WHERE tenantID = '$Tenent_ID'";
        $rs = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($rs);
        
        while ($rc = mysqli_fetch_assoc($rs)) {
          //var_dump($rc);
          extract($rc);
          echo" | ";
          echo"$showcaseID";
        }
        echo" | ";
        ?>
        
        
        <br>
        
        <label for="showcaseid">Showcase ID:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <input type="text" class="form-control" name="showcaseid" pattern='[1-4]' maxlength='1'>
        <br>

        <label for="goodName">Good Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <input type="text" class="form-control" name="goodName" maxlength='255'>
        <br>

        <label for="stockPrice">Stock Price:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <input type="text" class="form-control" name="stockPrice" pattern='([0-9]+)+([.][0-9])?' maxlength='10'>
        <br>

        <label for="remianStock">Remaining Stock:&nbsp;</label>
        <input type="text" class="form-control" name="remianStock" maxlength='7'>
        <br>

        <label for="remianStock">Status: </label>
        Status:
        <input type="radio" id="available" name="status" value="1" checked>Available
        <input type="radio" id="unavailable" name="status" value="2">Unavailable
        <br>

        <br>

        <button type="submit" class="add_save">Save</button>
        <button type="reset" class="add_cancel" onclick="cl_add()">Cancel</button>
        <hr>

      </form>
    </div>
    <br>

    <?php
      extract($_COOKIE);     
//      var_dump($_COOKIE);
//      var_dump($_COOKIE["Tenent_ID"]);
//      echo"$Tenent_ID";
      
    
    
      $conn = mysqli_connect("127.0.0.1", "root", "", "projectdb") or die(mysqli_connect_error());

      $sql = "SELECT * FROM goods, showcase
      WHERE showcase.showcaseID = goods.showcaseID and
      showcase.tenantID = '$Tenent_ID'";
      $rs = mysqli_query($conn, $sql);
      $num = mysqli_num_rows($rs);
    
      $count = 3;
    
      while ($rc = mysqli_fetch_assoc($rs)) {
        extract($rc);
        //var_dump($rc);
        
        
        
        if ($count%2 == 1) {
          echo'<div class="row">';
        }
        
        if ($status == "1") {
          $sta_A = "checked";
          $sta_U = "disabled";
        } else if ($status == "2") {
          $sta_A = "disabled";
          $sta_U = "checked";
        }
        
        echo "
        <form method='post' action='Goods_Update.php' class='form-update{$goodsID}'>


        <div class='column' style='background-color:#aaa;border-style: double;'>

        <label for='Goods_Name' class='goodsInfo' id='Goods_Name_Text'><b>Goods Name:</b></label>
        <label for='Show_Goods_Name' class='goodsInfo'>$goodsName</label>
        <br>
        
        <label for='Showcase_ID' class='goodsInfo'><b>Showcase ID:</b></label>
        <label for='Show_Showcase_ID' class='goodsInfo'>$showcaseID</label>
        <br>

        <label for='Goods_ID' class='goodsInfo'><b>Goods ID:</b></label>
        <label for='Show_Goods_ID' class='goodsInfo'>$goodsID</label>
        
        <input type='text' name='goodsID' class='goods_ID' value='$goodsID' style='display: none;'>
        
        <br>


        <label for='Stock Price' class='goodsInfo'><b>Stock Price:</b></label>
        
        <input type='text' name='Change_SP' class='Change_Stock_Price' id='Change_Stock_Price$goodsID' placeholder='\$$stockPrice' pattern='([0-9]+)+([.][0-9])?' size='12' maxlength='10' required readonly >
        <br>

        <label for='Stock Quantity' class='goodsInfo'><b>Stock Quantity:</b></label>

        
        <input type='radio' id='Available{$goodsID}' name='Stock_Quantity{$goodsID}' value='1' $sta_A>Available
        <input type='radio' id='Unavailable{$goodsID}' name='Stock_Quantity{$goodsID}' value='2' $sta_U>Unavailable
        
        
        
        

        <br><br>

        <input type='button' class='edit' id='edit{$goodsID}' value='Edit' onclick='edit_PAQ($goodsID)'>

        <input type='button' class='btn_cancel' id='btn_cancel{$goodsID}' value='Cancel' onclick='cancel_edit($goodsID, $stockPrice, $status)'>



        <input type='submit' class='submit' id='submit{$goodsID}' value='Save Change'>
        
        <input type='button' class='delect' id='delect$goodsID' onclick='del($goodsID)' value='Remove'>

      </form>
      </div>
        ";
        
        if ($count%2 == 0) {
          echo'</div>';
        }
        
        
      }
    mysqli_free_result($rs);
    mysqli_close($conn);
    
    ?>










  </div>

</body>

</html>
