<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../resources/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/checkout.css">

    <title>Sneaks - Checkout</title>
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
        <div class="checkout">
            <div>
                <?php
                $selectSql = "SELECT * FROM cartitems INNER JOIN products ON products.pid = cartitems.pid WHERE uid = " . $_COOKIE['uid'];
                if ($result = $mysqli->query($selectSql)) {
                    while ($data = $result->fetch_object()) {
                        echo '<div class="cartitem">';
                        echo '<div class="frame">';
                        echo '<img src="../mysql_data/images/' . $data->pimage . '" alt=' . $data->pname . '>';
                        echo '</div>';
                        echo '<div class="product">';
                        echo '<p class="name">' . $data->pname . '</p>';
                        echo '<p class="price">$' . $data->price . '</p>';
                        echo '</div>';
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
                }
                ?>
            </div>
            <form method="post">
                <div class="stacked">
                    <label for="creditcart">Credit Card Number: </label>
                    <input type="text" name="creditcart" id="creditcart">
                </div>
                <div class="stacked">
                    <label for="name">Name on card: </label>
                    <input type="text" name="name" id="name">
                </div>
                <div class="twoCol">
                    <div class="stacked">
                        <label for="date">Expiration Date: </label>
                        <input type="date" name="date" id="date">
                    </div>
                    <div class="stacked">
                        <label for="ccv">CCV: </label>
                        <input type="text" name="ccv" id="ccv" maxlength="3" minlength="3">
                    </div>
                </div>
                <div class="stacked">
                    <label for="creditcart">Address: </label>
                    <input type="text" name="address" id="creditcart">
                </div>
                <div class="twoCol">
                    <div class="stacked">
                        <label for="state">State: </label>
                        <input type="text" name="state" id="state" maxlength="2" minlength="2">
                    </div>
                    <div class="stacked">
                        <label for="zipcode">Zipcode: </label>
                        <input type="text" name="zipcode" id="zipcode" maxlength="5" minlength="5">
                    </div>
                </div>
                <button type="submit" name="btn" id="btn">Order</button>
            </form>
            <?php
            if (isset($_POST['address'])) {
                $address = '"' . $_POST['address'] . ', ' . $_POST['state'] . ' ' . $_POST['zipcode'] . '"';
                $insertSql = "INSERT INTO orders (uid, shippingAddr, size, pid) 
            SELECT " . $_COOKIE['uid'] . ", " . $address . ", size, pid
            FROM cartitems
            WHERE uid = " . $_COOKIE['uid'];
                $mysqli->query($insertSql);

                $deleteSql = "DELETE FROM cartitems WHERE uid = " . $_COOKIE['uid'];
                $mysqli->query($deleteSql);

                header("Location: ./orders.php");
            }
            ?>
        </div>
    </main>
    <footer>
        <p>Group 14 &copy 2021 Sneaks </p>
    </footer>
</div>

</html>