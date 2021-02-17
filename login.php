<?php
   
   session_start();
 
   $msg = "";
    include 'Components/dbConnection.php';
   if(isset($_POST['login'])){
    $email =  $_POST['email'];
    $pass =  $_POST['pass'];
  
    $sql = "select * from customers where Email=:email AND password=:pass AND status=:status" ;
    $stmt =   $conn->prepare($sql);

    $params =  array(
          "email"=>$email,
          "pass"=>$pass,
          "status"=>"active"

    );

$stmt->execute($params);
$result = $stmt->fetch(PDO::FETCH_ASSOC);

$id = $result['customer_id'];
$package_type = $result['package_type'];

if($stmt->rowCount() > 0){
  
  $_SESSION['email'] = $email;
  $_SESSION['pass'] = $pass;
  $_SESSION['username'] =  $result['username'];
  $_SESSION['customer_id'] =  $result['customer_id'];

  if($package_type == 'Free'){
    echo "<script>alert('Logged in. Welcome Back')</script>";
     
    
    echo "<script>location.href = 'Starter/index.php?id='+$id</script>"; 
  }
  else if($package_type == 'Business'){
    if($result['transaction_status'] ==1){
      echo "<script>alert('Logged in. Welcome Back')</script>";          
      echo "<script>location.href = 'Business/index.php?id='+$id</script>"; 
    }
    else{
      $msg = "Please pay your amount to active your account";
    }
   
  }
  else if($package_type == 'Enterprise'){
    if($result['transaction_status'] ==1){
    echo "<script>alert('Logged in. Welcome Back')</script>";
    echo "<script>location.href = 'Enterprise/index.php?id='+$id</script>"; 
  }
  else{
    $msg = "Please pay your amount to active your account";
  }
  
  }
  
}
else{
  $msg = "Email and password was incorrect";
}
   }


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title> login </title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="Css/bootstrap.min.css">

  <link rel="stylesheet" href="Css/all.min.css">
  <!-- Material Design Bootstrap -->
  <link rel="stylesheet" href="Css/mdb.css">

  <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    
  <!-- Your custom styles (optional) -->
  <link rel="stylesheet" type="text/css" href="Css/util.css">
  <link rel="stylesheet" href="Css/main.css">


 
</head>
<body >


<div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
			<div class="wrap-login100 p-t-30 p-b-50">
				<span class="login100-form-title p-b-41">
					 Login
				</span>
     
      
				<form method="post" class="login100-form validate-form p-b-33 p-t-5">
        <?php
         if(isset($_SESSION['msg'])){
        ?>
        <p class="bg-danger text-white px-3"><?php echo $_SESSION['msg']; 
          $_SESSION['msg'] = "";
        ?></p>
        <?php
         }else{
          $_SESSION['msg'] = "";  
         }  ?>
					<div class="wrap-input100 validate-input" data-validate = "Enter Email">
						<input class="input100" type="text" name="email" placeholder="User Email">
						<span class="focus-input100" data-placeholder="&#xe82a;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xe80f;"></span>
					</div>
          <span class="bg-danger text-white " ><?php echo $msg; ?></span>
					<div class="container-login100-form-btn m-t-32">
						<button type="submit" name="login" class="login100-form-btn">
							Login
						</button>
                    </div>
                    
                     
                    <div  class="container-login100-form-btn m-t-32">
                    <a href="signup.php" class="text-primary"> forget Password</a>
                </div>

                    <div  class="container-login100-form-btn m-t-32">
                    <span class="text-dark">Already have a Account  <a href="signup.php" class="text-primary"> Sign Up</a></span>
                </div>

                </form>
                
            </div>
            
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>

<?php  include "Components/lastEnd.php"; ?>


 

</body>
</html>
