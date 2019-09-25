<?php
/* 
13:02:13 24 Sep, 2019 by Arjun Adhikari
CSS and JQuery need to be removed. 
*/

require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';

?>


<!DOCTYPE html>
<html>

<head>

	<link rel="icon" type="image/png" href="assets/images/logo-blue.png" />
	<link rel="stylesheet" type="text/css" href="assets/css/logreg.css">
	<title>Welcome to Pahichaan!</title>

</head>

<body>

	<h2>PAHICHAAN</h2>
	<div class="container" id="container">
		<div class="form-container sign-up-container">

			<!-- 
			21:48:21 23 Sep, 2019 by Arjun Adhikari
			Form for login and register. 
			-->
			<form action="register.php" method="POST">
				<h3>Create Account</h3>

				<input type="text" name="reg_fname" placeholder="First Name" value="<?php
																					if (isset($_SESSION['reg_fname'])) {
																						echo $_SESSION['reg_fname'];
																					}
																					?>" required />
				<br />
				<?php if (in_array(
					"Your first name must be between 2 and 25 characters<br>",
					$error_array
				)) echo "Your first name must be between 2 and 25
          characters<br />"; ?>

				<input type="text" name="reg_lname" placeholder="Last Name" value="<?php
																					if (isset($_SESSION['reg_lname'])) {
																						echo $_SESSION['reg_lname'];
																					}
																					?>" required />
				<br />
				<?php if (in_array(
					"Your last name must be between 2 and 25 characters<br>",
					$error_array
				)) echo "Your last name must be between 2 and 25
          characters<br />"; ?>

				<input type="email" name="reg_email" placeholder="Email" value="<?php
																				if (isset($_SESSION['reg_email'])) {
																					echo $_SESSION['reg_email'];
																				}
																				?>" required>

				<input type="email" name="reg_email2" placeholder="Confirm Email" value="<?php
																							if (isset($_SESSION['reg_email2'])) {
																								echo $_SESSION['reg_email2'];
																							}
																							?>" required>

				<?php if (in_array("Email already in use<br>", $error_array)) echo "Email already in use<br>";
				else if (in_array("Invalid email format<br>", $error_array)) echo "Invalid email format<br>";
				else if (in_array("Emails don't match<br>", $error_array)) echo "Emails don't match<br>"; ?>

				<input type="password" name="reg_password" placeholder="Password" required>

				<input type="password" name="reg_password2" placeholder="Confirm Password" required>

				<?php if (in_array("Your passwords do not match<br>", $error_array)) echo "Your passwords do not match<br>";
				else if (in_array("Your password can only contain characters or numbers<br>", $error_array)) echo "Your password can only contain characters or numbers<br>";
				else if (in_array("Your password must be between 5 or 30 characters<br>", $error_array)) echo "Your password must be between 5 or 30 characters<br>"; ?>


				<input type="submit" name="register_button" value="Register">
			</form>
		</div>
		<div class="form-container sign-in-container">
			<form action="register.php" method="POST">
				<h1>Sign in</h1>
				<span>or use your account</span>

				<input type="email" name="log_email" placeholder="Email Address" value="<?php
																						if (isset($_SESSION['log_email'])) {
																							echo $_SESSION['log_email'];
																						}
																						?>" required />

				<input type="password" name="log_password" placeholder="Password" />
				<input type="submit" name="login_button" value="Login">



				<?php if (in_array("<span style='color: #14C800;'> You're all set! Go login</span><br>", $error_array)) echo "<span style='color: #14C800;'> You're all set! Go login</span><br>"; ?>

			</form>
		</div>
		<div class="overlay-container">
			<div class="overlay">
				<div class="overlay-panel overlay-left">
					<h1>Welcome Back!</h1>
					<p>
						To keep connected with us please login with your personal info.
					</p>
					<button class="ghost" id="signIn">Let's Sign In</button>
				</div>
				<div class="overlay-panel overlay-right">
					<h1>Hello, Professional</h1>
					<p>Enter your personal details and start journey with us.</p>
					<button class="ghost" id="signUp">Let's Sign Up</button>
				</div>
			</div>
		</div>
	</div>

</body>
<script type="text/javascript" src="assets/js/logreg.js"></script>

</html>