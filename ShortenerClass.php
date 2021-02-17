<?php 

 class shotener 
 {
     protected static $chars = "abcdfghjkmnpqrstvwxyz|ABCDFGHJKLMNPQRSTVWXYZ|0123456789";
     protected static $checkUrlExists = true;
     protected static $table = "guest_tab";
     protected static $codelength = 7;

    protected $pdo;
    protected $timestrump;
   function __construct($pdo){
           $this->pdo = $pdo;
           $this->timestrump = date("Y-m-d H:i:s");
      
   }

   public function UrlToshortCode($long_Url){
             if(empty($long_Url)){
                 throw new Exception("url is Empty");
             }
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
              $shortCode =  $this->CreateShortCode($long_Url);
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


         $sql = "select short_url from ".self::$table." where long_url=:long_url limit 1";
       $stmt =  $this->pdo->prepare($sql);
       $params = array(
           "long_url"=>$long_Url
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
             $sql =  "insert into ".self::$table."(long_url, short_url,created) values(:long_url, :short_url,:created)";

          $stmt =   $this->pdo->prepare($sql);

          $params =  array(
                "long_url"=>$long_Url,
                "short_url"=>$shortCode,
                "created"=>$this->timestrump
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