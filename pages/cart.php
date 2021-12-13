<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../resources/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/product_page.css">

    <title>Sneaks - Cart Items</title>

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
        //displays the title bar if logged in or not
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

            if(isset($_POST["pid"])) {
                $idSql = INSERT INTO cartitems (uid, pid, size);
                $uidSql = (int)$_POST['pid'];
                $pidSql = (int)$_POST[]
                $sizeSql = (int)$_POST['size'];
            }

            // logs out
            if(isset($_GET['logout'])) {
                unset($_COOKIE['uid']);
                setcookie('uid', "", time()-3600, '/');
                header("Location: ../index.php");
            }


        ?>
        </nav>

    </header>
      <div id="titleText">
        <h1>Checkout Cart</h1>
      </div>



</div>
</html>
