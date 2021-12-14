<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../resources/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/accountInfo.css">

    <title>Sneaks - Your Orders</title>
</head>

<body>
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

                if (isset($_GET['logout'])) {
                    unset($_COOKIE['uid']);
                    setcookie('uid', "", time() - 3600, '/');
                    header("Location: ./../index.php");
                }
                ?>
            </nav>
        </header>

        <main>
            <div id="titleText">
                <h1>Account Information</h1>
            </div>
            <div class="updateInfo">
                <div class="preferencesForm">
                    <h2>Account Information</h2>
                    <?php
                    if (isset($_COOKIE["uid"])) {
                        $uidSql = "SELECT email FROM users WHERE uid = '" . $_COOKIE["uid"] . "'";
                        if ($result = $mysqli->query($uidSql)) {
                            $mail = $result->fetch_object()->email;
                            echo '<p>Email: ' . $mail . '</p>';
                        }
                        $uidSql = "SELECT firstName FROM users WHERE uid = '" . $_COOKIE["uid"] . "'";
                        if ($result = $mysqli->query($uidSql)) {
                            $fname = $result->fetch_object()->firstName;
                            echo '<p>First Name: ' . $fname . '</p>';
                        }
                        $uidSql = "SELECT lastName FROM users WHERE uid = '" . $_COOKIE["uid"] . "'";
                        if ($result = $mysqli->query($uidSql)) {
                            $lname = $result->fetch_object()->lastName;
                            echo '<p>Last Name: ' . $lname . '</p>';
                        }
                    }
                    ?>
                </div>

                <form class="preferencesForm" method="post">
                    <h2>Update User Information</h2>

                    <?php
                    if (isset($_POST['update'])) {
                        $fName = $_POST['fname'];
                        $lName = $_POST['lname'];
                        $pass = $_POST['pass'];

                        $passHash = password_hash($_POST["pass"], PASSWORD_DEFAULT);
                        $updateSql = "UPDATE users
                              SET firstName = '$fName', lastName = '$lName',
                              password = '$passHash'
                              WHERE uid = '" . $_COOKIE["uid"] . "'";

                        if ($_POST["pass"] == $_POST["passConf"] && $_POST["pass"] != "") {
                            if ($mysqli->query($updateSql) === TRUE) {
                                echo "<meta http-equiv='refresh' content='0'>";         
                            } else {
                                echo '<div class="error"><p>Info invalid</p></div>';
                            }
                        } else {
                            echo '<div class="error"><p>Passwords do not match</p></div>';
                        }
                    }
                    ?>
                    <div class="twoCol">
                        <div class="stacked">
                            <label for="fname">First name:</label>
                            <input type="text" id="fname" name="fname" value="" required>
                        </div>
                        <div class="stacked">
                            <label for="lname">Last name:</label>
                            <input type="text" id="lname" name="lname" value="" required>
                        </div>
                    </div>

                    <div class="stacked">
                        <label for="pword">Password:</label>
                        <input type="password" id="pass" name="pass" value="" required>
                    </div>
                    <div class="stacked">
                        <label for="cpword">Confirm Password:</label>
                        <input type="password" id="passConf" name="passConf" value="">
                    </div>
                    <button type="update" name="update" id="btn">Update Info</button>
                </form>
            </div>
        </main>

        <footer>
            <p>Group 14 &copy 2021 Sneaks </p>
        </footer>
    </div>
</body>

</html>