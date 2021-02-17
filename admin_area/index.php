
  <?php
     include "Components/dbConnection.php";
     include "Components/function.php";
   include "Components/header.php";
  include "Components/Sidebar.php";
 $email_session = $_SESSION['admin_email'];
 
 ?>

    <div class="content">
    <?php
      $customer_sql =  "select * from admin_area where email=:email_session";
      $stmt =   $conn->prepare($customer_sql);
      $params =  array(
        "email_session"=>$email_session
    );
    
    $stmt->execute($params);
  
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    


  
    
  
    ?>
    
        <div class="container">
            <div class="row">
            <div class=" col-md-6 mb-4">
              <div class="card border-left-primary shadow py-2 h-100">
                <div class="card-body">
                 <div class="row no-gutters align-items-center ">
                  <div class="col mr-2">
                   <div class="font-weight-bold text-primary text-xs text-uppercase mb-1">Register User </div>
                   <?php 
  
  
  $remain_sql =  "select count(id) as id from short_urls ";
  $stmt =   $conn->prepare($remain_sql);
$stmt->execute();
$result_count = $stmt->fetch(PDO::FETCH_ASSOC);

if($stmt->rowCount() > 0){

            ?>
                   <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $result_count['id'] ?></div>
<?php } else {?>
  <div class="h5 mb-0 font-weight-bold text-gray-800 pt-4">No User Register</div>
  <?php } ?>
                  </div>
                  <div class="col-auto">
                 
                    <i class="fas fa-user fa-2x text-gray-300 text-primary"></i>
                  </div>
                  <div class="col-12 mt-2">
                  <a href='Viewuser.php' class='btn btn-primary btn-block'>view Details</a>
                 
                 </div>
                 </div><!--row end-->
                </div><!--card-body-->
              </div><!--card end-->

             </div>

             <div class=" col-md-6 mb-4">
              <div class="card border-left-primary shadow py-2 h-100">
                <div class="card-body">
                 <div class="row no-gutters align-items-center ">
                  <div class="col mr-2">
                   <div class="font-weight-bold text-primary text-xs text-uppercase mb-1">New Query </div>
                   <?php 
  
  
  $remain_sql =  "select count(id) as id from query_report where status=:status";
  $stmt =   $conn->prepare($remain_sql);
  $params =  array(
    "status"=>1
);
$stmt->execute($params);
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if($stmt->rowCount() > 0){

            ?>
                 
                   <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $result['id']; ?></div>
                  </div>
                  <?php } else {?>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $result['id']; ?></div>
                  </div>
                  <?php }?>
                  <div class="col-auto">
                 
                    <i class="fas fa-stopwatch-20 fa-2x text-gray-300 text-primary"></i>
                  </div>
                 <div class="col-12 mt-2">
                  <a href='Viewquery.php' class='btn btn-primary btn-block'>view Details</a>
                 
                 </div>
                 </div><!--row end-->
                </div><!--card-body-->
              </div><!--card end-->

             </div>

      

  
 <!-- expire link table end -->

            </div>
        
  

         

            
        </div>
  
    </div>

   <?php 
    include "Components/lastEnd.php"; 
 
    ?>
