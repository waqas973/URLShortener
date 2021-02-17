
  <?php include "Components/header.php"; 
include "Components/Sidebar.php";
include "Components/dbConnection.php";


$id ="";
  if(isset($_GET['id'])){
   $_SESSION['singleView'] =$_GET['id'];
        }

?>

    <div class="content">
        <div class="container">
            
            <div class="row no-gutters">
                <div class="col-lg-6  ">
                <div id="piechart_3d" ></div>
                </div>
                <div class="col-lg-6  ">
                <div id="system" ></div>
                </div>
            </div>

            <div class="row no-gutters">
                <div class="col-lg-6  ">
                <div id="OSSystem" ></div>
                </div>
                <div class="col-lg-6  ">
                 <div><h3>Top Referrel Website</h3></div>
                 <table class="table">
    <thead>
      <tr>
        <th class="font-weight-bold"> website URL</th>
        <th class="font-weight-bold">Clicks</th>
      </tr>
    </thead>
    <tbody>
    <?php 
  
 
  $sql = " select ref_site, sum(clicks) as visit from detection where short_urls_id=:customer_id And ref_site!=:ref_site group by ref_site order by sum(clicks) DESC limit 10 ";
  $stmt = $conn->prepare($sql);
  $params = array(
    "customer_id"=>$_GET['id'],
    "ref_site"=>"N/A"
) ;
$stmt->execute($params);
if($stmt->rowCount() > 0){
while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
?>
      <tr>
        <td><?php echo $result['ref_site'];  ?></td>
        <td><?php echo $result['visit'];  ?></td>
    
      </tr>
 <?php   }} else { ?>
  <tr class="text-center">
        <td colspan="4 ">No Record found</td>
    
      </tr>
  <?php   }?>    
    </tbody>
  </table>
                </div>
            </div>


            <div class="row">
            <div class="col">
               <div class="">
                 <h2 class="display-5 font-weight-bolder">Top Location</h2>
               </div>
               <?php 
  
  $sql = "select * from detection where short_urls_id=:short_urls_id ";
  $stmt = $conn->prepare($sql);
  $params = array(
    "short_urls_id"=>$_GET['id']
) ;
$stmt->execute($params);
if($stmt->rowCount() > 0){
?>
            <div id="regions_div" ></div>
            <?php } else{?>
              <div  class="text-center mb-5">No data </div>
              <?php } ?>
            </div>

           
            </div>
            
        </div>
  
    </div>
    <?php include "Components/lastEnd.php";
    
     include "singleViewgraph.php";
    ?>
