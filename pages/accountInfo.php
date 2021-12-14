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
            <form method="post" class="preferencesForm">
                <h3>Account Information</h3>

                <?php
                $selectSql = "SELECT * FROM users where uid = " . $_COOKIE['uid'];
                $result = $mysqli->query($selectSql);

                $oldUser = $result->fetch_object();
                if (isset($_POST['fname'])) {
                    if ($_POST['fname'] != $oldUser->firstName) {
                        $updateSql = "UPDATE users 
                        SET firstName = '" . $_POST['fname'] . "' 
                        WHERE uid = " . $_COOKIE['uid'];
                        $mysqli->query($updateSql);
                        echo '<div class="success"><p>Updated your first name</p></div>';
                    }
                }

                if (isset($_POST['lname'])) {
                    if ($_POST['lname'] != $oldUser->lastName) {
                        $updateSql = "UPDATE users 
                        SET lastName = '" . $_POST['lname'] . "' 
                        WHERE uid = " . $_COOKIE['uid'];
                        $mysqli->query($updateSql);
                        echo '<div class="success"><p>Updated your last name</p></div>';
                    }
                }

                if (isset($_POST['pass']) && isset($_POST['passConf']) && $_POST["pass"] != "") {
                    if ($_POST['pass'] === $_POST['passConf']) {
                        $passHash = password_hash($_POST["pass"], PASSWORD_DEFAULT);
                        $updateSql = "UPDATE users 
                        SET password = '" . $passHash . "' 
                        WHERE uid = " . $_COOKIE['uid'];
                        $mysqli->query($updateSql);
                        echo '<div class="success"><p>Updated password</p></div>';
                    } else {
                        echo '<div class="error"><p>Passwords do not match</p></div>';
                    }
                }
                ?>
                <?php
                $selectSql = "SELECT * FROM users where uid = " . $_COOKIE['uid'];
                $result = $mysqli->query($selectSql);

                $user = $result->fetch_object();
                ?>
                <div class="stacked">
                    <label for="email">Email: </label>
                    <input type="text" name="email" id="email" placeholder="<?php echo $user->email ?>" readonly>
                </div>
                <div class="twoCol">
                    <div class="stacked">
                        <label for="fname">First Name: </label>
                        <input type="text" name="fname" id="fname" value="<?php echo $user->firstName ?>">
                    </div>
                    <div class="stacked">
                        <label for="lname">Last Name: </label>
                        <input type="text" name="lname" id="lname" value="<?php echo $user->lastName ?>">
                    </div>
                </div>
                <div class="twoCol">
                    <div class="stacked">
                        <label for="pass">New Password: </label>
                        <input type="password" name="pass" id="pass">
                    </div>

                    <div class="stacked">
                        <label for="passConf">Confirm New Password: </label>
                        <input type="password" name="passConf" id="passConf">
                    </div>
                </div>
                <button type="submit" name="btn" id="btn">Update Preferences</button>
            </form>
        </main>

        <footer>
            <p>Group 14 &copy 2021 Sneaks </p>
        </footer>
    </div>
</body>

</html>