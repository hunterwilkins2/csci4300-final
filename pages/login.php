<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../resources/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/form.css">

    <title>Sneaks - Login</title>
</head>
<body>
    <?php
        require('../util/DotEnv.php');

        (new DotEnv(__DIR__ . '/../.env'))->load();

        $mysqli = new mysqli(getenv("HOST"), getenv("USER"), getenv("PASSWORD"), getenv("DATABASE"));
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
            <div class="loginForm">
                <?php
                    if(isset($_POST["email"]) && isset($_POST["pass"])) {
                        // Gets the user account accociated with their email
                        $uidSql = "SELECT uid, password FROM Users WHERE email = '".$_POST["email"]."'";

                        $result = $mysqli->query($uidSql);
                        if (mysqli_num_rows($result) == 1) {
                            $user = $result->fetch_object();
                            $uid = $user->uid;
                            $hash = $user->password;

                            // Checks if the hashed password stored in the database is the same as their password
                            if(password_verify($_POST["pass"], $hash)) {
                                // Creates a new cookie and redirects them back to the homepage
                                setcookie("uid", $uid, isset($_POST["fname"]) ? time() + 3600 : 0, '/');

                                header("Location: ../index.php");
                            } else {
                                echo '<div class="error"><p>Username or Password were incorrect</p></div>';
                            }
                        } else {
                            echo '<div class="error"><p>Username or Password were incorrect</p></div>';
                        }
                    }
                ?>
                <form method="post">
                    <div class="stacked">
                        <label for="email">Email: </label>
                        <input type="text" name="email" id="email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
                    </div>
                    
                    <div class="stacked">
                        <label for="pass">Password: </label>
                        <input type="password" name="pass" id="pass" required>
                    </div>

                    <div class="twoCol">
                        <label for="stayLogged">Stay Logged in? </label>
                        <input type="checkbox" name="stayLogged" id="stayLogged">
                    </div>
                    
                    <div class="twoCol">
                        <button type="submit" name="btn" id="btn">Login</button>
                        <a href="./register.php">Create Account</a>
                    </div>
                </form>
            </div>
        </main>

        <footer>
            <p>Group 14 &copy 2021 Sneaks </p>
        </footer>
    </div>
</body>
</html>