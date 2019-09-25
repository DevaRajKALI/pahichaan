<?php

include("includes/header.php");

/* 
	21:28:21 23 Sep, 2019 by Arjun Adhikari
	Get the user ID of the person to send message.
	Else, get the most recent user s/he contacted. 
	*/
$message_obj = new Message($con, $userLoggedIn);

if (isset($_GET['u'])) {
	$user_to = $_GET['u'];
} else {
	$user_to = $message_obj->getMostRecentUser();

	if ($user_to == false)
		$user_to = 'new';
}

/* 
	21:30:21 23 Sep, 2019 by Arjun Adhikari
	If user is fetched from GET request, then $user_to_obj creates new user object. 
	*/
if ($user_to != 'new')
	$user_to_obj = new User($con, $user_to);

/* 
	21:31:21 23 Sep, 2019 by Arjun Adhikari
	If post_message named input field was clicked. 
	*/
if (isset($_POST['post_message'])) {

	/* 
		21:31:21 23 Sep, 2019 by Arjun Adhikari
		If message body was not empty, then message is sent to the particular user. 
		*/
	if (isset($_POST['message_body'])) {
		$body = mysqli_real_escape_string($con, $_POST['message_body']);
		$date = date("Y-m-d H:i:s");
		$message_obj->sendMessage($user_to, $body, $date);
	}
}

?>

<!-- 
21:33:21 23 Sep, 2019 by Arjun Adhikari
Display the user details sideway. 
-->
<div class="user_details column">
	<a href="<?php echo $userLoggedIn ?>"> <img src="<?php echo $user['profile_pic'] ?>"></a>

	<div class="user_details_left_right">
		<a href="<?php echo $userLoggedIn; ?>">
			<?php
			echo $user['first_name'] . " " . $user['last_name'];

			?>
		</a>
		<br>
		<div class="lay_wrapper">
			<div class="lay lay_red">
				<i class='fas fa-pen-alt'></i> <br>
				<?php echo $user['num_posts'] . " Posts"; ?>
			</div>
			<div class="lay lay_blue">
				<i class='fas fa-thumbs-up'></i> <br>
				<?php echo $user['num_likes'] . " Likes";
				?>
			</div>
		</div>
	</div>
</div>


<!-- 
21:33:21 23 Sep, 2019 by Arjun Adhikari
Displays the fetched messages with the particular user.
-->
<div class="main_column column" id="main_column">
	<?php

	if ($user_to != "new") {
		echo "<h4>You and <a href='$user_to'>" . $user_to_obj->getFirstAndLastName() . "</a></h4><hr><br>";

		echo "<div class = 'loaded_messages' id='scroll_messages'>";
		echo $message_obj->getMessages($user_to);
		echo "</div>";
	} else {
		echo "<h4>New Message</h4>";
	}

	?>


	<!-- 
	21:34:21 23 Sep, 2019 by Arjun Adhikari
	Post new message to the particular user. 
	-->
	<div class="message_post">
		<form action="" method="POST">
			<?php
			if ($user_to == "new") {
				echo "Select the friend you would like to message <br><br>";
				?>
				To: <input type='text' onkeyup='getUsers(this.value, "<?php echo $userLoggedIn; ?>")' name='q' placeholder='Name' autocomplete='off' id='search_text_input'>

			<?php
				echo "<div class='results'></div>";
			} else {
				echo "<textarea name='message_body' id='message_textarea' placeholder='Write your message'></textarea>";
				echo "<input type ='submit' name='post_message' class='info' id='message_submit' value ='send'>";
			}
			?>
		</form>

	</div>

	<!-- TODO Documentation -->
	<script>
		var div = document.getElementById("scroll_messages");
		div.scrollTop = div.scrollHeight;
	</script>


</div>

<!-- 
21:36:21 23 Sep, 2019 by Arjun Adhikari
Get the brief summary of messages with other users. 
-->
<div class="user_details column" id="conversations">

	<h4>Conversations</h4>
	<div class="loaded_conversations">
		<?php echo $message_obj->getConvos(); ?>
		<br>
		<a href="messages.php?u=new">New Message</a>

	</div>

</div>