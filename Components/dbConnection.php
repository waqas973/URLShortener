<?php 

  try{
    $conn  = new PDO("mysql:host=localhost; dbname=fyp_shortener;" , "root","");
  }

catch(PDOException $e){
    echo $e->getMessage();
}


?>