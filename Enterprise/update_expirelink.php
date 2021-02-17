
  <?php

require_once 'Components/dbConnection.php';
require_once "ShortenerClass.php";


$expire_status = 0;
$expire_err= "";
$Created_url = "";
$expire_date = "";
$Created_at = "";
$id = $_GET['id'];
if(isset($_POST['url_submit'])){

  $url_type = $_POST['url_type'];
   $Created_at = date('Y-m-d');

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
      
 if( $expire_status == 1 && isset($url_type)){
//    echo "<script>alert('$url_type')</script>";

 //  echo "<script>alert('$id')</script>";
   
    $query = "UPDATE short_urls SET url_type=:url_type, expiry_date = :expire_date,expiry_status=:expiry_status WHERE id=:id";
    $stmt_update = $conn->prepare($query);
    $params = array(
        "url_type" =>$url_type,
      "expire_date" =>$expire_date,
      "expiry_status" =>0,
        "id" => $id
    );
    $stmt_update->execute($params);
  if($stmt_update->rowCount() > 0){
      echo "<script>alert('update Successfully')</script>";
  }

}

}
  
  include "Components/header.php"; 
   include "Components/Sidebar.php";
  
    ?>

   <div class="content">
    
 <div class="card my-5 shadow-lg"  >
  <div class="card-body">

  <form action="" method="post">
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
    <button type="submit" name="url_submit" class="btn btn-primary btn-block">update it</button>
  </div>
</form>
   </div>
   </div>

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

	// window.alert("hello");

   

</script>

<?php  include "Components/lastEnd.php"; ?>