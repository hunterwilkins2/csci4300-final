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

    <title>Sneaks - Account Info</title>
	<style>
      #titleText {
        text-align: center;
      }
	label {
	color: white;
	}
	main {
	padding-left: 30px;
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

        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "Store";

        $mysqli = new mysqli($servername, $username, $password,$db);

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
      <div id="titleText">
        <h1>Account Information</h1>
      </div>

	<main>
	<div class="updateInfo">

    <?php

	if(isset($_COOKIE["uid"])) {
		$uidSql = "SELECT email FROM Users WHERE uid = '".$_COOKIE["uid"]."'";
		if ($result = $mysqli->query($uidSql)) {
                    $mail = $result->fetch_object()->email;
                    echo '<p>Email: ' . $mail . '</p>';
        	}
		$uidSql = "SELECT firstName FROM Users WHERE uid = '".$_COOKIE["uid"]."'";
		if ($result = $mysqli->query($uidSql)) {
                    $fname = $result->fetch_object()->firstName;
                    echo '<p>First Name: ' . $fname . '</p>';
        	}
		$uidSql = "SELECT lastName FROM Users WHERE uid = '".$_COOKIE["uid"]."'";
		if ($result = $mysqli->query($uidSql)) {
                    $lname = $result->fetch_object()->lastName;
                    echo '<p>Last Name: ' . $lname . '</p>';
        	}
	}
    ?>
	<div id="subtitleText">
		<h2>Update User Information</h2>
	</div>
   <?php
	if(isset($_POST['update'])) {
                          $fName = $_POST['fname'];
                          $lName = $_POST['lname'];
                          $pass = $_POST['pass'];

                        $passHash = password_hash($_POST["pass"], PASSWORD_DEFAULT);
                        $updateSql = "UPDATE users
                              SET firstName = '$fName', lastName = '$lName',
                              password = '$passHash'
                              WHERE uid = '".$_COOKIE["uid"]."'";
                            $mysqli->query($updateSql);


                        if($_POST["pass"] == $_POST["passConf"] && $_POST["pass"] != "") {
                            if($mysqli->query($updateSql) === TRUE) {
                                $uidSql = "SELECT uid FROM Users WHERE uid = '".$_COOKIE["uid"]."'";
                                $result = $mysqli->query($uidSql);

                                if (mysqli_num_rows($result) == 1) {
                                    $uid = $result->fetch_object()->uid;

                                    setcookie("uid", $uid, isset($_POST["fname"]) ? time() + 3600 : 0, '/');
                                }
                            } else {

                                echo '<div class="error"><p>Info invalid</p></div>';
                            }
                        } else {
                            echo '<div class="error"><p>Passwords do not match</p></div>';
                        }
			}


                      echo '<form class="update" method="post">
                       		<label for="fname">First name:</label><br>
                        		<input type="text" id="fname" name="fname" value=""><br>
                        		<label for="lname">Last name:</label><br>
                        		<input type="text" id="lname" name="lname" value=""><br><br>
                      		<label for="pword">Password:</label><br>
                        		<input type="text" id="pass" name="pass" value=""><br>
                      		<label for="cpword">Confirm Password:</label><br>
                        		<input type="text" id="passConf" name="passConf" value=""><br><br>
                      	<div class="twoCol">
                      		<button type="update" name="update" id="btn">Update Info</button>
                      	</div>
                      	</form>';
                        

?>

  <?php

   ?>

    </div>
  </main>

	<footer>
            <p>Group 14 &copy 2021 Sneaks </p>
        </footer>
    </div>
</body>
</html>
