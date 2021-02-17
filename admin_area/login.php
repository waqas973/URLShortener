<?php
   
   session_start();
 
   $msg = "";
    include 'Components/dbConnection.php';
   if(isset($_POST['login'])){
    $email =  $_POST['email'];
    $pass =  $_POST['pass'];
  
    $sql = "select * from admin_area where email=:email AND password=:pass" ;
    $stmt =   $conn->prepare($sql);

    $params =  array(
          "email"=>$email,
          "pass"=>$pass,

    );

$stmt->execute($params);
$result = $stmt->fetch(PDO::FETCH_ASSOC);


if($stmt->rowCount() > 0){
  
  $_SESSION['admin_email'] = $email;
  $_SESSION['admin_pass'] = $pass;
  $_SESSION['admin_username'] =  $result['username'];
  $_SESSION['admin_id'] =  $result['id'];
  $id  = $result['id'];

  echo "<script>alert('Logged in. Welcome Back')</script>";
  echo "<script>location.href = 'index.php?id='+$id</script>"; 
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

                </form>
                
            </div>
            
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>

<?php  include "Components/lastEnd.php"; ?>


 

</body>
</html>
