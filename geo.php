<?php    
 $ch = curl_init();
 curl_setopt($ch,CURLOPT_URL,"http://ip-api.com/json");
 curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
 $response=curl_exec($ch);
  $response = json_decode($response);

  if($response->status == 'success'){
   echo $response->country;
   echo $response->region;
   echo $response->regionName;
   echo $response->city;
   echo $response->zip;
   echo $response->lat;
   echo $response->lon;
   echo $response->timezone;
  }
 curl_close($ch);
// return (!empty($response) && $response!=404);
?>