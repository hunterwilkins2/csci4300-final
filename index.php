<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Sneaks</title>
</head>
<body>
    <?php
        require('DotEnv.php');

        (new DotEnv(__DIR__ . '/.env'))->load();

        $mysqli = new mysqli(getenv("HOST"), getenv("USER"), getenv("PASSWORD"), getenv("DATABASE"));
    ?>
    <div class="container">
        <header>
            <nav>
            <?php
                if(isset($_COOKIE["uid"])) {
                    $uidSql = "SELECT firstName FROM Users WHERE uid = '".$_COOKIE["uid"]."'";

                    if ($result = $mysqli->query($uidSql)) {
                        $fname = $result->fetch_object()->firstName;
                        echo '<p>Hello, ' . $fname . '</p>';
                        echo '<a href="?logout">Logout</a>';
                    }
                } else {
                    echo '<a href="./login.php">Login</a>';
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
        </main>

        <footer>
            <p>Group 14 &copy 2021 Sneaks </p>
        </footer>
    </div>
</body>
</html>