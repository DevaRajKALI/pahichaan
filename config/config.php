<?php 
/* 
20:17:20 23 Sep, 2019 by Arjun Adhikari
Configuration class for database connection, session starting and timezone setting. 
*/
ob_start(); //Turns on output buffering
session_start();

$timezone = date_default_timezone_set("Asia/Kathmandu");

$con = mysqli_connect("localhost", "root", "", "social"); //connection variable -server, username, password, table

if(mysqli_connect_errno())
{
	echo "Failed to connect: " . mysqli_connect_errno();
}

?>