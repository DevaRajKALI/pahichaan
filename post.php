<?php
include("includes/header.php");

/* 
21:37:21 23 Sep, 2019 by Arjun Adhikari
Get the ID of the post by GET request. 
FIXME Make my alignment straight.
*/
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = 0;
}
?>

<!-- 
21:38:21 23 Sep, 2019 by Arjun Adhikari
Display the user information. 
-->
<div class="user_details column">
    <a href="<?php echo $userLoggedIn; ?>"> <img src="<?php echo $user['profile_pic']; ?>"> </a>

    <div class="user_details_left_right">
        <a href="<?php echo $userLoggedIn; ?>">
            <?php
            echo $user['first_name'] . " " . $user['last_name'];

            ?>
        </a>
        <br>
        <?php echo "Posts: " . $user['num_posts'] . "<br>";
        echo "Likes: " . $user['num_likes'];
        ?>

    </div>
</div>

<!-- 
21:38:21 23 Sep, 2019 by Arjun Adhikari
Get the single post of the user. 
-->
<div class="main_column column" id="main_column">
    <div class="posts_area">

        <?php
        $post = new Post($con, $userLoggedIn);
        $post->getSinglePost($id);
        ?>

    </div>
</div>