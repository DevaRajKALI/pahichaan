<?php
//========================= Declaring Variables =========================
$fname = "";
$lname = "";
$email = "";
$email2 = "";
$password = "";
$password = "";
$date = "";
// Array for storing error messages.
$error_array = array();

//========================= If register button was pressed =========================
if (isset($_POST["register_button"])) {

    //========================= Registration Form Values =========================

    function standarize_input($input, $choice)
    {
        // Strip HTML and PHP Tags from text.
        $input = strip_tags($input);
        if ($choice == 1) {
            return $input;
        }

        // Strip Spaces
        $input = str_replace(" ", "", $input);
        if ($choice == 2) {
            return $input;
        }

        // Lowercase Conversion
        $input = strtolower($input);
        if ($choice == 3) {
            return $input;
        }

        // Uppercase First
        $input = ucfirst($input);
        if ($choice == 0) {
            return $input;
        }
    }


    $fname = standarize_input($_POST["reg_fname"], 0);
    $_SESSION['reg_fname'] = $fname;

    $lname = standarize_input($_POST["reg_lname"], 0);
    $_SESSION['reg_lname'] = $lname;

    $email = standarize_input($_POST["reg_email"], 3);
    $_SESSION['reg_email'] = $email;

    $email2 = standarize_input($_POST["reg_email2"], 3);
    $_SESSION['reg_email2'] = $email2;

    // Passwords aren't stored in Session Variables.
    $password = standarize_input($_POST["reg_password"], 1);
    $password2 = standarize_input($_POST["reg_password2"], 1);

    //========================= Current Date =========================
    $date = date("Y-m-d");

    //========================= Check if Email Matches =========================

    if ($email == $email2) {
        //========================= Check if Email is in Valid Format =========================

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);

            //========================= Check if Email already Exists =========================

            $sql_query = "SELECT email FROM users WHERE email='$email'";
            $email_check = mysqli_query($con, $sql_query);

            //========================= Count no. of rows returned =========================

            $num_rows = mysqli_num_rows($email_check);
            if ($num_rows > 0) {
                array_push($error_array, "Email already in use.</br>");
            }
        } else {
            array_push($error_array, "Invalid Email Format.</br>");
        }
    } else {
        array_push($error_array, "Email don't match.</br>");
    }

    //========================= Name Validation =========================

    if (strlen($fname) > 25 || strlen($fname) < 2) {
        array_push($error_array, "Your first name must be between 2 and 25 characters.</br>");
    }

    if (strlen($lname) > 25 || strlen($lname) < 2) {
        array_push($error_array, "Your last name must be between 2 and 25 characters.</br>");
    }

    //========================= Password Validation =========================

    if ($password != $password2) {
        array_push($error_array, "Your passwords don't match.</br>");
    } else {
        //========================= REGEX Validation =========================

        if (preg_match('/[^a-zA-Z0-9]/', $password)) {
            array_push($error_array, "Your password can only contain alphabets and numbers.</br>");
        }

        //========================= Length Validation =========================

        if (strlen($password) > 30 || strlen($password) < 5) {
            array_push($error_array, "Your password must be between 5 and 30 characters.</br>");
        }
    }

    //========================= If No Error Message is Pushed =========================
    if (empty($error_array)) {

        // Encrypt Password before sending to Database.
        $password = md5($password);

        // Generate Username by concatenating username and password.
        $unique_username = strtolower($fname) . "_" . strtolower($lname);
        // $username_check_query = "SELECT user_name from users WHERE user_name='$unique_username'";
        // $username_check = mysqli_query($con, $username_check_query);
        // $count = 0;
        // while (mysqli_num_rows($username_check) > 0) {
        //     $unique_username  =  strtolower($fname) . " _" .  strtolower($lname) . "_" . $count;
        //     $username_check_query = "SELECT user_name from users WHERE user_name='$unique_username'";
        //     $username_check = mysqli_query($con, $username_check_query);
        //     $count++;
        // }

        //========================= Random Profile Picture =========================

        $profile_pic_location = "C:/Users/arjun/Desktop/workspace/web-snippets/register/assets";
        $rand_value = rand(1, 2);
        $profile_pic = $profile_pic_location . "random_user_" . $rand_value . ".png";

        //========================= Pushing to Database =========================

        $push_sql_statement = "INSERT INTO users VALUES('', '$fname', '$lname', '$unique_username', '$email', '$password', '$date', '$profile_pic', '0', 'no', ',')";
        $query = mysqli_query($con, $push_sql_statement);

        if ($query) {
            array_push($error_array, "Successfully registered.</br> Please login to continue.</br>");
        }
    }
}
