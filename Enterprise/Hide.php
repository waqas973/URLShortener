
  <?php 
    include "Components/dbConnection.php";
  include "Components/header.php";
   include "Components/Sidebar.php"; 
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
         $shortURL_Prefix = 'http://localhost/fyp_project/Enterprise/';
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
        <td class="lock_id" ><?php echo $result['id']; ?></td>
        <td><?php echo $result['long_url'];  ?></td>
        <td><?php echo $shortURL_Prefix.$result['short_url']; ?></td>
        <td><?php echo $result['created'];  ?></td>
        <td><?php echo $result['expiry_date'];  ?></td>
        <td>
          
          <?php if($result['status']==1)
          {
          ?>
          <i title="lock" class="fas fa-lock lock_cl"  style="cursor:pointer; font-size:16px;"  onMouseOver="this.style.color='red'"  onMouseOut="this.style.color='white'" ></i>
          <?php  }  else{  ?>
        <i title="unlock" class="fas fa-lock-open lock_cl " data-toggle="modal" data-target="#myModal" style="cursor:pointer;font-size:16px;"  onMouseOver="this.style.color='red'"  onMouseOut="this.style.color='white'" ></i>
          <?php } ?>
         </td>

      </tr>
      <?php  } }else{?>
      <tr class="text-center"><td colspan="6">No record found</td></tr>
        <?php  } ?>
   
     
    </tbody>
  </table>


   
  </div>

<div class="container"> <!-- container model -->

  <!-- The Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
       
        <!-- Modal body -->
     
        <div class="modal-body">
        <form method="post" id="hid_pass">
        <div class="form-group">
             <input type="hidden" class="form-control md_id" id="exampleFormControlInput2" placeholder="id" />
         </div>
        <div class="form-group">
             <label for="exampleFormControlInput1">Enter Password</label>
             <input type="password" class="form-control md_pw" id="exampleFormControlInput1" placeholder="Password" />
         </div>
         <button type="submit" name="lock_it" id="md_val_bt"   class="btn btn-danger" >Done</button>
         </form>
        </div>
  
        <!-- Modal footer -->
        <div class="modal-footer">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      
        </div>
     
      </div>
    </div>
  </div>
  

</div><!-- container model -->
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

 
   <?php include "Components/lastEnd.php";
   
   
   
   ?>
       
   <script>
$(document).ready(function(){
  var pass;
  var id;
  var $regex=/^([a-zA-Z1-9]{3,10})$/;
     $('.lock_cl').click(
       function(){

         if($(this).hasClass('fa-lock-open')===true){
          val = $(this).parents("tr").find(".lock_id").text();
         $(".md_id").val(val); 
         }
         else{
        var conf =  confirm("Do you want unset password");
        if(conf === true){
          val = $(this).parents("tr").find(".lock_id").text();

         var   mydata = { id:val};
         console.log(mydata);
    $.ajax({  
    url:"unhideInsert.php",  
    method:"POST",  
    data:JSON.stringify(mydata),  
    success:function(data){  
    alert(data);
    setTimeout(function(){// wait for 5 secs(2)
           location.reload(); // then reload the page.(3)
      }, 1000); 
    }  
   });  

   }else{
   
        }
         }
       

       }
     )

     $('#md_val_bt').click(
       function(e){
              e.preventDefault();
        pass = $(".md_pw").val();
        id = $(".md_id").val();
       
      if($('.md_pw').val() == "")  
  {  
   alert("Password is required");  
  }  
  else if(pass.length < 3)  
  {  
   alert("Password should be greater than 3 character ");  
  } 
  else if(pass.length > 10)
  {  
   alert("Password should be less than  10 character");  
  }
  else if(!pass.match($regex))
  {  
   alert("Only Alphbets and Numbers allowed");  
  }
  else{
   var   mydata = { id:id, pass:pass};
   console.log(mydata);
    $.ajax({  
    url:"hideInsert.php",  
    method:"POST",  
    data:JSON.stringify(mydata),  

    success:function(data){  
  
     
      $('#hid_pass')[0].reset();  
    //  $('#insert_form')[0].reset();  
     $('#myModal').modal('hide');  
    //  $('#employee_table').html(data);  
    alert(data);
    
    setTimeout(function(){// wait for 5 secs(2)
           location.reload(); // then reload the page.(3)
      }, 1000); 


    }  
   });  
  }


       }
     )

   
  })

  // $("#divGFG").empty();          
  //     $("#divGFG").append(p); 
   </script>
