<?php
 include 'Components/dbConnection.php';


 $data = stripslashes(file_get_contents("php://input"));
 $mydata = json_decode($data,true);
 $year = $mydata['year'];
if(isset($year)){

 
  
   $query = "select Month ,sum(clicks) as click from detection where year=:year order by Month ";
   $stm = $conn->prepare($query);
   $par = array(
     "year"=>$year
 ) ;
 $stm->execute($par);
 $result = $stm->fetchAll();
 foreach($result as $row){
     $output[] =array(
         'month' => $row["Month"],
         'click' => $row["click"]
     );
 }
echo json_encode($output);
}

?>