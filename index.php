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
        // $servername = "localhost";
        // $username = "root";
        // $password = "";
        // $db = "Store";

        // $mysqli = new mysqli($servername, $username, $password,$db);

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
                  setcookie('uid', "", time()-3600, '/');
                  header("Location: ./index.php");
                }
            ?>
            </nav>
        </header>

        <main>
            <div class="search">
                <form method="get">
                    <h3>Type</h3>
                    <input type="checkbox" name="running" onchange="this.form.submit()" <?php if(isset($_GET['running'])) echo "checked='checked'"; ?>>
                    <label for="running">Running</label>
                    <br>
                    <input type="checkbox" name="basketball" onchange="this.form.submit()" <?php if(isset($_GET['basketball'])) echo "checked='checked'"; ?>>
                    <label for="basketball">Basketball</label>
                    <br>
                    <input type="checkbox" name="skateboard" onchange="this.form.submit()" <?php if(isset($_GET['skateboard'])) echo "checked='checked'"; ?>>
                    <label for="skateboard">Skateboard</label>
                </form>

                <form method="get">
                    <h3>Gender</h3>
                    <input type="checkbox" name="men" onchange="this.form.submit()" <?php if(isset($_GET['men'])) echo "checked='checked'"; ?>>
                    <label for="men">Men's</label>
                    <br>
                    <input type="checkbox" name="women" onchange="this.form.submit()" <?php if(isset($_GET['women'])) echo "checked='checked'"; ?>>
                    <label for="women">Women's</label>
                </form>

                <form method="get">
                    <h3>Price</h3>
                    <input type="checkbox" name="0-50" onchange="this.form.submit()" <?php if(isset($_GET['0-50'])) echo "checked='checked'"; ?>>
                    <label for="0-50">$0 - $50</label>
                    <br>
                    <input type="checkbox" name="50-100" onchange="this.form.submit()" <?php if(isset($_GET['50-100'])) echo "checked='checked'"; ?>>
                    <label for="50-100">$50 - $100</label>
                    <br>
                    <input type="checkbox" name="100-150" onchange="this.form.submit()" <?php if(isset($_GET['100-150'])) echo "checked='checked'"; ?>>
                    <label for="100-150">$100 - $150</label>
                    <br>
                    <input type="checkbox" name="150-200" onchange="this.form.submit()" <?php if(isset($_GET['150-200'])) echo "checked='checked'"; ?>>
                    <label for="150-200">$150 - $200</label>
                    <br>
                    <input type="checkbox" name="200+" onchange="this.form.submit()" <?php if(isset($_GET['200+'])) echo "checked='checked'"; ?>>
                    <label for="200+">$200+</label>
                    <br>
                </form>

            </div>

            <div class="products">
                <?php
                    if(isset($_GET['running']) || isset($_GET['basketball']) || isset($_GET['skateboard']) || isset($_GET['men']) || isset($_GET['women']) ||
                        isset($_GET['0-50']) || isset($_GET['50-100']) || isset($_GET['100-150']) || isset($_GET['150-200']) || isset($_GET['200+'])) {
                        $sql_select = 'SELECT pid, pname, pdescription, price, pimage from Products WHERE 0 ';
                    } else {
                        $sql_select = 'SELECT pid, pname, pdescription, price, pimage from Products WHERE 1 ';
                    }

                    if(isset($_GET['running'])) {
                        $sql_select = $sql_select.'OR ptype = \'Running\' ';
                    }

                    if(isset($_GET['basketball'])) {
                        $sql_select = $sql_select.'OR ptype = \'Basketball\' ';
                    }

                    if(isset($_GET['skateboard'])) {
                        $sql_select = $sql_select.'OR ptype = \'Skateboard\' ';
                    }

                    if(isset($_GET['men'])) {
                        $sql_select = $sql_select.'OR pgender = \'Men\' ';
                    }

                    if(isset($_GET['women'])) {
                        $sql_select = $sql_select.'OR pgender = \'Women\' ';
                    }

                    if(isset($_GET['0-50'])) {
                        $sql_select = $sql_select.'OR price >= 0 AND price < 50 ';
                    }

                    if(isset($_GET['50-100'])) {
                        $sql_select = $sql_select.'OR price >= 50 AND price < 100 ';
                    }

                    if(isset($_GET['100-150'])) {
                        $sql_select = $sql_select.'OR price >= 100 AND price < 150 ';
                    }

                    if(isset($_GET['150-200'])) {
                        $sql_select = $sql_select.'OR price >= 150 AND price < 200 ';
                    }

                    if(isset($_GET['200+'])) {
                        $sql_select = $sql_select.'OR price >= 200';
                    }

                    $sql_select = $sql_select.'ORDER BY RAND()';

                    if ($result = $mysqli->query($sql_select)) {
                        while ($data = $result->fetch_object()) {
                            $products[] = $data;
                        }
                    }

                    foreach ($products as $product) {
                        echo '<div class="card">';
                        echo '<a href="./pages/product_page.php?id='. urlencode($product->pid) . '">';
                        echo '<div class="frame">';
                        echo '<img src="./mysql_data/images/' . $product->pimage . '" alt=' . $product->pname . '>';
                        echo '</div>';
                        echo '<p class="price">$' . $product->price . '</p>';
                        echo '<p class="name">' . $product->pname . '</p>';
                        echo '<p class="type">' . $product->pdescription . '</p>';
                        echo '</a>';
                        echo '</div>';
                    }
                ?>
            </div>
        </main>

        <footer>
            <p>Group 14 &copy 2021 Sneaks </p>
        </footer>
    </div>
</body>
</html>
