<?php 
    include "Components/dbConnection.php";


    $data = stripslashes(file_get_contents("php://input"));
    $mydata = json_decode($data , true);
         
    $id = $mydata['id'];

   $query = "UPDATE short_urls SET hide_pass=:hide_pass,status=:status  WHERE id =:id";
   $stmt = $conn->prepare($query);
   $params = array(
       "hide_pass" =>"N/A",
       "status" => 0,
       "id" => $id
   );
   $stmt->execute($params);
   if($stmt->rowCount() > 0 ){
       echo "password unset successfully";
   }
     
   ?>