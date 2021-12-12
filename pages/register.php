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

    <title>Sneaks - Register</title>
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
                    if(isset($_POST["fname"]) && isset($_POST["lname"]) && isset($_POST["email"]) && isset($_POST["pass"]) && isset($_POST["passConf"])) {
                        
                        $passHash = password_hash($_POST["pass"], PASSWORD_DEFAULT); // Hash users password
                        $insertSql = "INSERT INTO Users (firstName, lastName, email, password) 
                            VALUES ('".$_POST["fname"]."', '".$_POST["lname"]."', '".$_POST["email"]."', '".$passHash."')"; // Insert statement
    
                        if($_POST["pass"] == $_POST["passConf"] && $_POST["pass"] != "") { // Check if password and confirm password are the same
                            if($mysqli->query($insertSql) === TRUE) { // Creates new users account
                                $uidSql = "SELECT uid FROM Users WHERE email = '".$_POST["email"]."'"; 
                                $result = $mysqli->query($uidSql);
                                
                                // Gets the new users uid, stores it in a cookie, and redirects them to the homepage
                                if (mysqli_num_rows($result) == 1) {
                                    $uid = $result->fetch_object()->uid;
        
                                    setcookie("uid", $uid, isset($_POST["fname"]) ? time() + 3600 : 0, '/');
        
                                    header("Location: ./index.php");
                                }
                            } else {
                                // Checks for duplicate email
                                if($mysqli->errno == 1062) {
                                    echo '<div class="error"><p>That email has already been used.</p></div>';

                                } else {
                                    echo '<div class="error"><p>Could not create user</p></div>';
                                }
                            }                        
                        } else {
                            echo '<div class="error"><p>Passwords do not match</p></div>';
                        }
                    }
                ?>
                <form method="post">
                    <div class="twoCol">
                        <div class="stacked">
                            <label for="fname">First Name: </label>
                            <input type="text" name="fname" id="fname" required>
                        </div>
                        <div class="stacked">
                            <label for="lname">Last Name: </label>
                            <input type="text" name="lname" id="lname" required>
                        </div>
                    </div>

                    <div class="stacked">
                        <label for="email">Email: </label>
                        <input type="text" name="email" id="email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
                    </div>
                    
                    <div class="twoCol">
                        <div class="stacked">
                            <label for="pass">Password: </label>
                            <input type="password" name="pass" id="pass" required>
                        </div>

                        <div class="stacked">
                            <label for="passConf">Confirm Password: </label>
                            <input type="password" name="passConf" id="passConf" required>
                        </div>
                    </div>

                    <div class="twoCol">
                        <label for="stayLogged">Stay Logged in? </label>
                        <input type="checkbox" name="stayLogged" id="stayLogged">
                    </div>
                    <button type="submit" name="btn" id="btn">Register</button>
                </form>
            </div>
        </main>

        <footer>
            <p>Group 14 &copy 2021 Sneaks </p>
        </footer>
    </div>
</body>
</html>