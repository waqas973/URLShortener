<?php
session_start();
include 'Components/dbConnection.php';
if(isset($_GET['token'])){
    $token = $_GET['token'];
    $query = "UPDATE customers SET status=:status WHERE token=:token";
    $stmt = $conn->prepare($query);
    $params = array(
        "status" => "active",
        "token" => $token
    );
    $stmt->execute($params);
    if($stmt->rowCount() > 0){
            $_SESSION['msg'] = "Account activate successfully";
            header("location:login.php");
   
    }else{
        $_SESSION['msg'] = "Account not activate try again later ";   
        header("location:freesignup.php"); 
    }
}



?>