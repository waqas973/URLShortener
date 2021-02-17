
  <?php
  include "Components/header.php"; 
   include "Components/Sidebar.php"; 
   include "Components/dbConnection.php"; 
   include "Components/function.php";
 
   ?>

    <div class="content ">
    <div class="table-responsive ">


    <table class="table table-hover table-sm table-dark table-bordered">
    <thead class="text-center">
    <?php 

      $customer_id = get_id();
         $sql = "select * from customers ";
         $stmt =   $conn->prepare( $sql);
         $stmt->execute();
    ?>
      <tr >
        <th>Sid</th>
        <th>customer Name</th>
        <th>Email</th>
        <th>Package Type</th>
        <th>Method Type</th>
        <th>Price</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody  >

    <?php 
    if($stmt->rowCount() > 0){
      while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    ?>
      <tr>
        <td><?php echo $result['customer_id']; ?></td>
        <td><?php echo $result['username'];  ?></td>
        <td><?php echo $result['Email']; ?></td>
        <td><?php echo $result['package_type']; ?></td>
        <td><?php echo $result['method_type'];  ?></td>
        <td><?php echo $result['total_price'];  ?></td>
        <td class='text-center' >
           <a href="Viewlink.php?id=<?php echo $result['customer_id']; ?>" class='btn btn-primary btn-sm'>view Details</a>
        </td>

      </tr>
      <?php  } }else{?>
      <tr class="text-center"><td colspan="6">No record found</td></tr>
        <?php  } ?>
    </tbody>
  </table>
  </div>

 
          

   </div>
  


   <?php include "Components/lastEnd.php"; ?>