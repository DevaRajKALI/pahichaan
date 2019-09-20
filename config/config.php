<?php
//========================= Turning on Output Buffer =========================
ob_start(); 
//========================= Session Start =========================
session_start();
//========================= Establishing a connection =========================
$con = mysqli_connect("localhost",  "root", "", "social");

//========================= If error in connection =========================
if (mysqli_connect_errno()) {
    echo "Failed to connect : " . mysqli_connect_errno();
}
//========================= Setting TimeZone =========================
$timezone = date_default_timezone_set("Asia/Kathmandu");

?>