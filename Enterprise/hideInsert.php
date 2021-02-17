<?php 
    include "Components/dbConnection.php";


    $data = stripslashes(file_get_contents("php://input"));
    $mydata = json_decode($data , true);
         
    $id = $mydata['id'];
   $pass =  $mydata['pass'];


   $query = "select * from short_urls  where  hide_pass =:hide_pass";
   $stmt = $conn->prepare($query);
   $params = array(
       "hide_pass" => $pass,
     
   );
   $stmt->execute($params);
   if($stmt->rowCount() > 0 ){
       echo "password is already exist try another pne";
   }
   else{

    $query = "UPDATE short_urls SET hide_pass=:hide_pass,status=:status  WHERE id =:id";
    $stmt = $conn->prepare($query);
    $params = array(
        "hide_pass" => $pass,
        "status" => 1,
        "id" => $id
    );
    $stmt->execute($params);
    if($stmt->rowCount() > 0 ){
        echo "password set successfully";
    }
   }


     
   ?>