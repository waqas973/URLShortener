<?php


include "Components/dbConnection.php";

$email_err = "";
$pass_err = "";
$cpass_err = "";
$name_err = "";

$email_st = 0;
$pass_st = 0;
$cpass_st = 0;
$name_st = 0;
$price = 0;
$total_pice = 0;
$remain_url = 0;
if(isset($_POST['Signup'])){
  $username =  $_POST['username'];
  $email =  $_POST['email'];
  $password =  $_POST['password'];
  $confirm_password =  $_POST['confirm_password'];
  $package_type =  $_POST['package_type'];
  $method_type =  $_POST['method_type'];
  $Selected_month =  $_POST['Selected_month'];

  $start_date = date('Y/m/d');

  $time = strtotime($start_date);
$end_date = date("Y-m-d", strtotime("+$Selected_month month", $time));

$time1 = strtotime($end_date);

 $diff = $time1 - $time;
$diff = round($diff/ 86400);


if($package_type == 'Business'){
   $price = 100.00;
   $remain_url=35 * $Selected_month ;
}
else{
	$price = 200.00;
	$remain_url="unlimited";
}

$total_pice = $price*$Selected_month;

	$cus_email_sql =  "select * from customers where Email=:Email ";
	$stmt_cus_email =   $conn->prepare($cus_email_sql);

	$params_email =  array(
		  "Email"=>$email
	);

	$stmt_cus_email->execute($params_email);
	$res_cus_email =	$stmt_cus_email->fetch(PDO::FETCH_ASSOC);
	if($stmt_cus_email->rowCount() > 0){
	  $email_err = "sorry this email is already exist try other one";
	  $email_st = 0;
	}else{
		$email_st = 1;
	}

	if($password !==   $confirm_password  ){
		$cpass_err = "Confirm password should be equal to password";
		$pass_st=0;
	}
	else if(strlen($password) < 3){
		$pass_err = "password should be greater than 3 character";
		$pass_st=0;
	}
	else if(strlen($password) > 10){
		$pass_err = "password should be less  than 10 character";
		$pass_st=0;
	}
	else if(!preg_match("/^[a-zA-Z0-9]*$/",$username)){
		$pass_err = "password only contain alphbets and numbers";
		$pass_st=0;
	}else{
		$pass_st=1;
	}

    if(strlen($username) < 3){
		$name_err = "username should be greater than 3 character";
		$name_st =0;
	}
	else if(strlen($username) > 10){
		$name_err = "username should be less  than 10 character";
		$name_st =0;
	}
	else if(!preg_match("/^[a-zA-Z0-9]*$/",$username)){
		$name_err = "username only contain alphbet and numbers";
		$name_st =0;
	}
	else{
		$name_st =1;
	}

	if($name_st==1 && $email_st==1 && $pass_st==1){
			$sql =  "insert into customers(username, Email,password,package_type,method_type,start_date,end_date,total_price,remaining_url,token,status) values(:username, :Email,:password,:package_type,:method_type,:start_date,:end_date,:total_price,:remaining_url,:token,:status)";

			$stmt =   $conn->prepare($sql);
	
			$params =  array(
				  "username"=>$username,
				  "Email"=>$email,
				  "password"=>$password,
				  "package_type"=>$package_type,
				  "method_type"=>$method_type,
				  "start_date"=>$start_date,
				  "end_date"=>$end_date,
				  "total_price"=>$total_pice,
				  "remaining_url"=>$remain_url,
				  "token"=>"0",
				  "status"=>"active"
			);
	
			$stmt->execute($params);
			if($stmt->rowCount() > 0){
			$id =$conn->lastInsertId();

				 echo "<script>location.href='checkout.php?id=$id'</script>";

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
  <title> SignUp </title>

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
    <form action="" method="post">
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
				<span class="text-danger mt-1"><?php echo $name_err; ?></span>
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
			</div>
			<span class='text-danger'><?php echo  $email_err; ?></span>
        </div>
		<div class="form-group">
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fa fa-lock"></i>
					</span>                    
				</div>
				<input type="text" class="form-control" name="password" placeholder="Password" required="required">
				<span class="text-danger mt-1"><?php echo $pass_err; ?></span>
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
				<span class="text-danger mt-1"><?php echo $cpass_err; ?></span>
			</div>
        </div>

		<div class="form-group">
		<label for="Pa" class="text-dark">Package Type</label>
			<select class="custom-select" name="package_type" onchange="sub(event)" >
			 <option value="Business"  >Business</option>
			 <option value="Enterprise" >Enterprise</option>
			</select>
        </div>

		<div class="form-group" id="method_type">
		<label for="method" class="text-dark">Method Type</label>
		<select class='custom-select' name='method_type'  >
		<option value='Jazzcash' selected>Jazzcash</option>
	</select>
        </div>
	
		<div class="form-group" id="month">
		<label for='month' class='text-dark'>Select Month</label>
		<select class='custom-select' name='Selected_month' onchange='mon(event)' >
		<option value='1' >1</option>
		<option value='2'>2</option>
		<option value='3'>3</option>
		<option value='4'>4</option>
		<option value='5'>5</option>
		<option value='6' >6</option>
		</select>
		</div>

        <div class="form-group" id="Account_Field">
		
        </div>

		<div class="form-group" id="total_price">
		
        </div>
       
		<div class="form-group">
            <button type="submit" name="Signup" class="btn btn-primary btn-lg">Sign Up</button>
        </div>
    </form>
	<div class="text-center">Already have an account? <a href="login.php">Login here</a></div>
</div>

<script type="text/javascript">
	var price = 100;
	var month = 1;


function sub(e){
	
	if(e.target.value === 'Business'){

         price = 100 ;

		 var total_price = month * price;

document.getElementById('total_price').innerHTML = "<h4>Total Price: "+total_price+"</h4>";
	}
	else if(e.target.value === 'Enterprise'){
	
price = 200;

var total_price = month * price;

document.getElementById('total_price').innerHTML = "<h4>Total Price: "+total_price+"</h4>";
	}



}


function add_filed(e){

	if(e.target.value === 'Jazzcash'){
 	var append = "<div class= 'input-group'><div class='input-group-prepend'><span class='input-group-text'><span class='fa fa-user'></span></span></div><input type='text' class='form-control' value='Waqas' disabled></div><br/><div class='input-group'><div class='input-group-prepend'><span class='input-group-text'><span class='fa fa-user'></span></span></div><input type='text' class='form-control' value='03094930700' disabled ></div>";

	 document.getElementById('Account_Field').innerHTML = append;

	}
	else if(e.target.value === 'EasyPaisa'){
 	var append = "<div class= 'input-group'><div class='input-group-prepend'><span class='input-group-text'><span class='fa fa-user'></span></span></div><input type='text' class='form-control' value='Waqas' disabled></div><br/><div class='input-group'><div class='input-group-prepend'><span class='input-group-text'><span class='fa fa-user'></span></span></div><input type='text' class='form-control' value='03094930700' disabled ></div>";

	 document.getElementById('Account_Field').innerHTML = append;

	}
	else {
		document.getElementById('Account_Field').innerHTML = "";
	}



}
	// window.alert("hello");

	function mon(e){
	month =	e.target.value;
	
	var total_price = month * price;

document.getElementById('total_price').innerHTML = "<h4>Total Price: "+total_price+"</h4>";
	}
	var total_price = month * price;

document.getElementById('total_price').innerHTML = "<h4>Total Price: "+total_price+"</h4>";
   

</script>
  <!-- jQuery -->
  <script type="text/javascript" src="Js/jquery.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="Js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="Js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="Js/mdb.min.js"></script>

  <script type="text/javascript" src="Js/all.min.js"></script>
  <!-- Your custom scripts (optional) -->


 

</body>
</html>
