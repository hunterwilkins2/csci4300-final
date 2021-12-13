<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../resources/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/product_page.css">

    <title>Sneaks</title>
</head>
<body>
    <?php
        require('../util/DotEnv.php');

        (new DotEnv(__DIR__ . '/../.env'))->load();

        $mysqli = new mysqli(getenv("HOST"), getenv("USER"), getenv("PASSWORD"), getenv("DATABASE"));
        // $servername = "localhost";
        // $username = "root";
        // $password = "";
        // $db = "Store";

        // $mysqli = new mysqli($servername, $username, $password,$db);
    ?>
    <div class="container">
        <header>
            <a href="../index.php" class="logo">
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

        <main>
        <?php
            if(isset($_GET['id'])) {
                $sql_select = 'SELECT * FROM Products WHERE pid = ' . $_GET['id'];
                if ($result = $mysqli->query($sql_select)) {
                    $product = $result->fetch_object();
                    echo '<div class="image">';
                    echo '<img src="../mysql_data/images/' . $product->pimage . '" alt=' . $product->pname . '>';
                    echo '</div>';
                    echo '<div class="order">';
                    echo '<div class="info">';
                    echo '<h1 class="name">' . $product->pname . '</p>';
                    echo '<h2 class="type">' . $product->pdescription . '</h2>';
                    echo '<h2 class="price">$' . $product->price . '</h2>';
                    echo '</div>';
                    echo '<form action="./cart.php" method="post">';
                    echo '<h2>Size:</h2>';
                    echo '<div class="radio-toolbar">';
                    for ($x = 6.5; $x <= 14.5; $x = $x + 0.5) {
                        echo '<label>';
                        echo '<input type="radio" name="size" value="' . $x . '" required>';
                        echo '<span>' . $x . '</span>';
                        echo '</label>';
                    }
                    echo '</div>';
                    echo '<input type="hidden" name="pid" value="'. $_GET['id'] .'">'; 
                    echo '<button type="submit" name="btn" id="btn">Add to Cart</button>';
                    echo '</div>';
                } else {
                    echo '<p>Product not found</p>';
                }
            } else {
                echo '<p>Product not found</p>';
            }

        ?>
        </main>

        <footer>
            <p>Group 14 &copy 2021 Sneaks </p>
        </footer>
    </div>
</body>
</html>
