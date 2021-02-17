<?php
 include "Components/dbConnection.php";
 include "Components/function.php";
 include "Components/header.php"; 
 include "Components/Sidebar.php"; 
 $email_err="";
      $id  =     get_id();
 $customer_sql =  "select * from admin_area where id=:id";
      $stmt =   $conn->prepare($customer_sql);
      $params =  array(
        "id"=>$id
    );
    
    $stmt->execute($params);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
  
  
   if(isset($_POST['user_update'])){

 
    $username =  $_POST['username'];
    $email =  $_POST['email'];
    $pass =  $_POST['password'];

    $customer_sql_check =  "select * from admin_area where email=:email AND id!=:id";
      $stmt_check =   $conn->prepare($customer_sql_check);
      $params =  array(
        "email"=>$email,
        "id"=>$id
    );
    
    $stmt_check->execute($params);

    if($stmt_check->rowCount() > 0){
      $email_err = "This Email is already taken";
    }
    else{
      $sql = "UPDATE admin_area SET username=:username , email=:email , password=:password  WHERE id =:id" ;
      $stmt_up = $conn->prepare($sql);
  
      $params_up =  array(
        "username"=>$username,
            "email"=>$email,
            "password"=>$pass,
            "id"=>"$id"
      );
  $stmt_up->execute($params_up);
  if($stmt_up->rowCount() > 0){
    echo "<script>alert('user updated successfully')</script>";
  
   $_SESSION['email']=$email;
   echo "<script>location.href='index.php'</script>";
  }
    }
    
   }
   $email_session = $_SESSION['admin_email'];

      $customer_sql =  "select * from admin_area where email=:email_session";
      $stmt =   $conn->prepare($customer_sql);
      $params =  array(
        "email_session"=>$email_session
    );
    
    $stmt->execute($params);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
  ?>

    <div class="content ">
           
 <div class="card my-5 shadow-lg"  >
 <div class="card-header text-center font-weight-bolder ">
    Update User
 </div>
  <div class="card-body">
  <form action="" method="post">
  <div class="form-group">
    <label for="exampleFormControlInput1">User Name</label>
    <input type="text" name="username" class="form-control" value="<?php if($result['username']){ echo $result['username'];} ?>" id="exampleFormControlInput1" >
  </div>

  <div class="form-group">
    <label for="exampleFormControlInput1">Email</label>
    <input type="text" name="email" class="form-control" value="<?php if($result['email']){ echo $result['email'];} ?>" id="exampleFormControlInput1" >
  </div>
  <span class="text-danger"><?php echo $email_err; ?></span>

  <div class="form-group">
    <label for="exampleFormControlInput1">Password</label>
    <input type="text" name="password" class="form-control" value="<?php if($result['password']){ echo $result['password'];} ?>" id="exampleFormControlInput1" >
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
    <button type="submit" name="user_update" class="btn btn-primary btn-block">Update user</button>
  </div>
</form>
   </div>
   </div> 

 
 
   </div>
 
   
   <?php include "Components/lastEnd.php"; ?>