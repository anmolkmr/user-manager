<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <script type="text/javascript" src="jquery-1.8.2.js"></script>
    <script type="text/javascript" src="mfs100-9.0.2.6.js"></script>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="login-box">
    <h1>Log in</h1>
    <form action="" method="post" > <!--onsubmit="return false;"-->

        <div class="textbox">
            <i class="fa fa-user-circle" aria-hidden="true"></i>
            <input id="user_name" name="user_name" type="text" placeholder="User name" value="<?php if (isset($_POST['user_name'])) echo $_POST['user_name']; ?>">
        </div>

        <div class="textbox">
            <i class="fa fa-key" aria-hidden="true"></i>
            <input id="password" name="password" type="password" placeholder="Password" value="<?php if (isset($_POST['password'])) echo $_POST['password']; ?>" >
        </div>

        <input type="submit" name="login" class="btn" value="Log in"">
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
            console.log("otp");
            document.getElementById("otp_container").style = "display: block";
            document.getElementById("two_fa_response_div").style = "display: block";
        }

        function show_fingerprint() {
            console.log("fp");
            document.getElementById("fingerprint_container").style = "display: block";
            //const isoTemplate = CaptureFinger(60,20);
            //document.getElementById("two_fa_response").value=isoTemplate;
        }

        disable_login();
        function disable_login() {
            console.log("dis");
            document.getElementById("user_name").disabled = <?php if (isset($_POST['user_name'])) echo true; else echo false ?>;
            document.getElementById("password").disabled = <?php if (isset($_POST['user_name'])) echo true; else echo false ?>;
        }
    </script>
    <?php
        require 'tasks.php';
        auth_task();
        login_task();
    ?>
</div>
</body>
</html>
