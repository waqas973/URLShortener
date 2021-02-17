<?php 

    session_start();
    session_destroy();
    session_start();
  $_SESSION['msg']="";

?>

<script>
  var url = window.location.toString();
  var hostname =  window.location.hostname.toString();
  var pathname =  window.location.pathname.toString();
   var pathname = hostname + pathname;
  location.href = url.replace(pathname, hostname +'/fyp_project/index.php');
//  location.href = url.replace('Starter/logout.php','login.php');

</script>