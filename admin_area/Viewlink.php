
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
     if(isset($_GET['id'])){
      $customer_id = $_GET['id'];
     }
     $sql = "SELECT  short_urls.short_url,short_urls.url_type,short_urls.short_words,short_urls.hits,short_urls.created,short_urls.expiry_date,customers.customer_id,customers.username,customers.package_type,customers.start_date,customers.end_date  from customers join short_urls on short_urls.customer_id=customers.customer_id where customers.customer_id=:customer_id";
     $query = $conn ->prepare($sql);
     $para =  array(
      "customer_id"=>$customer_id       
    );
     $query->execute($para);
  
  
         $Prefix_enterprise = 'http://localhost/fyp_project/Enterprise/';
         $Prefix_business = 'http://localhost/fyp_project/Business/';
         $Prefix_Starter = 'http://localhost/fyp_project/Starter/';
    ?>
      <tr >
        <th>Customer Id</th>
        <th>Name</th>
        <th>Package Type</th>
        <th>Package Start Date</th>
        <th>Package End Date</th>
        <th>Short Url</th>
        <th>Short Url Type</th> 
        <th>Short words</th> 
        <th>Hits</th> 
        <th>url start date</th> 
        <th>url end date</th> 
      </tr>
    </thead>
    <tbody  >

    <?php 
     if($query->rowCount() > 0)
     {
    
      while( $result = $query->fetch(PDO::FETCH_ASSOC)){
    ?>
      <tr>
        <td><?php echo $result['customer_id']; ?></td>
        <td><?php echo $result['username'];  ?></td>
        <td><?php echo $result['package_type']; ?></td>
        <td><?php echo $result['start_date'];  ?></td>
        <td><?php echo $result['end_date'];  ?></td>

        <td>
        <?php 
        if($result['package_type']=='Enterprise'){echo $Prefix_enterprise.$result['short_url']; } 
        else if($result['package_type']=='Business'){echo $Prefix_business.$result['short_url']; } 
        else{
          echo $Prefix_Starter.$result['short_url']; 
        }
        ?>
        </td>
        <td><?php echo $result['url_type'];  ?></td>
        <td><?php echo $result['short_words'];  ?></td>
        <td><?php echo $result['hits'];  ?></td>
        <td><?php echo $result['created'];  ?></td>
        <td><?php echo $result['expiry_date'];  ?></td>
      </tr>
      <?php  } }else{?>
      <tr class="text-center"><td colspan="11">No short url record found</td></tr>
        <?php  } ?>
    </tbody>
  </table>
  </div>
 
           

   </div>
  


   <?php include "Components/lastEnd.php"; ?>