<link rel="stylesheet" href="Css/bootstrap.min.css">

  <link rel="stylesheet" href="Css/all.min.css">
  <!-- Material Design Bootstrap -->
  <link rel="stylesheet" href="Css/mdb.css">
  <!-- Your custom styles (optional) -->
  <link rel="stylesheet" href="Css/style.css">
<?php 
  include 'Components/dbConnection.php';
$err = "";
function EnterPass($shortCode){
    global $conn;
if(isset($_POST['form_pass'])){
   $pass = $_POST['password'];
    
   $sql = "SELECT * FROM short_urls where short_url=:shortCode AND hide_pass=:hide_pass";
   $stmt =  $conn->prepare($sql);
   
$params = array(
   "shortCode"=>$shortCode,
   "hide_pass"=>$pass
) ;
$stmt->execute($params);
    
if($stmt->rowCount() > 0){
   return 1;
}
   else{
  
    $err = "enter correct password";
   }
}

?>
<div class="container">
<div class="row mt-5">
<div class="col-5 mx-auto" >

<div class="card shadow-lg" >
  <div class="card-body">
    <h5 class="card-title">Enter password</h5>
   
   <form action="" method="post">
   <div class="form-group">
    
    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
    
  <span class="text-danger"><?php if(isset($err)){echo $err;} ?></span>
  </div>
  <button type="submit" name="form_pass" class="btn btn-primary">Submit</button>
   </form>

  </div>
</div>


</div>
</div>
</div>


<?php }

?>