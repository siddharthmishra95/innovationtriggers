<?php session_start(); ?>
<?php include('bootstrap.php') ?>
<?php include("includes/header.php") ?>
<?php
	include("dbconfig.php");

	if (isset($_POST['submit'])) {
		$user = mysqli_real_escape_string($mysqli, $_POST['name']);
		$pass = mysqli_real_escape_string($mysqli, $_POST['password']);

		if ($user == "" || $pass == "") {
			echo "Either username or password field is empty.";
			echo "<br/>";
			echo "<a href='index.php'>Go back</a>";
		} else {
			$result = mysqli_query($mysqli, "SELECT * FROM registration WHERE name='$user' AND password='$pass'")
				or die("Could not execute the select query.");

			$row = mysqli_fetch_assoc($result);

			if (is_array($row) && !empty($row)) {
				$validuser = $row['name'];
				$_SESSION['valid'] = $validuser;
				$_SESSION['name'] = $row['name'];
				$_SESSION['id'] = $row['usr_id'];
                $_SESSION['userid'] = $row['userid'];
                $_SESSION['role'] = $row['role'];

			} else {
				echo "Invalid username or password.";
				echo "<br/>";
				echo "<a href='index'>Go back</a>";
			}
			if (isset($_SESSION['valid'])) {
				header('Location: dashboard');
			}

			if (isset($_SESSION['valid'])) {
				header('Location: dashboard');
			}
		}
	} else {
	?>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="<?php echo BASE_URL; ?>includes/images/icon/logo.png" alt="CoolAdmin">
                            </a>
                        </div>
                        <div class="login-form">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input class="au-input au-input--full" type="text" name="name" id="name"
                                        placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" id="password" name="password"
                                        placeholder="Password">
                                </div>
                                <div class="login-checkbox">
                                    <label>
                                        <input type="checkbox" name="remember">Remember Me
                                    </label>
                                    <label>
                                        <a href="#">Forgotten Password?</a>
                                    </label>
                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit"
                                    name="submit">sign in</button>
                                <div class="social-login-content">
                                    <div class="social-button">
                                        <button class="au-btn au-btn--block au-btn--blue m-b-20">sign in with
                                            facebook</button>
                                        <button class="au-btn au-btn--block au-btn--blue2">sign in with twitter</button>
                                    </div>
                                </div>
                            </form>
                            <div class="register-link">
                                <p>
                                    Don't you have account?
                                    <a href="#">Sign Up Here</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <?php include_once("includes/footer.php") ?>

</body>
<?php
	}
	?>