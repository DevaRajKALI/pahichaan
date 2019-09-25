<?php
include("includes/header.php");

/* 
21:08:21 23 Sep, 2019 by Arjun Adhikari
Post Logic:
If someone posts something on global scope i.e. $user_to = none. 
FIXME Make Admin Panel look better.
*/
if (isset($_POST['post'])) {

    $uploadOk = 1;
    $imageName = $_FILES['fileToUpload']['name'];
    $errorMessage = "";

    if ($imageName != "") {
        $targetDir = "assets/images/posts/";
        $imageName = basename($imageName);
        $imageFileType = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

        if ($_FILES['fileToUpload']['size'] > 10000000) {
            $errorMessage = "Sorry your file is too large";
            $uploadOk = 0;
        }

        if (strtolower($imageFileType) != "jpeg" && strtolower($imageFileType) != "png" && strtolower($imageFileType) != "jpg") {
            $errorMessage = "Sorry, only jpeg, jpg and png files are allowed";
            $uploadOk = 0;
        }

        if ($uploadOk) {
            /* 
            00:54:00 25 Sep, 2019 by Arjun Adhikari
            Renaming files and storing in a separate folder. 
            */
            $imageName = $targetDir . "post" . rand(10000, 99999) . "." . $imageFileType ;
            if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $imageName)) {
                //image uploaded okay
            } else {
                //image did not upload
                $uploadOk = 0;
            }
        }
    }

    if ($uploadOk) {
        $post = new Post($con, $userLoggedIn);
        $post->submitPost($_POST['post_text'], 'none', $imageName);
    } else {
        echo "<div style='text-align:center; color:red;'>
				$errorMessage
			</div>";
    }
}


?>

<!-- 
21:08:21 23 Sep, 2019 by Arjun Adhikari
Display the profile picture and user's information. 
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
21:10:21 23 Sep, 2019 by Arjun Adhikari
Form for posting status. 
-->
<div class="main_column column">
    <form class="post_form" action="index.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="fileToUpload" id="fileToUpload">
        <textarea name="post_text" id="post_text" placeholder="Got something to say?"></textarea>
        <!-- 
        23:20:23 24 Sep, 2019 by Arjun Adhikari
        -->
        <input type="submit" name="post" id="post_button" value="Post">
        <hr>
    </form>

    <div class="posts_area"></div>
    <img id="loading" src="assets/images/icons/loading.gif">
</div>

<!-- 
21:23:21 23 Sep, 2019 by Arjun Adhikari
News Feed Display Logic 
-->
<script>
    var userLoggedIn = '<?php echo $userLoggedIn; ?>';

    $(document).ready(function() {

        $('#loading').show();

        //Original ajax request for loading first posts 
        $.ajax({
            url: "includes/handlers/ajax_load_posts.php",
            type: "POST",
            data: "page=1&userLoggedIn=" + userLoggedIn,
            cache: false,

            success: function(data) {
                $('#loading').hide();
                $('.posts_area').html(data);
            }
        });

        $(window).scroll(function() {
            var height = $('.posts_area').height(); //Div containing posts
            var scroll_top = $(this).scrollTop();
            var page = $('.posts_area').find('.nextPage').val();
            var noMorePosts = $('.posts_area').find('.noMorePosts').val();

            if ((document.body.scrollHeight == document.body.scrollTop + window.innerHeight) && noMorePosts == 'false') {
                $('#loading').show();

                var ajaxReq = $.ajax({
                    url: "includes/handlers/ajax_load_posts.php",
                    type: "POST",
                    data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
                    cache: false,

                    success: function(response) {
                        $('.posts_area').find('.nextPage').remove(); //Removes current .nextpage 
                        $('.posts_area').find('.noMorePosts').remove(); //Removes current .nextpage 

                        $('#loading').hide();
                        $('.posts_area').append(response);
                    }
                });

            } //End if 

            return false;

        }); //End (window).scroll(function())


    });
</script>
</div>
</body>

</html>