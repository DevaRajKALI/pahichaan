<?php

require 'config/config.php';
include 'includes/classes/Admin.php';
include 'includes/classes/IPTracker.php';


// Check if the Admin is logged in
if (isset($_SESSION['admin'])) {
	$adminLoggedIn = $_SESSION['admin'];
} else {
	header("Location: admin.php");
	exit();
}



$admin = new Admin($con);
$ipTracker = new IPTracker($con);


if (isset($_POST['logout'])) {
	session_destroy();
	header("Location: admin.php");
	exit();
}


// Block User
if (isset($_POST['button_block'])) {
	$admin->blockUser(strip_tags($_POST['target']));
}

// Unblock User
if (isset($_POST['button_unblock'])) {
	$admin->unblockUser(strip_tags($_POST['target']));
}

// Delete User
if (isset($_POST['button_delete'])) {
	$admin->deleteUser(strip_tags($_POST['target']));
}

// Unblock IP Address
if (isset($_POST['button_ip_unblock'])) {
	$ipTracker->unblockIP(strip_tags($_POST['targetIP']));
}

?>


<!DOCTYPE html>
<html>

<head>
	<title></title>
	<link rel="stylesheet" href="admin.css">

	<style type="text/css">
		th,
		td {
			border-bottom: 1px solid #ddd;
			padding: 10px;
			text-align: left;
		}

		tr:hover {
			background-color: #f5f5f5;
		}

		#userDetails {
			float: left;
		}

		#sidebar {
			float: right;
			margin-right: 50px;
		}
	</style>

</head>

<body>

	<div>
		<h1>Admin Panel</h1>
		<form action="" method="POST">
			<button id="" name="logout">Logout</button>
		</form>
	</div>


	<div id="infoByName">
		<h2>Get Information By Username</h2>
		<form action="" method="POST">
			<input type="text" name="target" placeholder="username">
			<br><br>
			<button name="Button_getInfo">Get Information</button>
		</form>
	</div>

	<?php
	if (isset($_POST['Button_getInfo'])) {
		$admin->getUsersInfoByUsername(strip_tags($_POST['target']));
	}
	?>


	<div id="userDetails">
		<h2>User Details</h2>

		<table id="table-details">

			<th>id</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Username</th>
			<th>Email</th>
			<th>Signup Date</th>
			<th>Active</th>
			<th>Status</th>

			<?php $admin->getUsersInfo(); ?>
		</table>
	</div>

	<div id="blockedIP">
		<h2>Blocked IP Addresses</h2>

		<table id="table-details">

			<th>id</th>
			<th>IP Address</th>
			<th>Blocked Date</th>

			<?php $ipTracker->getBlockedIPsRow(); ?>
		</table>
	</div>


	<div id="sidebar">

		<div id="performAction">
			<h2>Perform Action</h2>
			<form action="" method="POST">
				<input type="text" name="target" placeholder="Target username">
				<br><br>
				<button name="button_block">Block</button>
				<button name="button_unblock">Unblock</button>
				<button name="button_delete">Delete</button>
			</form>
		</div>

		<div id="unblockIP">
			<h2>Unblock IP</h2>
			<form action="" method="POST">
				<input type="text" name="targetIP" placeholder="IP Address">
				<br><br>
				<button name="button_ip_unblock">Unblock</button>
			</form>
		</div>

		<br><br>

		<div id="statistics">
			<h2>User's Statistics</h2>
			<div>
				<h4>Total Users :</h4><?php echo " " . $admin->totalUsersCount(); ?>
			</div>
			<div>
				<h4>Total Active Users :</h4><?php echo " " . $admin->activeUsersCount(); ?>
			</div>
			<div>
				<h4>Blocked Users :</h4><?php echo " " . $admin->blockedUsersCount(); ?>
			</div>
		</div>
	</div>

</body>

</html>