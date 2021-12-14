<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="../resources/favicon.ico">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="../styles/style.css">
  <link rel="stylesheet" href="../styles/cart.css">

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
      require('../util/DotEnv.php');

      (new DotEnv(__DIR__ . '/../.env'))->load();

      $mysqli = new mysqli(getenv("HOST"), getenv("USER"), getenv("PASSWORD"), getenv("DATABASE"));

      //displays the title bar if logged in or not
      if (isset($_COOKIE["uid"])) {
        $uidSql = "SELECT firstName FROM users WHERE uid = '" . $_COOKIE["uid"] . "'";

        if ($result = $mysqli->query($uidSql)) {
          $fname = $result->fetch_object()->firstName;
          echo '<p>Hello, ' . $fname . '</p>';
          echo '<a href="./accountInfo.php">Account Info</a>';
          echo '<a href="./cart.php">Cart</a>';
          echo '<a href="./orders.php">Orders</a>';
          echo '<a href="?logout">Logout</a>';
        }
      } else {
        header("Location: ./login.php");
      }

      // logs out
      if (isset($_GET['logout'])) {
        unset($_COOKIE['uid']);
        setcookie('uid', "", time() - 3600, '/');
        header("Location: ./index.php");
      }
      ?>
    </nav>
  </header>
  <main>
    <?php
    if (isset($_POST["pid"]) && $_POST["size"]) {
      $insertSql = "INSERT INTO cartitems (uid, pid, size)
            VALUES ('" . $_COOKIE["uid"] . "', '" . $_POST["pid"] . "', '" . $_POST["size"] . "')";
      $mysqli->query($insertSql);
    }
    ?>
    <div id="titleText">
      <h1>Checkout Cart</h1>
      <?php
      $selectSql = "SELECT * FROM cartitems INNER JOIN products ON products.pid = cartitems.pid WHERE uid = " . $_COOKIE['uid'];
      if ($result = $mysqli->query($selectSql)) {
        while ($data = $result->fetch_object()) {
          echo '<div class="cartitem">';
          echo '<div class="frame">';
          echo '<img src="../mysql_data/images/' . $data->pimage . '" alt=' . $data->pname . '>';
          echo '</div>';
          echo '<div class="description">';
          echo '<p class="name">' . $data->pname . '</p>';
          echo '<p class="type">' . $data->pdescription . '</p>';
          echo '</div>';
          echo '<div class="priceDiv">';
          echo '<p class="price">$' . $data->price . '</p>';
          echo '<p class="size">Size: ' . $data->size . '</p>';
          echo '</div>';
          echo '<form class="delete" method="post"><button name="delete" value="' . $data->pid . '">Remove item</button></form>';
          echo '</div>';
        }

        $totalSql = "SELECT sum(products.price) total FROM cartitems INNER JOIN products ON products.pid = cartitems.pid WHERE cartitems.uid = " . $_COOKIE['uid'];
        if ($result2 = $mysqli->query($totalSql)) {
          if (mysqli_num_rows($result) != 0) {
            echo '<h2 class="total">Total - $' . $result2->fetch_object()->total . '</h2>';
          } else {
            echo '<h2 class="total">Total - $0</h2>';
          }
        }

        echo '<form action="./checkout.php">';
        echo '<button class="checkoutbutton" type="submit" name="btn" id="btn">Checkout</button>';
        echo '</form>';
      }

      if (isset($_POST['delete'])) {
        $delteItem = "DELETE from cartitems WHERE pid = " . $_POST['delete'];
        $mysqli->query($delteItem);
        echo "<meta http-equiv='refresh' content='0'>";
      }
      ?>
    </div>
  </main>
  <footer>
    <p>Group 14 &copy 2021 Sneaks </p>
  </footer>
</div>

</html>