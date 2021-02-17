<?php
session_start();

$email_err = "";
$pass_err = "";
$remain_url = 15;
  include "Components/dbConnection.php";

  if(isset($_POST['FreeSignup'])){
	$username =  $_POST['username'];
	$email =  $_POST['email'];
	$password =  $_POST['password'];
	$confirm_password =  $_POST['confirm_password'];
	$package_type =  $_POST['package_type'];
	$start_date = date('Y/m/d');
	$time = strtotime($start_date);
	$token =bin2hex(random_bytes(15));

$end_date = date("Y-m-d", strtotime("+1 month", $time));

$time1 = strtotime($end_date);

   $diff = $time1 - $time;
  $diff = round($diff/ 86400);

  $cus_email_sql =  "select * from customers where Email =:Email ";
	$stmt_cus_email =   $conn->prepare($cus_email_sql);

	$params_email =  array(
		  "Email"=>$email
	);

	$stmt_cus_email->execute($params_email);
	if($stmt_cus_email->rowCount() > 0){
      $email_err = "sorry this email is already exist try other one";
	}
	else{
		if($password  === $confirm_password){
			$sql =  "insert into customers(username, Email,password,package_type,method_type,start_date,end_date,total_price,remaining_url,token,status,transaction_id,transaction_status) values(:username, :Email,:password,:package_type,:method_type,:start_date,:end_date,:total_price,:remaining_url,:token,:status,:transaction_id,:transaction_status)";

			$stmt =   $conn->prepare($sql);
	
			$params =  array(
				  "username"=>$username,
				  "Email"=>$email,
				  "password"=>$password,
				  "package_type"=>$package_type,
				  "method_type"=>'N/A',
				  "start_date"=>$start_date,
				  "end_date"=>$end_date,
				  "total_price"=>0,
				  "remaining_url"=>$remain_url,
				  "token"=>$token,
				  "status"=>"inactive",
				  "transaction_id"=>"N/A",
				  "transaction_status"=>0,
			);
	
			$stmt->execute($params);
			if($stmt->rowCount() > 0){
				$subject = "Email Activation";
				$body = "Hi, $username. click here too activate your account http://localhost/fyp_project/activate.php?token=$token";
				$headers = "From: waqascomsts786@gmail.com";
				
				if (mail($email, $subject, $body, $headers)) {
				$_SESSION['msg']= "check your mail to activate your account $email";
				header("location:login.php");
				 }
				 else {
					echo "Email sending failed...";
				}
	 
			}
		}
		else{
      $pass_err = "Password not match";

		}
	

	}
  
	 
	
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title> Free Signup </title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="Css/bootstrap.min.css">

  <link rel="stylesheet" href="Css/all.min.css">
  <!-- Material Design Bootstrap -->
  <link rel="stylesheet" href="Css/mdb.css">

  <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    
  <!-- Your custom styles (optional) -->

  <link rel="stylesheet" href="Css/signup.css">


 
</head>
<body >
<div class="signup-form">
    <form  method="post">
		<h2>Sign Up</h2>
		<p>Please fill in this form to create an account!</p>
		<hr>
        <div class="form-group">
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text">
						<span class="fa fa-user"></span>
					</span>                    
				</div>
				<input type="text" class="form-control" name="username" placeholder="Username" required="required">
			</div>
        </div>
        <div class="form-group">
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fa fa-paper-plane"></i>
					</span>                    
				</div>
				<input type="email" class="form-control" name="email" placeholder="Email Address" required="required">
				<span class='text-danger'><?php echo  $email_err; ?></span>
			</div>
        </div>
		<div class="form-group">
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fa fa-lock"></i>
					</span>                    
				</div>
				<input type="text" class="form-control" name="password" placeholder="Password" required="required">
			</div>
        </div>
		<div class="form-group">
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fa fa-lock"></i>
						<i class="fa fa-check"></i>
					</span>                    
				</div>
				<input type="text" class="form-control" name="confirm_password" placeholder="Confirm Password" required="required">
			
			</div>
			<span class='text-danger'><?php echo  $pass_err; ?></span>
        </div>

		<div class="form-group">
		<label for="Pa" class="text-dark">Package Type</label>
			<select class="custom-select" name="package_type" >
			 <option value="Free"  selected>Free</option>
			</select>
        </div>

		<div class="form-group" id="total_price">
		       <h4>Total Price 0</h4>
        </div>
       
		<div class="form-group">
            <button type="submit" name="FreeSignup"  class="btn btn-primary btn-lg">Sign Up</button>
        </div>
    </form>
	<div class="text-center">Already have an account? <a href="login.php">Login here</a></div>
</div>

<?php include "Components/lastEnd.php"; ?>


 

</body>
</html>
