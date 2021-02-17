<?php 
session_start();
function getcustval(){
   $id= $_SESSION['customer_id'];
   return $id;
}
?>