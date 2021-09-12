<script type="text/javascript">
  function randomStr() {
    var len = 10;
    return Math.random().toString(36).replace(/[^a-z]+/g, '').substr(0, len);
  };

  function randomPhone() {
    var len = 10;
    return "9" + Math.floor(Math.random() * 1000000000);
  };

  function capitalizeFirst(str){
    var first = str.charAt(0).toUpperCase();
    return first + str;
  };
</script>