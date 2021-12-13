<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../resources/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/product_page.css">

    <title>Sneaks - Your Orders</title>

    <style>
      #titleText {
        text-align: center;
      }
      .ordersDiv {
        background-color: #6666ff;
        width: 95%;
        border-bottom-right-radius: 20px;
        border-top-right-radius: 20px;
        padding-bottom: 5px;
      }
      .image {
        width: 150px;
        height: 150px;
        float: left;
        padding-right: 17px;
        padding-left: 10px;
      }
      .orderText {
        display: inline;
      }
    </style>
</head>
<div class="container">
    <header>
        <a href="../index.php" class="logo">
            <i class="fas fa-tags"></i>
            <h1>Sneaks</h1>
        </a>
        <nav>

        <?php

        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "Store";

        $mysqli = new mysqli($servername, $username, $password,$db);

            if(isset($_COOKIE["uid"])) {
                $uidSql = "SELECT firstName FROM Users WHERE uid = '".$_COOKIE["uid"]."'";

                if ($result = $mysqli->query($uidSql)) {
                    $fname = $result->fetch_object()->firstName;
                    echo '<p>Hello, ' . $fname . '</p>';
                    echo '<a href="./accountInfo.php">Account Info</a>';
                    echo '<a href="./cart.php">Cart</a>';
                    echo '<a href="./orders.php">Orders</a>';
                    echo '<a href="?logout">Logout</a>';
                }
            } else {
                echo '<a href="./cart.php">Cart</a>';
                echo '<a href="./orders.php">Orders</a>';
                echo '<a href="./login.php">Login</a>';
            }

            if(isset($_GET['logout'])) {
                unset($_COOKIE['uid']);
                setcookie('uid', "", time()-3600, '/');
                header("Location: ../index.php");
            }
        ?>
        </nav>

    </header>

      <div id="titleText">
        <h1>Your Orders</h1>
      </div>
    <?php
      require ('wow.php');

      if(isset($_COOKIE["uid"])) {
        $sql = "SELECT * FROM orders WHERE uid='".$_COOKIE["uid"]."'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

          while($row = $result->fetch_assoc()) {?>
          <div class="ordersDiv">
              <img class="image" src=../mysql_data/images/<?php echo $row['pimage']?>>
              <h2 class="orderText"> <?php echo $row['pname'];?></h2><br><br>
              <p class="orderText"> Order ID:     <?php echo $row['oid'];?></p><br><br>
              <p class="orderText"> Product Price:  $<?php echo $row['price'];?></p><br><br>
              <p class="orderText"> Size: <?php echo $row['size'];?></p><br><br>
              <p class="orderText" style="margin-left: 10px;">  <?php echo $row['shippingAddr'];?></p><br>
          </div>
          <br>
          <?php
        }
      } else {
        echo '<h2 style="text-align: center;">Looks like you have no orders to display!
        Why not visit our <a href="../index.php" style="color:#6666ff">home page</a>?</h2>';
      }
    } else {
      echo '<h2 style="text-align: center;">Oops! It looks like you aren\'t logged in to view past orders.
      You can log in <a href="login.php" style="color:#6666ff">here</a>.</h2>';
    }
     ?>

  </div>
</body>
</html>
