
  <?php
     include "Components/dbConnection.php";
     include "Components/function.php";
   include "Components/header.php";
  include "Components/Sidebar.php";
 $email_session = $_SESSION['admin_email'];
 

 if(isset($_POST['answer_query'])){
   $id = $_POST['id'];
   $name = $_POST['Name'];
   $email = $_POST['email'];
   $answer = $_POST['answer'];
//    echo "<script>alert( $id)</script>";

//    echo "<script>console.log($email)</script>";
   $sql = "UPDATE query_report SET admin_answer=:admin_answer , status=:status WHERE id =:id" ;
   $stmt_up = $conn->prepare($sql);

   $params_up =  array(
     "admin_answer"=>$answer,
         "status"=>0,
         "id"=>$id
   );
$stmt_up->execute($params_up);


if($stmt_up->rowCount() > 0){

    $subject = "query Answer from short urls";
				$body = "Hi, $name. $answer";
				$headers = "From: waqascomsts786@gmail.com";
               		
				if (mail($email, $subject, $body, $headers)) {
                    echo "<script>alert('Mail send successfully')</script>";
				header("location:Viewquery.php");
				 }
				 else {
					echo "Email sending failed...";
				}
}
 }
 ?>

    <div class="content">
    <?php
      $sql =  "select * from query_report ";
      $stmt =   $conn->prepare($sql);
    $stmt->execute();
    ?>
        <div class="container">
            <div class="row">
           <?php
            if($stmt->rowCount() > 0)
            {
             while($result=$stmt->fetch(PDO::FETCH_ASSOC)){

       ?>
            <div class=" col-md-12 mb-4">
              <div class="card border-left-primary shadow py-2 h-100">
                <div class="card-body">
                  <h4 ><span style='color:red;'>Name:</span><?php echo $result['name'];  ?> </h4>
                  <h4 ><span style='color:red;'>Email:</span> <?php echo $result['email'];  ?></h4>
                  <p  ><span style='color:red;'>Query:</span><?php echo $result['query'];  ?></p>

                  <form method='post'>
                  <input type='hidden' name='Name' value="<?php echo $result['name']; ?>" />
                  <input type='hidden' name='email' value="<?php echo       $result['email']; ?>" />
                  <input type='hidden' name='id' value="<?php echo $result['id']; ?>" />
                   <div class="form-group">
                     <label for="comment">Answer:</label>
                     <textarea class="form-control" name='answer' rows="5" id="comment" required></textarea>
                   </div>
              
                
                  <?php if($result['status'] != 1){

                 ?>
                   <h5 class=" bg-success text-center">already answer</h5>
                   <?php     }else{  ?>
                  <h5 style='color:red;'>Not yet Answer</h5>
                  <button class="btn btn-success text-center" name='answer_query'>submit answer</button>
                  <?php  } ?>
                  </form>
                </div><!--card-body-->
              </div><!--card end-->

             </div>
   <?php }} ?>
          
                </div><!--card-body-->
              </div><!--card end-->

             </div>

      

  
 <!-- expire link table end -->

            </div>
        
  

         

            
        </div>
  
    </div>

   <?php 
    include "Components/lastEnd.php"; 
 
    ?>
