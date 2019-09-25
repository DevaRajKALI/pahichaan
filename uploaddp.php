<?php

include("includes/header.php");
?>

<!-- 
19:43:19 24 Sep, 2019 by Arjun Adhikari
Enctype is set and attributes are set. 
-->
<form action="uploaddp.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="dp_submit">
</form>

</body>

<?php
if (isset($_POST['dp_submit'])) {


    $target_dir = "assets/images/profile_pics/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    /* 
    19:43:19 24 Sep, 2019 by Arjun Adhikari
    Check if image file is a actual image or fake image. 
    */
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    
    /* 
    19:43:19 24 Sep, 2019 by Arjun Adhikari
    Check if file already exists. 
    */
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    /* 
    19:44:19 24 Sep, 2019 by Arjun Adhikari
    Check file size. 
    */
    if ($_FILES["fileToUpload"]["size"] > 50000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    
    /* 
    19:44:19 24 Sep, 2019 by Arjun Adhikari
    Allow certain file formats. 
    */
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    
    /* 
    19:44:19 24 Sep, 2019 by Arjun Adhikari
    Check if $uploadOk is set to 0 by an error. 
    */
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        
        /* 
        19:45:19 24 Sep, 2019 by Arjun Adhikari
        If everything is ok, try to upload file. 
        */
    } else {
        $target_file = $target_dir . "display-picture" . rand(100, 999) . "." . $imageFileType;
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
            $query = "UPDATE users SET profile_pic = '$target_file' WHERE username='$userLoggedIn'";
            $result = mysqli_query($con, $query);
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>