<?php

if (isset($_POST['login_button'])) {

	/* 
	22:22:22 23 Sep, 2019 by Arjun Adhikari
	Email is sanitized first. 
	*/
	$email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL);

	/* 
	22:23:22 23 Sep, 2019 by Arjun Adhikari
	Store email into session variable. 
	*/
	$_SESSION['log_email'] = $email;

	/* 
	22:23:22 23 Sep, 2019 by Arjun Adhikari
	Get password. 
	*/
	$password = md5($_POST['log_password']);

	$check_database_query = mysqli_query($con, "SELECT * FROM users WHERE email='$email' AND password='$password'");
	$check_login_query = mysqli_num_rows($check_database_query);

	/* 
	22:24:22 23 Sep, 2019 by Arjun Adhikari
	If credentials entered by user are correct. 
	*/
	if ($check_login_query == 1) {
		$row = mysqli_fetch_array($check_database_query);
		$username = $row['username'];

		/* 
		03:34:03 25 Sep, 2019 by Arjun Adhikari
		If user is trying to login with a blocked account by administrator. 
		*/
		$user_blocked_query = mysqli_query($con, "SELECT * FROM users WHERE email='$email' AND status='blocked'");
		if (mysqli_num_rows($user_blocked_query) > 0) {

			/* 
			22:25:22 23 Sep, 2019 by Arjun Adhikari
			Redirect to error page. 
			NOTE Why it doesn't redirect ?
			*/
			header("Location: blockedaccount.php");
			exit();
		}


		/* 
		22:24:22 23 Sep, 2019 by Arjun Adhikari
		If user is trying to open a closed account. 
		*/
		$user_closed_query = mysqli_query($con, "SELECT * FROM users WHERE email='$email' AND user_closed='yes'");
		if (mysqli_num_rows($user_closed_query) == 1) {

			/* 
			22:25:22 23 Sep, 2019 by Arjun Adhikari
			Set closed attribute to 'no' for that particular user. 
			*/
			$reopen_account = mysqli_query($con, "UPDATE users SET user_closed='no' WHERE email='$email'");
		}

		/* 
		22:25:22 23 Sep, 2019 by Arjun Adhikari
		Store username in session variable for successfully logged in user. 
		*/
		$_SESSION['username'] = $username;
		header("Location: index.php");
		exit();
	} else {
		
		$count_fetch_query = "SELECT * FROM login_attempts WHERE email='$email'";
		$count_fetch = mysqli_query($con, $count_fetch_query);
		if (mysqli_num_rows($count_fetch) == 1) {
			$count = mysqli_fetch_array($count_fetch)['attempts'];
		} else {
			$count = 0;
		}

		/* 
		04:04:04 25 Sep, 2019 by Arjun Adhikari
		If user fails another login attempt, then increment the attempt by 1. 
		*/
		$count = $count + 1;
		$failed_attempt_query = "INSERT INTO login_attempts VALUES('', '$email', '$count')";
		array_push($error_array, "Email or password was incorrect<br>");
	}
}
