
  <?php

require_once 'Components/dbConnection.php';
require_once "ShortenerClass.php";

$long_url_status= 0;
$expire_status = 0;
$custom_status = 0;
$long_msg_err= "";
$expire_err= "";
$custom_err= "";
$Created_url = "";
$expire_date = "";
$custom_words = "";
$Created_at = "";
$short_words="";
if(isset($_POST['url_submit'])){

  $url_type = $_POST['url_type'];
  $short_words = $_POST['short_words'];
   $Created_at = date('Y-m-d');

   if(empty($_POST['long_url'])){
    $long_msg_err="Please Fill this field";
    $long_url_status= 0;
   }
   else{
    $url = $_POST['long_url'];
    $long_url_status= 1;
   }

  if($_POST['url_type'] == 'permanent_url'){
    $expire_date = "0000-00-00";
    $expire_status = 1;

  }
  else{ 

  if($Created_at > $_POST['expire_date']){
   $expire_err="Expired date can't be less than recent date";
   $expire_status = 0;
  }
  else if($Created_at ==  $_POST['expire_date']){
    $expire_err="Expired date can/'t be equal to recent date";
    $expire_status = 0;
  }
    else{
      $expire_date = $_POST['expire_date'];
      $expire_status = 1;
    }
 
  }

  if($_POST['short_words'] == 'random'){
    $custom_words = "";
$custom_status = 1;

  }
  else{
    $custom_words = test_input($_POST['custom_words']);
    if(empty($custom_words)){
      $custom_err = "Field can't be empty";
      $custom_status = 0;
    }
   else if(!preg_match("/^[a-zA-Z]*$/",$custom_words)) {
      $custom_err = "Only Alpabets are allowed";
      $custom_status = 0;
      }
      else if(strlen($custom_words) > 9) {
        $custom_err = "only 8 character are allowed";
        $custom_status = 0;
        }
      else{
        $custom_words =  $custom_words;

       $sql_custom = "select short_url from short_urls where short_url=:custom_words limit 1  ";
       $stmt_custom =   $conn->prepare( $sql_custom);

       $para_custom =  array(
         "custom_words"=>$custom_words       
       );

       $stmt_custom->execute($para_custom);
        if($stmt_custom->rowCount() > 0){
          $custom_status = 0;
          $custom_err = "This Words is already taken";
        }
        else{

                $custom_status = 1;
         }
      }
      
  }

if($long_url_status === 1 && $expire_status === 1 && $custom_status === 1){
 $short = new shotener($conn,$expire_date,$url_type,$short_words,$custom_words);


$long_Url = $url;

// $shortURL_Prefix = 'https://xyz.com/'; // with URL rewrite
$shortURL_Prefix = 'http://localhost/fyp_project/Enterprise/'; // without URL rewrite


try{
    
   $shortCode =  $short->UrlToshortCode($long_Url);

 $shortUrl =  $shortURL_Prefix.$shortCode;


       $Created_url = '<a href="'.$shortUrl.'"target="_blank">'.$shortUrl.'</a>';

   
}
catch(Exception $e){
  $long_msg_err = $e->getMessage();

      
}
}

}
 function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
  
  include "Components/header.php"; 
   include "Components/Sidebar.php";
   $email_session = $_SESSION['email'];

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
if( $diff > 0){
    ?>

   <div class="content">
    
 <div class="card my-5 shadow-lg"  >
  <div class="card-body">
<?php 

if($Created_url){ ?>
  <div class="alert alert-warning alert-dismissible fade show " id="alert_warning" role="alert">
  <strong>Your Short Url :</strong><?php echo $Created_url; ?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php } else{  ?>
  <div class="alert alert-warning alert-dismissible fade show d-none" id="alert_warning" role="alert">
  <strong></strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php } ?>

  <form action="" method="post">
  <div class="form-group">
    <label for="exampleFormControlInput1">Enter  Url</label>
    <input type="text" name="long_url" class="form-control" id="exampleFormControlInput1" placeholder="Enter Website Url">
  </div>
  <span ><h6 style="color:red;"><?php echo $long_msg_err; ?></h6></span>
  <div class="form-group">
    <label for="exampleFormControlSelect1"> Select Action</label>
    <select class="form-control" name="url_type" onClick="url_date(event);" id="exampleFormControlSelect1">
      <option value="permanent_url">Permanent Url</option>
      <option value="temporary_url">Temporary Url</option>
    </select>
  </div>
  <div class="form-group" id="expire_date">
   
  </div>
  <span ><h6 style="color:red;"><?php echo $expire_err; ?></h6></span>

  <div class="form-group">
    <label for="exampleFormControlSelect1"> Select Short Code</label>
    <select class="form-control" name="short_words"  onClick="short_url(event);" id="exampleFormControlSelect1">
    <option value="random">Random</option>
      <option value="custom">Custom</option>
    </select>
  </div>
  <div class="form-group" id="custom_words">
   
  </div>
  <span ><h6 style="color:red;"><?php echo $custom_err; ?></h6></span>

  <div class="form-group">
    <button type="submit" name="url_submit" class="btn btn-primary btn-block">Short it</button>
  </div>
</form>
   </div>
   </div>

   <?php } else {?>
 
 <div class="container   d-flex align-items-center justify-content-center" style="height:70vh; width:80vw;"  >

 <div class=" col-md-6 offset-md-2">
   <div class="card border-left-primary shadow py-2 h-100" >
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

   </div>
  

 <script type="text/javascript">
function url_date(e){
	
	if(e.target.value === 'permanent_url'){

document.getElementById('expire_date').innerHTML = "";
	}
	else if(e.target.value === 'temporary_url'){

document.getElementById('expire_date').innerHTML = "<label for='exampleFormControlInput1'>Select Expiry Date</label> <input type='date' class='form-control' name='expire_date' id='exampleFormControlInput1' placeholder='mm/dd/yyyy'>";
	}
}

function short_url(e){
	
	if(e.target.value === 'random'){

document.getElementById('custom_words').innerHTML = "";
	}
	else if(e.target.value === 'custom'){

document.getElementById('custom_words').innerHTML = "<label for='exampleFormControlInput1'>Enter Custom Words</label><input type='text' name='custom_words' class='form-control' id='exampleFormControlInput1' placeholder='custom Words'>";
	}



}



	// window.alert("hello");

   

</script>

<?php  include "Components/lastEnd.php"; ?>