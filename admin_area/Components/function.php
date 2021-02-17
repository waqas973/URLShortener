<?php
  include "Components/dbConnection.php";
 function get_id(){
   
     $custom_id = $_SESSION['admin_id'];
     return $custom_id;
 }


?>