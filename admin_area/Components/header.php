<?php

 session_start();
if(!isset($_SESSION['admin_email'])){
  echo "<script>location.href='login.php');</script>";
 }
 else{
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title> Shorturl</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="Css/bootstrap.min.css">

  <link rel="stylesheet" href="Css/all.min.css">
  <!-- Material Design Bootstrap -->
  <link rel="stylesheet" href="Css/mdb.css">
  <!-- Your custom styles (optional) -->
  <link rel="stylesheet" href="Css/style.css">
  </head>
  <body>

    <input type="checkbox" id="check">
    <!--header area start-->
    <header>
      <label for="check">
        <i class="fas fa-bars" id="sidebar_btn"></i>
      </label>
      <div class="left_area">
      <a href="index.php">  <h3>short <span>Url</span></h3></a>
      </div>
     
    </header>
 <?php } ?>