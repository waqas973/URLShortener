<?php
 include "Components/dbConnection.php";
 include "Components/function.php";
 include "Components/header.php"; 
 include "Components/Sidebar.php"; 

      $id  =     get_id();
 $customer_sql =  "select * from customers where customer_id=:id";
      $stmt =   $conn->prepare($customer_sql);
      $params =  array(
        "id"=>$id
    );
    
    $stmt->execute($params);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
  
    $start_date = strtotime(date('y-m-d'));

    $end_date = strtotime($result['end_date']);
    
       $diff = $end_date - $start_date;
      $diff = round($diff/ 86400);
  
    //    echo "<script>alert( $diff)</script>";
  
   if(isset($_POST['user_update'])){

    $Selected_month =  $_POST['Selected_month'];


    $start_date = date('Y/m/d');

    $time = strtotime($start_date);
  $end_date = date("Y-m-d", strtotime("+$Selected_month month", $time));
  if($diff > 0){
    $end_date = date('Y-m-d', strtotime($end_date. " + $diff days")); 
  }
  else{
    $end_date = date('Y-m-d', strtotime($end_date. " + 0 days")); 
  }


     $sql = "UPDATE customers SET start_date=:start_date , end_date=:end_date where customer_id=:id";
       $stmt_check =   $conn->prepare($sql);
      $params =  array(
        "start_date"=>$start_date,
        "end_date"=>$end_date,
        "id"=>$id
    );
    
    $stmt_check->execute($params);

    if($stmt_check->rowCount() > 0){
          echo "<script>alert('Plan updated successfully')</script>";
          echo "<script>location.href='index.php'</script>";
    }
   
    
   }
     
  ?>

    <div class="content ">
    <div class=" mt-5 alert alert-warning alert-dismissible fade show " id="alert_warning" role="alert">
  <strong>If you Renew your Plan then the remaining days of your previous plan will be added to your new Plan too </strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>      
 <div class="card my-5 shadow-lg"  >
 <div class="card-header text-center font-weight-bolder ">
    Update Plan
 </div>
  <div class="card-body">
  <form action="" method="post">
  <div class="form-group" id="month">
		<label for='month' class='text-dark'>Select Month</label>
		<select class='custom-select' name='Selected_month' onchange='mon(event)' >
		<option value='1' >1</option>

		</select>
		</div>


  <div class="form-group">
    <button type="submit" name="user_update" class="btn btn-primary btn-block">Update Plan</button>
  </div>
</form>
   </div>
   </div>   
   </div>
 

   <?php include "Components/lastEnd.php"; ?>