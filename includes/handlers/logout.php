<?php 

/* 
20:28:20 24 Sep, 2019 by Arjun Adhikari
Session is started and immediately destroyed.
Then user is redirected to the login page. 
*/
	session_start();
	session_destroy();
	header("Location: ../../register.php");
?>