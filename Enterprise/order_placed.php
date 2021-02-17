<?php 

include 'Components/function.php';



 
// Include configuration file 
include_once 'Components/config.php'; 
 
// Include database connection file 
include_once 'Components/dbConnection.php'; 

?>


<?php

//echo '<pre>';
//print_r($_POST);
//echo '</pre>';



// If transaction data is available in the URL 
if(!empty($_POST['pp_Amount']) && !empty($_POST['pp_AuthCode']) && !empty($_POST['pp_ResponseCode']) && !empty($_POST['pp_MerchantID']) && 
!empty($_POST['pp_SecureHash']) && !empty($_POST['pp_TxnRefNo']) && !empty($_POST['pp_RetreivalReferenceNo']))
{
	//NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN
    //Get transaction information from URL 
    $Transaction_id 	= $_POST['pp_TxnRefNo'];
	$Amount 			= $_POST['pp_Amount']; 
    $AuthCode 			= $_POST['pp_AuthCode']; 
	$ResponseCode 		= $_POST['pp_ResponseCode'];
	$ResponseMessage 	= $_POST['pp_ResponseMessage'];
    $MerchantID 		= $_POST['pp_MerchantID'];
	$SecureHash 		= $_POST['pp_SecureHash'];
	$RetreivalReferenceNo = $_POST['pp_RetreivalReferenceNo'];

	//add period(.) before the last two digits of $Amount
	$Amount = substr($Amount, 0, -2) . '.00';
	//NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN
	
	

	//NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN
	//Insert tansaction data into the database
	if($ResponseCode == '000')
		{$payment_status = 1;}
	else
		{$payment_status = 0;}
	
		
}
else
{
	$ResponseCode = 'error';
	$ResponseMessage = 'Some Serious error occurs please check transaction logs for more detail';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title> ShortUrl</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="Css/bootstrap.min.css">

  <link rel="stylesheet" href="../Css/all.min.css">
  <!-- Material Design Bootstrap -->
  <link rel="stylesheet" href="Css/mdb.css">
  <!-- Your custom styles (optional) -->
  <link rel="stylesheet" href="Css/style.css">
 


  <style>


  </style>
</head>
<body >
<div class="container">
    <div class="status">
        <?php if($ResponseCode == '000'){ ?>
		<!-- --------------------------------------------------------------------------- -->
		<!-- Payment successful -->
		<div class='row'>
		<div class='col-md-6 mx-auto mt-5'>
		<div class='card'>
		<div class='card-body'>
		<h1 class="success">Your Payment has been Successful</h1>
            <h4>Payment Information</h4>
      
            <p><b>Transaction ID:</b> <?php echo $Transaction_id; ?></p>
            <p><b>Paid Amount:</b> <?php echo $Amount; ?></p>
            <p><b>Payment Status:</b> Success</p>
			<a href='index.php'><button class='btn btn-primary mx-auto'>Go to home page</button></a>
		</div>
		</div>
		</div>
		</div>
	
         
		<!-- --------------------------------------------------------------------------- -->
			
			
		<!-- --------------------------------------------------------------------------- -->
        <!-- Payment not successful -->
		<?php }else{ ?>
            <h1 class="error">Your Payment has Failed</h1>
			<p><b>Message: </b><?php echo $ResponseMessage;?></p>
        <?php } ?>
		<!-- --------------------------------------------------------------------------- -->
		
		
    </div>

</div>
 
 
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