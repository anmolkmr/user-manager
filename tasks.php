<?php
require 'connection.php';
require 'utils.php';
function login_task()
{
    $conn = connectToSQL();
    if (isset($_POST['login'])) {

        $user_name = $_POST['user_name'];
        $password = $_POST['password'];

        $sql = "select * from `users` where `user_name` = '$user_name' and `password`='$password'";
        $query = mysqli_query($conn, $sql);
        $row = $query->fetch_assoc();
        if (mysqli_num_rows($query) > 0) {
            if ($row["fingerprint_hash"] == null && $row["otp_key"] == null) {
                echo("<script type='application/javascript'> window.alert('Login Success'); window.location.href = 'login.php'; </script>");
            } else {
                echo("<script type='application/javascript'> show_auth() </script>");
                if ($row["otp_key"] != null) {
                    echo("<script type='application/javascript'> show_otp() </script>");
                }
                if ($row["fingerprint_hash"] != null) {
                    echo("<script type='application/javascript'> show_fingerprint() </script>");
                }
            }
        } else {
            echo("<script type='application/javascript'> window.alert('Invalid Credentials'); window.location.href = 'login.php'; </script>");
        }
        mysqli_close($conn);
        unset($_POST['login']);
    }
}

function auth_task()
{
    $conn = connectToSQL();
    if (isset($_POST['auth'])) {
        /*$user_name = $_POST['user_name'];
        $two_fa_method = $_POST['auth_type'];
        $two_fa = $_POST['two_fa_response'];*/

        $user_name = "zpafgksw";
        $two_fa_method = "fingerprint";
        $two_fa = "";

        $field = "";
        if ($two_fa_method == "otp") {
            $field = "otp_key";
        } else {
            $field = "fingerprint_hash";
        }
        $sql = "select * from `users` where `user_name` = '$user_name'";
        $query = mysqli_query($conn, $sql);
        $row = $query->fetch_assoc();
        if (mysqli_num_rows($query) > 0) {
            $isMatched = false;
            if ($two_fa_method == "fingerprint") {
                $saved_fp_hash = $row["fingerprint_hash"];
                $isMatched = matchFingerPrint($saved_fp_hash);
            } else {
                $isMatched = $two_fa == $row["otp_key"];
            }
            if ($isMatched) {
                echo("<script type='application/javascript'> window.alert('Login Success'); window.location.href = 'login.php'; </script>");
            } else {
                echo("<script type='application/javascript'> window.alert('2FA Failed'); window.location.href = 'login.php'; </script>");
            }
        } else {
            echo("<script type='application/javascript'> window.alert('Invalid Credentials'); window.location.href = 'login.php'; </script>");
        }
        mysqli_close($conn);
        unset($_POST['login']);
    }
}

?>