<?php
if (isset($_POST['login_button'])) {
    //========================= Sanitizing Email =========================

    $email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL);
    $_SESSION['log_email'] = $email;

    $password = md5($_POST['log_password']);

    //========================= Checking Database =========================

    $check_database_query = mysqli_query($con, "SELECT * FROM users WHERE email='$email' AND password='$password'");
    $check_login_query = mysqli_num_rows($check_database_query);

    //========================= Case : Successful Login ========================= 
    if ($check_login_query == 1) {

        //========================= Fetching User Data ========================= 
        $userdata = mysqli_fetch_array($check_database_query);

        //========================= Storing username to SESSION variable. ========================= 
        $username = $userdata['username'];
        $_SESSION['username'] = $username;

        //========================= Re-opening a closed account =========================

        $user_closed_query = mysqli_query($con, "SELECT * FROM users WHERE email='$email' and user_closed = 'yes'");
        if (mysqli_num_rows($user_closed_query) == 1) {
            $reopen_account = mysqli_query($con, "UPDATE users set user_closed='no' WHERE email='$email'");

        }

        //========================= Redirecting to Index Page and exit ========================= 
        header("Location: index.php");
        exit();
    } else {
        array_push($error_array, "Email or Password Incorrect.<br />");
    }
}
