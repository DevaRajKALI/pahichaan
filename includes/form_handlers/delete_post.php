<?php
require '../../config/config.php';

/* 
22:22:22 23 Sep, 2019 by Arjun Adhikari
Fetch post ID by GET request. 
*/
if (isset($_GET['post_id']))
	$post_id = $_GET['post_id'];

/* 
22:21:22 23 Sep, 2019 by Arjun Adhikari
Delete post logic: Set deleted attribute to yes for the particular post ID. 
*/
if (isset($_POST['result'])) {
	if ($_POST['result'] == 'true')
		$query = mysqli_query($con, "UPDATE posts SET deleted='yes' WHERE id='$post_id'");
}
