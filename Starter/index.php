
  <?php
    include "Components/dbConnection.php";
    include "ShortenerClass.php";
    include "Components/function.php";
 
  include "Components/header.php";
 include "Components/Sidebar.php";
 
 $email_session = $_SESSION['email'];
 
 ?>

    <div class="content">
    <?php
      $customer_sql =  "select * from customers where Email=:email_session";
      $stmt =   $conn->prepare($customer_sql);
      $params =  array(
        "email_session"=>$email_session
    );
    
    $stmt->execute($params);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
  $start_date = strtotime(date('y-m-d'));

$end_date = strtotime($result['end_date']);

   $diff = $end_date - $start_date;
  $diff = round($diff/ 86400);

  $remain_sql =  "select * from short_urls where customer_id=:customer_id";
  $stmt =   $conn->prepare($remain_sql);
  $params =  array(
    "customer_id"=>$result['customer_id']
);

$stmt->execute($params);



if($stmt->rowCount() > 0){
  $a =0;
  while($rsesult_remain = $stmt->fetch(PDO::FETCH_ASSOC)){
    $a =$a + 1;
$_SESSION['remain_url'] =$a;
  }
  
}else{
  $_SESSION['remain_url'] =0;
}



  if( $diff > 0){

  
    ?>
    
        <div class="container">
            <div class="row">
            <div class=" col-md-6 mb-4">
              <div class="card border-left-primary shadow py-2 h-100">
                <div class="card-body">
                 <div class="row no-gutters align-items-center ">
                  <div class="col mr-2">
                   <div class="font-weight-bold text-primary text-xs text-uppercase mb-1">Total Clicks</div>
                   <?php 
  
  $sql = "select  sum(hits) as visit from short_urls where customer_id=:customer_id  ";
  $stm = $conn->prepare($sql);
  $par = array(
    "customer_id"=>$result['customer_id']
) ;
$stm->execute($par);
$result_total = $stm->fetch(PDO::FETCH_ASSOC);
if($result_total['visit']> 0){
  
  // $result_total= $result_total['visit'];
  // echo "<script>alert($result_total)</script>";
            ?>
                   <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $result_total['visit'] ?></div>
<?php } else {?>
  <div class="h5 mb-0 font-weight-bold text-gray-800 pt-4">No clicks found</div>
  <?php } ?>
                  </div>
                  <div class="col-auto">
                 
                    <i class="fas fa-mouse fa-2x text-gray-300 text-primary"></i>
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
                   <div class="font-weight-bold text-primary  text-uppercase mb-1">Enterprise plan</div>
                   <div class=" mb-1 text-xs  text-gray-800">
               <button  class="btn btn-danger rounded-pill btn-sm" data-toggle="modal" data-target="#myModal">Cancel Plan </button> 

                  </div>

                <div class=" mb-0 text-xs  text-gray-800">
                   <a class="" href="RenewPlan.php">  <button class="btn btn-danger rounded-pill btn-sm">ReNew Plan </button>    </a>

                </div>
                 
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
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
                   <div class="font-weight-bold text-primary text-xs text-uppercase mb-1">Remaining url to be created </div>
                   <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo 15 - $_SESSION['remain_url']; ?></div>
                  </div>
                  <div class="col-auto">
                 
                    <i class="fas fa-mouse fa-2x text-gray-300 text-primary"></i>
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
                   <div class="font-weight-bold text-primary text-xs text-uppercase mb-1">Plan Expire after  </div>
                   <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $diff ." days"; ?></div>
                  </div>
                  <div class="col-auto">
                 
                    <i class="fas fa-stopwatch fa-2x text-gray-300 text-primary"></i>
                  </div>

                 </div><!--row end-->
                </div><!--card-body-->
              </div><!--card end-->

             </div>

             <!-- expire link table -->
             <?php
                 $sql = "select * from short_urls where customer_id = :customer_id and expiry_status=:expiry_status";
                 $stmt_expire =   $conn->prepare( $sql);
        
                 $para =  array(
                   "customer_id"=>$result['customer_id'] ,
                   "expiry_status"=>1    
                 );
          
                 $stmt_expire->execute($para);

                 if($stmt_expire->rowCount() > 0){
    
             ?>

             <div class=" col-12 mb-4">
              <div class="card border-left-primary shadow py-2 h-100">
                <div class="card-body">
                <h4 class='text-center'>Expired Link </h4>
                  <div class='table-responsive'>
                  <table class="table table-hover table-sm  table-bordered">
    <thead class="text-center">
    <?php 
         $shortURL_Prefix = 'http://localhost/fyp_project/Starter/';
    ?>
      <tr >
        <th>Sid</th>
        <th>short url</th>
     
      </tr>
    </thead>
    <tbody  >

    <?php 
       while($result_expire = $stmt_expire->fetch(PDO::FETCH_ASSOC)){
    ?>
      <tr class='text-center'>
        <td ><?php echo $result_expire['id']; ?></td>
        <td><?php echo $shortURL_Prefix.$result_expire['short_url']; ?></td>
        <td>
     
         </td>

      </tr>
      <?php  } ?>
     
   
     
    </tbody>
  </table>
                  </div>
                </div><!--card-body-->
              </div><!--card end-->

             </div>
             <?php     }  ?>
 <!-- expire link table end -->

            </div>
      


            

          
        

            
        </div>
  
    </div>

<!-- Model -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Cancel Plan</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       If you Cancel Plan then You will be unregister automatically which means that u can't access your Account anymore 
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      <button type="button" onclick="Cancelfunc()" class="btn btn-primary" >ok</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

  
            <?php } else {?>
            <div class="container ">
            <div class=" col-md-9 mx-auto   mb-4">
              <div class="card border-left-primary shadow py-2 h-100">
                <div class="card-body">
                 <div class="card-title">
               Your Plan has been Expired Please Renew Your Plan
                 </div>
                 <a href="RenewPlan.php"><button class="btn btn-danger btn-block">Renew Plan</button></a>
                </div><!--card-body-->
              </div><!--card end-->

             </div>
            </div>
              <?php } ?>

<script>


 function  Cancelfunc(){
  var model = document.getElementById('myModal');
              model.style.visibility = "hidden";
     var CancelPlan = confirm('Do you really want to cancel Plan');
     if(CancelPlan == true){
      location.href = "CancelPlan.php";

       }
       else{
        setTimeout(function(){
           location.reload();
      }, 500);
       } 
   
 
     }
  
    
    </script>
   <?php 
    include "Components/lastEnd.php"; 
    include "custom.php";
    ?>
 