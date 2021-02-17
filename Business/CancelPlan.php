 <?php 
session_start();
 include "Components/dbConnection.php";
include "Components/function.php";
 
         $cus_id  = get_id();
         $sql = "delete from  detection  WHERE customer_id =:id";
         $stmt_dt = $conn->prepare($sql);
         $params_dt =  array(
               "id"=>$cus_id
         );
     $stmt_dt->execute($params_dt);
      $sql = "delete from  customers  WHERE customer_id =:id";
      $stmt_up = $conn->prepare($sql);
      $params_up =  array(
            "id"=>$cus_id
      );
  $stmt_up->execute($params_up);
  if($stmt_up->rowCount() > 0){
    session_destroy(); 
         ?>

    <script>
alert('user delete successfully'); 
         var url = window.location.toString();
   var hostname =  window.location.hostname.toString();
   var pathname =  window.location.pathname.toString();
   var idvalue = window.location.search.toString();
   var pathname = hostname + pathname;

    location.href = url.replace(pathname, hostname +'/fyp_project/index.php');

   </script>  
   <?php } ?>