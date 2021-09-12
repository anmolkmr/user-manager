<script type="text/javascript">
    <script type="text/javascript" src="utils.js"/>
    function random() {
        document.getElementById("fname").value = capitalizeFirst(randomStr());
        document.getElementById("lname").value = capitalizeFirst(randomStr());
        document.getElementById("user_name").value = randomStr();
        document.getElementById("ph").value = randomPhone();
        document.getElementById("password").value = "1"
        document.getElementById("cpassword").value = "1";
    };

    var inTesting = true;
    if(inTesting){
      document.getElementById("test_user").value = 1;
      random();
    } else{
        document.getElementById("test_user").value = 0;
        document.getElementById("random").style.display="none";
    }
</script>