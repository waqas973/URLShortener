<?php 


 class shotener 
 {
     protected static $chars = "abcdfghjkmnpqrstvwxyz|ABCDFGHJKLMNPQRSTVWXYZ|0123456789";
     protected static $checkUrlExists = true;
     protected static $table = "short_urls";
     protected static $codelength = 7;
    protected $pdo;
    protected $timestrump;
    protected $expire_date;
    protected $url_type;
    protected $short_words;
    protected $custom_words ;
   function __construct($pdo,$expire_date,$url_type,$short_words){
 
           $this->pdo = $pdo;
           $this->timestrump = date("Y-m-d ");
      $this->expire_date=$expire_date;
       $this->url_type=$url_type;
       $this->short_words=$short_words;

      
   }



   public function UrlToshortCode($long_Url){
             if($this->validateUrlFormat($long_Url)==false){
                 throw new Exception("url does not have a valid format");
             }
             if(self::$checkUrlExists){
       
                 if(!$this->verifyUrlExists($long_Url)){
                    throw new Exception("No url Exists");
                 }
             }

            $shortCode = $this->urlExistsInDb($long_Url);

            if($shortCode == false){
                if($this->short_words  == 'random'){
                  $shortCode =  $this->CreateShortCode($long_Url);
                }
            }
          
            return $shortCode;
        
   }

  protected function validateUrlFormat($long_Url){
      return filter_var($long_Url,FILTER_VALIDATE_URL);
  }

  protected function verifyUrlExists($long_Url){
      $ch = curl_init();
       curl_setopt($ch,CURLOPT_URL,$long_Url);
       curl_setopt($ch,CURLOPT_NOBODY,true);
       curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
      curl_exec($ch);
      $response = curl_getinfo($ch,CURLINFO_HTTP_CODE);
      curl_close($ch);
  return (!empty($response) && $response!=404);

 
}

protected function urlExistsInDb($long_Url){

    session_start();
    $customer_id =  $_SESSION['customer_id'];
 

         $sql = "select short_url from ".self::$table." where long_url=:long_url and customer_id=:customer_id limit 1";
       $stmt =  $this->pdo->prepare($sql);
       $params = array(
           "long_url"=>$long_Url,
           "customer_id"=>$customer_id
       ) ;
       $stmt->execute($params);

      $result =  $stmt->fetch();

   
 
      return (empty($result) ? false : $result['short_url']);
}

protected function CreateShortCode($long_Url){
   $shortCode =  $this->generateRandomString(self::$codelength);
   $id  = $this->insertUrlInDB($long_Url , $shortCode);
   
   return $shortCode ;
}

protected function generateRandomString($length = 6){
            $sets =  explode("|",self::$chars);
            $all = '';
            $randString = '';

            foreach($sets as $set){
           $randString.=$set[array_rand( str_split($set))];
           $all.=$set;

            }
         

            $all = str_split($all);
        
            for ($i=0; $i < $length - count($sets); $i++) { 
            $randString.= $all[array_rand($all)];
            }
      
         $randString =   str_shuffle($randString);
            return $randString;
}
    
protected function insertUrlInDB($long_Url , $shortCode ){
    session_start();
   $customer_id =  $_SESSION['customer_id'];

             $sql =  "insert into short_urls(customer_id,long_url, short_url,url_type,short_words,hide_pass,status,created,expiry_date,expiry_status) values(:customer_id,:long_url, :short_url,:url_type,:short_words,:hide_pass,:status,:created,:expiry_date,:expiry_status)";

          $stmt =   $this->pdo->prepare($sql);

          $params =  array(
            "customer_id"=>$customer_id,
                "long_url"=>$long_Url,
                "short_url"=>$shortCode,
                "url_type"=>$this->url_type,
                "short_words"=>$this->short_words,
                "hide_pass"=>"N/A",
                "status"=>0,
                "created"=>$this->timestrump,
                "expiry_date"=>$this->expire_date,
                "expiry_status"=>0
               
          );

          $stmt->execute($params);

    

          return $this->pdo->lastInsertId();
  
}

public function shortCodeToUrl($shortCode, $increment = true){
    if(empty($shortCode)){
        throw new Exception("NO short Code provide");
    }
    if($this->validateShortCode($shortCode)== false){
        throw new Exception("short code have not a valid format");
        
    }
    $urlRow = $this->getUrlFromDB($shortCode);
    if(empty($urlRow)){
        throw new Exception("Short code does not appear to exist.");
    }

    if($increment == true){
        $this->incrementCounter($urlRow["id"]);
    }

    return $urlRow["long_url"];
}

protected function validateShortCode($shortCode){
    $rawChars = str_replace('|', '', self::$chars);
    return preg_match("|[".$rawChars."]+|", $shortCode);
}

protected function getUrlFromDB($code){
    $query = "SELECT id, long_url FROM ".self::$table." WHERE 	short_url = :short_code LIMIT 1";
    $stmt = $this->pdo->prepare($query);
    $params=array(
        "short_code" => $code
    );
    $stmt->execute($params);

    $result = $stmt->fetch();
  
    return (empty($result)) ? false : $result;
}

protected function incrementCounter($id){
    $query = "UPDATE ".self::$table." SET hits = hits + 1 WHERE id = :id";
    $stmt = $this->pdo->prepare($query);
    $params = array(
        "id" => $id
    );
    $stmt->execute($params);
}


}


?>