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

    if(isset($_POST['user_del'])){
      $sql = "delete from  detection  WHERE customer_id =:id";
      $stmt_dt = $conn->prepare($sql);
      $params_dt =  array(
            "id"=>$id
      );
  $stmt_dt->execute($params_dt);
  
      $sql = "delete from  customers  WHERE customer_id =:id";
      $stmt_up = $conn->prepare($sql);
      $params_up =  array(
            "id"=>$id
      );
  $stmt_up->execute($params_up);
  if($stmt_up->rowCount() > 0){
    session_destroy();
    echo "<script>alert('user delete successfully')</script>";
?>
<script>
  var url = window.location.toString();
  var hostname =  window.location.hostname.toString();
  var pathname =  window.location.pathname.toString();
   var pathname = hostname + pathname;
  location.href = url.replace(pathname, hostname +'/fyp_project/index.php');
//  location.href = url.replace('Starter/logout.php','login.php');

</script>
   <?php  }
  }
   
   ?>

    <div class="content ">
    <div class=" mt-5 alert alert-warning alert-dismissible fade show " id="alert_warning" role="alert">
  <strong>If you delete your Account then all the stats and their relevent data deleted permanently</strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>      
 <div class="card my-5 shadow-lg"  >
 

 <div class="card-header text-center font-weight-bolder ">
   Delete user
 </div>
  <div class="card-body">
  <form action="" method="post">
  <div class="form-group">
    <label for="exampleFormControlInput1">User Name</label>
    <input type="text" name="username" class="form-control" value="<?php if($result['username']){ echo $result['username'];}   ?>" disabled id="exampleFormControlInput1" >
  </div>

  <div class="form-group">
    <label for="exampleFormControlInput1">Email</label>
    <input type="text" name="email" class="form-control" value="<?php if($result['Email']){ echo $result['Email'];} ?>" disabled id="exampleFormControlInput1" >
  </div>

  <div class="form-group">
    <label for="exampleFormControlInput1">Password</label>
    <input type="password" name="password" class="form-control" value="<?php if($result['password']){ echo $result['password'];} ?>" disabled id="exampleFormControlInput1" >
  </div>

  <!-- <div class="form-group">
  <div class="custom-file">
    <input type="file" class="custom-file-input" id="customFile">
    <label class="custom-file-label" for="customFile">Choose file</label>
  </div>
  </div>
  <div class="form-group">
    <img src="images/justin.jpg" style="width:100px; heigth:100px;" alt="justin pic"/>
  </div> -->

  <div class="form-group">
    <button type="submit" name="user_del" class="btn btn-primary btn-block">Delete  user</button>
  </div>
</form>
   </div>
   </div>   
   </div>
 


   <?php 
   include "Components/lastEnd.php"; 
   ?>