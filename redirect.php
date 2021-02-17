<?php
  include 'Components/dbConnection.php';
  include 'ShortenerClass.php';

      
  $short = new shotener($conn);

  $shortCode = $_GET['c'];

  // echo $shortCode;

  try{
    $url =  $short->shortCodeToUrl($shortCode);
   header("Location: ".$url);

    exit;
  }
  catch(Exception $e){
      echo $e->getMessage();
  }

?>