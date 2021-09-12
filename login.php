<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="login-box">
    <h1>Log in</h1>
    <form action="" method="post">

        <div class="textbox">
            <i class="fa fa-user-circle" aria-hidden="true"></i>
            <input id="user_name" name="user_name" type="text" placeholder="User name">
        </div>

        <div class="textbox">
            <i class="fa fa-key" aria-hidden="true"></i>
            <input id="password" name="password" type="password" placeholder="Password">
        </div>

        <input type="submit" name="login" class="btn" value="Log in">
        <input type="reset" class="btn" value="Reset">
        <div id="auth" style="display: none">

            <div style="display: none" id="fingerprint_container">
                <div class="radio containerR">
                    <input type="radio" value="Fingerprint" name='auth_type' id='Fingerprint'/>
                    <label for="Fingerprint"></label>
                </div>
                <div class="right">Fingerprint</div>
            </div>

            <div style="display: none" id="otp_container">
                <div class="radio containerR">
                    <input type="radio" value="otp" name='auth_type' id='otp'/>
                    <label for="otp"></label>
                </div>
                <div class="right">OTP</div>
            </div>
            <div class="textbox" style="display: none" id="two_fa_response_div">
                <i class="fa fa-user-circle" aria-hidden="true"></i>
                <input id="two_fa_response" name="two_fa_response" type="text" placeholder="Enter FA Res">
            </div>
            <input type="submit" name="auth" class="btn" value="Authenticate">
        </div>
    </form>
    <script>
        function show_auth() {
            document.getElementById("auth").style = "display: block";
        }

        function show_otp() {
            document.getElementById("otp_container").style = "display: block";
            document.getElementById("two_fa_response_div").style = "display: block";
        }

        function show_fingerprint() {
            document.getElementById("fingerprint_container").style = "display: block";
            document.getElementById("two_fa_response_div").style = "display: block";
        }
    </script>
    <?php
    $conn = null;
    if (isset($_POST['auth']) || isset($_POST['login'])) {
        require 'connection.php';
        $conn = connectToSQL();
    }
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

    if (isset($_POST['auth'])) {
        $user_name = $_POST['user_name'];
        $two_fa_method = $_POST['auth_type'];
        $two_fa = $_POST['two_fa_response'];

        $field = "";
        if ($two_fa_method == "otp") {
            $field = "otp_key";
        } else {
            $field = "fingerprint_hash";
        }

        $sql = "select * from `users` where `user_name` = '$user_name' and `$field`='$two_fa'";
        $query = mysqli_query($conn, $sql);
        $row = $query->fetch_assoc();
        if (mysqli_num_rows($query) > 0) {
            echo("<script type='application/javascript'> window.alert('Login Success'); window.location.href = 'login.php'; </script>");
        } else {
            echo("<script type='application/javascript'> window.alert('Invalid Credentials'); window.location.href = 'login.php'; </script>");
        }
        mysqli_close($conn);
        unset($_POST['login']);
    }
    ?>
</div>
</body>
</html>
