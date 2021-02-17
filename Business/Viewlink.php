
  <?php
  include "Components/header.php"; 
   include "Components/Sidebar.php"; 
   include "Components/dbConnection.php"; 
   include "Components/function.php";
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

    <div class="content ">
    <div class="table-responsive ">


    <table class="table table-hover table-sm table-dark table-bordered">
    <thead class="text-center">
    <?php 

      $customer_id = get_id();
         $sql = "select * from short_urls where customer_id = :customer_id";
         $stmt =   $conn->prepare( $sql);

         $para =  array(
           "customer_id"=>$customer_id       
         );
  
         $stmt->execute($para);
         $shortURL_Prefix = 'http://localhost/fyp_project/Business/';
    ?>
      <tr >
        <th>Sid</th>
        <th>long url</th>
        <th>short url</th>
        <th>create Date</th>
        <th>Expire Date</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody  >

    <?php 
    if($stmt->rowCount() > 0){
      while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    ?>
      <tr>
        <td><?php echo $result['id']; ?></td>
        <td><?php echo $result['long_url'];  ?></td>
        <td id="copy<?php echo $result['id'];  ?>"><?php echo $shortURL_Prefix.$result['short_url']; ?></td>
        <td><?php echo $result['created'];  ?></td>
        <td><?php echo $result['expiry_date'];  ?></td>

        <td style="font-size:16px;" class="d-flex justify-content-center align-items-center">
        <i data-toggle="tooltip" data-placement="top" title="copy" class="far fa-copy mr-3" style="cursor:pointer"  onMouseOver="this.style.color='red'"  onMouseOut="this.style.color='white'" onclick="myfunction('<?php echo $result['id']; ?>')"></i>
       <a href="SingleView.php?id=<?php echo $result['id']; ?>" class="text-white">
       <i onMouseOver="this.style.color='red'"  onMouseOut="this.style.color='white'" class="far fa-eye"></i>
       </a>
        </td>

      </tr>
      <?php  } }else{?>
      <tr class="text-center"><td colspan="6">No record found</td></tr>
        <?php  } ?>
    </tbody>
  </table>
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
  
<script>
function myfunction(id){

  var copy = "copy"+id;
  var copyText = document.getElementById(copy);
 copyText = copyText.textContent;
  
    var textArea = document.createElement("textarea");
    textArea.value = copyText;
    document.body.appendChild(textArea);
    textArea.select();
    document.execCommand("Copy");
    textArea.remove();
}

</script>

   <?php include "Components/lastEnd.php"; ?>