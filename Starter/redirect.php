<?php

  include 'Components/dbConnection.php';
  include 'ShortenerClass.php';
  include 'Components/Mobile_Detect.php';
  include 'Components/BrowserDetection.php';
  include 'Components/function.php';
  include 'funHideform.php';
  $short = new shotener($conn,0,0,0);

  $shortCode = $_GET['c'];

 


  $sql = "select customer_id from short_urls where short_url=:short_url ";
  $stmt =  $conn->prepare($sql);
  $params = array(
      "short_url"=>$shortCode
  ) ;
  $stmt->execute($params);

 $res =  $stmt->fetch();


  try{
    $url =  $short->shortCodeToUrl($shortCode);
    
    $sql = "SELECT * FROM short_urls where short_url=:shortCode";
    $stmt =  $conn->prepare($sql);
    
$params = array(
	"shortCode"=>$shortCode
) ;
$stmt->execute($params);
      
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
           
      $Month_date = date('y-m-d');
      $month = date("F",strtotime($Month_date));
      $year = date("Y",strtotime($Month_date));
      
      if($result['expiry_date']=='0000-00-00'){

        header("Location: ".$url);
        $browser=new Wolfcast\BrowserDetection;

        $browser_name=$browser->getName();
        $browser_version=$browser->getVersion();
        
        $detect=new Mobile_Detect();
        
        if($detect->isMobile()){
          $type='Mobile';
        }elseif($detect->isTablet()){
          $type='Tablet';
        }else{                
          $type='PC';
        }
        
        if($detect->isiOS()){
          $os='IOS';
        }elseif($detect->isAndroidOS()){
          $os='Android';
        }else{
          $os='Window';
        }
        
        $url=(isset($_SERVER['HTTPS'])) ? "https":"http";
        $url.="//$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $ref='';
        if(isset($_SERVER['HTTP_REFERER'])){
          $ref=$_SERVER['HTTP_REFERER'];
        }else{
          $ref='N/A';
        }
     
          $country = "";
          $region =  "";
          $regionName =  "";
          $city = "";
          $zip = "";
          $lat = "";
          $lon =  "";
          $timezone = "";
     
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,"http://ip-api.com/json");
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        $response=curl_exec($ch);
         $response = json_decode($response);
       
         if($response->status == 'success'){
         $country = $response->country;
          $region =  $response->region;
          $regionName =  $response->regionName;
          $city = $response->city;
          $zip = $response->zip;
          $lat = $response->lat;
          $lon =  $response->lon;
          $timezone = $response->timezone;
         }
        curl_close($ch);
        
        $sql="insert into detection(short_urls_id,browser_name,device_type,OS_type,ref_site,country,region,regionname,city,zip,lat,lon,timezone,customer_id,Month,year) values(:short_urls_id,:browser_name,:type,:os,:ref,:country,:region,:regionname,:city,:zip,:lat,:lon,:timezone,:customer_id,:Month,:year)";
        
        $stmt =  $conn->prepare($sql);
        $params = array(
          
          "short_urls_id"=>$result['id'],
          "browser_name"=>$browser_name,
          "type"=>$type,
          "os"=>$os,
          "ref"=>$ref,
          "country"=>$country,
          "region"=>$region,
          "regionname"=>$regionName,
          "city"=>$city,
          "zip"=>$zip,
          "lat"=>$lat,
          "lon"=>$lon,
          "timezone"=>$timezone,
          "customer_id"=>$res['customer_id'],
          "Month"=>$month,
          "year"=>$year
         
        ) ;
        $stmt->execute($params);
        $last_id = $conn->lastInsertId();
       
      
        $query = "UPDATE detection SET clicks = clicks + 1 WHERE id=:last_id";
        $stmt = $conn->prepare($query);
        $params = array(
            "last_id" => $last_id
        );
        $stmt->execute($params);
     
         exit;
        
  
  }

else{
  $start_date = strtotime(date('y-m-d'));

$end_date = strtotime($result['expiry_date']);

   $diff = $end_date - $start_date;
  $diff = round($diff/ 86400);
   if( $diff > 0){
  
       header("Location: ".$url);
       $browser=new Wolfcast\BrowserDetection;

       $browser_name=$browser->getName();
       $browser_version=$browser->getVersion();
       
       $detect=new Mobile_Detect();
       
       if($detect->isMobile()){
         $type='Mobile';
       }elseif($detect->isTablet()){
         $type='Tablet';
       }else{                
         $type='PC';
       }
       
       if($detect->isiOS()){
         $os='IOS';
       }elseif($detect->isAndroidOS()){
         $os='Android';
       }else{
         $os='Window';
       }
       
       $url=(isset($_SERVER['HTTPS'])) ? "https":"http";
       $url.="//$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
       $ref='';
       if(isset($_SERVER['HTTP_REFERER'])){
         $ref=$_SERVER['HTTP_REFERER'];
       }else{
         $ref='N/A';
       }
    
         $country = "";
         $region =  "";
         $regionName =  "";
         $city = "";
         $zip = "";
         $lat = "";
         $lon =  "";
         $timezone = "";
    
       $ch = curl_init();
       curl_setopt($ch,CURLOPT_URL,"http://ip-api.com/json");
       curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
       $response=curl_exec($ch);
        $response = json_decode($response);
      
        if($response->status == 'success'){
        $country = $response->country;
         $region =  $response->region;
         $regionName =  $response->regionName;
         $city = $response->city;
         $zip = $response->zip;
         $lat = $response->lat;
         $lon =  $response->lon;
         $timezone = $response->timezone;
        }
       curl_close($ch);
       
       $sql="insert into detection(short_urls_id,browser_name,device_type,OS_type,ref_site,country,region,regionname,city,zip,lat,lon,timezone,customer_id,Month,year) values(:short_urls_id,:browser_name,:type,:os,:ref,:country,:region,:regionname,:city,:zip,:lat,:lon,:timezone,:customer_id,:Month,:year)";
       
       $stmt =  $conn->prepare($sql);
       $params = array(
         
         "short_urls_id"=>$result['id'],
         "browser_name"=>$browser_name,
         "type"=>$type,
         "os"=>$os,
         "ref"=>$ref,
         "country"=>$country,
         "region"=>$region,
         "regionname"=>$regionName,
         "city"=>$city,
         "zip"=>$zip,
         "lat"=>$lat,
         "lon"=>$lon,
         "timezone"=>$timezone,
         "customer_id"=>$res['customer_id'],
         "Month"=>$month,
         "year"=>$year
        
       ) ;
       $stmt->execute($params);
       $last_id = $conn->lastInsertId();
      
     
       $query = "UPDATE detection SET clicks = clicks + 1 WHERE id=:last_id";
       $stmt = $conn->prepare($query);
       $params = array(
           "last_id" => $last_id
       );
       $stmt->execute($params);
    
        exit;
       
 
 }
   else{
    $query = "UPDATE short_urls SET expiry_status = :expiry_status WHERE short_url=:short_url";
    $stmt_update = $conn->prepare($query);
    $params = array(
      "expiry_status" => 1,
        "short_url" => $shortCode
    );
    $stmt_update->execute($params);
   $id = $result['id'];
    echo "<script>location.href='Expirelink.php'</script>";
   }
 
 
}
      }
   


  catch(Exception $e){
      echo $e->getMessage();
  }

?>