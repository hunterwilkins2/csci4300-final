<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="./resources/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/products.css">

    <title>Sneaks</title>
</head>
<body>
    <?php
        require('./util/DotEnv.php');

        (new DotEnv(__DIR__ . '/.env'))->load();

        $mysqli = new mysqli(getenv("HOST"), getenv("USER"), getenv("PASSWORD"), getenv("DATABASE"));
    ?>
    <div class="container">
        <header>
            <a href="./index.php" class="logo">
                <i class="fas fa-tags"></i>
                <h1>Sneaks</h1>
            </a>
            <nav>
            <?php
                if(isset($_COOKIE["uid"])) {
                    $uidSql = "SELECT firstName FROM Users WHERE uid = '".$_COOKIE["uid"]."'";

                    if ($result = $mysqli->query($uidSql)) {
                        $fname = $result->fetch_object()->firstName;
                        echo '<p>Hello, ' . $fname . '</p>';
                        echo '<a href="./pages/accountInfo.php">Account Info</a>';
                        echo '<a href="./pages/cart.php">Cart</a>';
                        echo '<a href="./pages/orders.php">Orders</a>';
                        echo '<a href="?logout">Logout</a>';
                    }
                } else {
                    echo '<a href="./pages/cart.php">Cart</a>';
                    echo '<a href="./pages/orders.php">Orders</a>';
                    echo '<a href="./pages/login.php">Login</a>';
                }

                if(isset($_GET['logout'])) {
                    unset($_COOKIE['uid']); 
                    setcookie('uid', "", time()-3600); 
                    header("Location: ./index.php");
                }
            ?>
            </nav>
        </header>

        <main>
            <div class="search">
                <form method="get">
                    <h3>Type</h3>
                    <input type="checkbox" name="running">
                    <label for="running">Running</label>
                    <br>
                    <input type="checkbox" name="basketball">
                    <label for="basketball">Basketball</label>
                    <br>
                    <input type="checkbox" name="skateboard">
                    <label for="skateboard">Skateboard</label>
                </form>

                <form method="get">
                    <h3>Brand</h3>
                    <input type="checkbox" name="nike">
                    <label for="nike">Nike</label>
                    <br>
                    <input type="checkbox" name="adidas">
                    <label for="adidas">Adidas</label>
                </form>

                <form method="get">
                    <h3>Gender</h3>
                    <input type="checkbox" name="men">
                    <label for="men">Men's</label>
                    <br>
                    <input type="checkbox" name="women">
                    <label for="women">Women's</label>
                </form>

                <form method="get">
                    <h3>Price</h3>
                    <input type="checkbox" name="0-50">
                    <label for="0-50">$0 - $50</label>
                    <br>
                    <input type="checkbox" name="50-100">
                    <label for="50-100">$50 - $100</label>
                    <br>
                    <input type="checkbox" name="100-150">
                    <label for="100-150">$100 - $150</label>
                    <br>
                    <input type="checkbox" name="150-200">
                    <label for="150-200">$150 - $200</label>
                    <br>
                    <input type="checkbox" name="200+">
                    <label for="200+">$200+</label>
                    <br>
                </form>

            </div>

            <div class="products">
                <div class="card">
                    <img src="./mysql_data/images/nike.webp">
                    <p class="name">Nike ZoomX Invincible Run Flyknit</p>
                    <p class="type">Men's Road Running Shoes</p>
                    <p class="price">$130</p>
                </div>


                <div class="card">
                    <img src="./mysql_data/images/nike.webp">
                    <p class="name">Nike ZoomX Invincible Run Flyknit</p>
                    <p class="type">Men's Road Running Shoes</p>
                    <p class="price">$130</p>
                </div>


                <div class="card">
                    <img src="./mysql_data/images/nike.webp">
                    <p class="name">Nike ZoomX Invincible Run Flyknit</p>
                    <p class="type">Men's Road Running Shoes</p>
                    <p class="price">$130</p>
                </div>


                <div class="card">
                    <img src="./mysql_data/images/nike.webp">
                    <p class="name">Nike ZoomX Invincible Run Flyknit</p>
                    <p class="type">Men's Road Running Shoes</p>
                    <p class="price">$130</p>
                </div>


                <div class="card">
                    <img src="./mysql_data/images/nike.webp">
                    <p class="name">Nike ZoomX Invincible Run Flyknit</p>
                    <p class="type">Men's Road Running Shoes</p>
                    <p class="price">$130</p>
                </div>

                <div class="card">
                    <img src="./mysql_data/images/nike.webp">
                    <p class="name">Nike ZoomX Invincible Run Flyknit</p>
                    <p class="type">Men's Road Running Shoes</p>
                    <p class="price">$130</p>
                </div>

                <div class="card">
                    <img src="./mysql_data/images/nike.webp">
                    <p class="name">Nike ZoomX Invincible Run Flyknit</p>
                    <p class="type">Men's Road Running Shoes</p>
                    <p class="price">$130</p>
                </div>

            </div>
        </main>

        <footer>
            <p>Group 14 &copy 2021 Sneaks </p>
        </footer>
    </div>
</body>
</html>