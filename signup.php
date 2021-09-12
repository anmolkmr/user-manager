<?php
$server_name = "localhost";
$username = "root";
$password = "";
$database_name = "user_manager";
$conn = mysqli_connect($server_name, $username, $password, $database_name);
if (!$conn) {
    die("connection Failed:" . mysqli_connect_error());
}
if (isset($_POST['register'])) {
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    $first_name = $_POST['fname'];
    $last_name = $_POST['lname'];
    $mobile = $_POST['ph'];
    $test_user = $_POST['test_user'];
    $is_otp_key_blank = false;
    $is_fingerprint_hash_blank = false;
    $otp_key = $_POST['otp_text'];
    if ($otp_key == "") {
        $is_otp_key_blank = true;
    }
    $fingerprint_hash = $_POST['fingerprint_text'];
    if ($fingerprint_hash == "") {
        $is_fingerprint_hash_blank = true;
    }
    $sql_query = "";
    if ($is_fingerprint_hash_blank && $is_otp_key_blank) {
        $sql_query = "INSERT INTO users(user_name,password,first_name,last_name,mobile,test_user)
	 VALUES('$user_name','$password','$first_name','$last_name','$mobile',$test_user)";
    } elseif ($is_fingerprint_hash_blank) {
        $sql_query = "INSERT INTO users(user_name,password,first_name,last_name,mobile,test_user,otp_key)
	 VALUES('$user_name','$password','$first_name','$last_name','$mobile',$test_user,'$otp_key')";
    } elseif ($is_otp_key_blank) {
        $sql_query = "INSERT INTO users(user_name,password,first_name,last_name,mobile,test_user,fingerprint_hash)
	 VALUES('$user_name','$password','$first_name','$last_name','$mobile',$test_user,'$fingerprint_hash')";
    } else {
        $sql_query = "INSERT INTO users(user_name,password,first_name,last_name,mobile,test_user,fingerprint_hash, otp_key)
	 VALUES('$user_name','$password','$first_name','$last_name','$mobile',$test_user,'$fingerprint_hash','$otp_key')";
    }
    if (mysqli_query($conn, $sql_query)) {
        require 'utils.php';
        $message = $user_name . 'registered successfully';
        $href = 'http://localhost/umgmt/signup.html';
        jsAlert($message, $href);
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}


