<?php

/*
========================================

	TEST $_SESSION['falseAttempts']

========================================
*/

require 'config/config.php';
include 'includes/classes/IPTracker.php';

$ipTracker = new IPTracker($con);


// Check if ips are blocked

/* 
07:52:07 25 Sep, 2019 by Arjun Adhikari
NOTE Remove this while demo of Admin Panel Login 
*/
$blockedIPs = $ipTracker->getBlockedIPs();
$currentIP = $ipTracker->getIP();
if (in_array($currentIP, $blockedIPs)) {
	header("Location: blockip.php");
}



$count = 0;
$_SESSION['falseAttempts'] = $count;

$username = "";
$password = "";
$loginChance = 1;



if (isset($_POST['button_login'])) {

	$username = strip_tags($_POST['username']);
	$password = strip_tags($_POST['password']);
	$passwordHash = md5($password);

	$sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$passwordHash'";
	$result = $con->query($sql);

	if ($result->num_rows == 1) {
		while ($row = $result->fetch_assoc()) {
			$admin = $row['username'];
			$_SESSION['admin'] = $admin;
			unset($_SESSION['falseAttempts']);
			header("Location: adminPanel.php");
		}
	} else {
		$count  = $count + 1;
		$_SESSION['falseAttempts'] = $count;
		if ($_SESSION['falseAttempts'] >= $loginChance) {
			$ipTracker->blockIP();
		}
		echo "Invalid username or password";
	}
}

?>

<!DOCTYPE html>
<html>

<head>
	<title></title>
	<link rel="stylesheet" href="assets/css/admin.css">
	<style>
		body {
			width: 100%;
			float: right;
			background-image: url("assets/images/block.jpg");

			/* Full height */
			background-size: cover;
			background-repeat: no-repeat;
		}

		
	</style>
</head>

<body>

	<h1 align="center">Admin Panel</h1>

	<div align="center">
		<form action="" method="POST">
			<input type="name" name="username" placeholder="Username" style="background:none;">
			<br><br>
			<input type="password" name="password" placeholder="Password">
			<br><br>
			<button id="" name="button_login">Login</button>
		</form>
	</div>

</body>

</html>