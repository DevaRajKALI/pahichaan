<?php
require 'config/config.php';
include("includes/classes/User.php");
include("includes/classes/Post.php");
include("includes/classes/Message.php");
include("includes/classes/Notification.php");


/* 
22:34:22 23 Sep, 2019 by Arjun Adhikari
Fetching user information. 
FIXME Make me responsive.
*/
if (isset($_SESSION['username'])) {
	$userLoggedIn = $_SESSION['username'];
	$user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
	$user = mysqli_fetch_array($user_details_query);
} else {
	header("Location: register.php");
}

?>

<!DOCTYPE html>
<html>

<head>
	<title>Pahichaan</title>

	<link rel="icon" type="image/png" href="assets/images/logo-blue.png" />

	<script src="assets/js/ajax.js"></script>
	<script src="assets/js/header.js"></script>


	<link rel="stylesheet" href="assets/css/messaging.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/all.css">



</head>

<body>

	<div class="top_bar">
		<div class="logo">
			<a href="index.php">
				<img src="assets/images/logo.png">
				Pahichaan
			</a>
		</div>

		<nav>

			<?php
			//Unread messages 
			$messages = new Message($con, $userLoggedIn);
			$num_messages = $messages->getUnreadNumber();

			// NOTE Unread notifications 
			$notifications = new Notification($con, $userLoggedIn);
			$num_notifications = $notifications->getUnreadNumber();

			// Unread notifications 
			$user_obj = new User($con, $userLoggedIn);
			$num_requests = $user_obj->getNumberOfFriendRequests();
			?>

			<a href="<?php echo $userLoggedIn ?>">
				<?php echo $user['first_name']; ?>
			</a>
			<a href="index.php"><i class="fa fa-home fa-lg"></i> </a>
			<a href="messages.php"><i class="fa fa-envelope fa-lg"></i></a>
			<a href="notifications.php"><i class="fa fa-bell fa-lg"></i></a>
			<a href="requests.php"><i class="fa fa-users fa-lg"></i></a>
			<a href="settings.php"><i class="fa fa-cog fa-lg"></i></a>
			<a href="includes/handlers/logout.php"><i class="fa fa-sign-out-alt fa-lg"></i></a>

		</nav>


	</div>
	<div class="wrapper">