<?php

require_once 'Components/dbConnection.php';
require_once "ShortenerClass.php";

$msg= "";
$Created_url = "";
$query_msg= "";

if(isset($_POST['submit_query'])){
  $name = $_POST['name'];
  $email = $_POST['email'];
  $query = $_POST['query'];

  $sql =  "insert into query_report(name, email,query,admin_answer,status) values(:name, :email,:query,:admin_answer,:status)";

  $stmt =   $conn->prepare($sql);

  $params =  array(
        "name"=>$name,
        "email"=>$email,
        "query"=>$query,
        "admin_answer"=>"N/A",
        "status"=>1
  );

  $stmt->execute($params);

  if($stmt->rowCount() > 0){
    echo "<script>alert('Query sumbited successfully')</script>";
   echo "<script>location.href='index.php'</script>" ;
  }
  
}

if(isset($_POST['url_submit'])){
 

$url = $_POST['url'];
$short = new shotener($conn);


$long_Url = $url;

// $shortURL_Prefix = 'https://xyz.com/'; // with URL rewrite
$shortURL_Prefix = 'http://localhost/fyp_project/'; // without URL rewrite


try{
    
   $shortCode =  $short->UrlToshortCode($long_Url);

 $shortUrl =  $shortURL_Prefix.$shortCode;


      $Created_url = '<a href="'.$shortUrl.'"target="_blank">'.$shortUrl.'</a>';
    

}
catch(Exception $e){
  $msg = $e->getMessage();

      
}
}


 include "Components/header.php "; 
 include "Components/Navbar.php "; ?>

<div class="container-fluid m-0 p-0"><!-- fullScreen video start --> 
  <div class="video_parent"><!-- video-parent start -->

   <video autoplay muted loop playsinline id="bgvideo">
   <source src="Vidio/backvideo.mp4" type="video/mp4" />
  </video>

  <div class="overlay-video"></div>

  <div class=" box-input"><!--  center box start -->

  <div class="   Main_heading_video">
            Short Your Link In One Click
   </div>

   <div class="marque mt-3 mb-3"><!--  marque div start -->
   <marquee behavior="" direction="" ><h2 style="color:white" >Grow Your Business</h2></marquee>
   </div><!--  marque div end -->

   <form action="" method="post">
   <div class="input-group input-fd mb-3 "><!--  input start -->
  <input type="text" name="url" class="form-control py-4" />
 
  <button type="submit " name="url_submit" class="btn btn-primary " >Short it</button> 
</div><!-- input end -->
<span class="  text-center text-success font-weight-bold " style='background-color:white; font-size:2rem;'><?php echo $msg; ?></span>
</form>


<div class=" d-flex justify-content-center ">

<?php if($Created_url){  ?>
   <div class="copy_text d-flex align-items-center justify-content-center" id="copy_text" style="display:block;"><?php echo $Created_url; ?></div>
<?php } else{   ?>
  <div class="copy_text" id="copy_text" style="display:none;"></div>
<?php } ?>


   </div>

</div><!--  center box end -->

  </div><!--  video-parent end -->
</div><!-- fullScreen video end -->


<div class="container my-5"><!-- container start -->


<div class="row"><!--  card row start -->
    <div class="col-lg-4  mb-lg-0 mb-5 "><!--  col start -->
    <div class="step1">
      <i class="fas fa-link fa-3x"></i>
      <h5>TRANSFORM LENGTHY URLs</h5>
      <p>https://getbootstrap.com/docs/4.3/components/card/</p>
      <h2>1.</h2>
    </div>
  
    </div><!--  col end -->

    <div class="col-lg-4  mb-lg-0 mb-5"><!--  col start -->
    <div class="step2">
    <i class="fas fa-paper-plane fa-3x"></i>
      <h5>into SHORT & BRANDED URLs</h5>
      <p>https://brandXYZ.me/iPhone</p>
      <h2>2.</h2>
    </div>
    </div><!--  col end -->

    <div class="col-lg-4"><!--  col start -->
    <div class="step3">
    <i class="fas fa-chart-line fa-3x"></i>
      <h5>and TRACK EVERYTHING</h5>
      <p>Track every click on yearly, monthly, and
daily basis.</p>
      <h2>3.</h2>
    </div>
    </div><!--  col end -->

  </div><!--  card row end -->

</div><!-- container end -->

<div class="feature_div d-flex justify-content-center align-items-center"><!-- feature div start -->
    
     <h2 class="feature_heading"> Features </h2>
  
</div><!-- feature div end -->

<div class="container my-5"><!--container start-->
  <div class="row feature_row"><!--row start-->

    <div class="col-lg-6 feature_col1"><!--col-6 start-->
    <h3 class="feature_head">  Monitor your link performance.</h3>
    <hr />
    <p class="feature_para">Full analytics for individual links and link groups, including geo and device information, referrers, browser, ip and more.</p>
    </div><!--col-6 end-->
     
    <div class="col-lg-6 feature_img1"><!--col-6 start-->
      <img class="img-fluid" src="images/stats.png " />
      </div><!--col-6 end-->

  </div><!--row end-->

  <div class="row feature_row"><!--row start-->

      <div class="col-lg-6 feature_img2"><!--col-6 start-->
      <img class="img-fluid" src="images/dashboard.png " />
      </div><!--col-6 end-->

    <div class="col-lg-6 feature_col2"><!--col-6 start-->
    <h3 class="feature_head">  Monitor your link performance.</h3>
    <hr />
    <p class="feature_para">Full analytics for individual links and link groups, including geo and device information, referrers, browser, ip and more.</p>
    </div><!--col-6 end-->
       
  </div><!--row end-->
  <div class="more_feature_btn text-center"><a href="MoreFeature.php" class="btn btn-outline-danger rounded-pill">More Feature</a></div>

  <section class="stats_sec  my-5">
    <h2 class="text-center my-3">Statistics</h2>
    <div class="flx_box_feature ">
  <?php 
  $sql =  "select sum(hits) as hits ,count(id) as id from short_urls  ";
  $stmt =   $conn->prepare($sql);
  $stmt->execute();
  $result= $stmt->fetch(PDO::FETCH_ASSOC);
  $hits = $result['hits'];
  $id  = $result['id'];
  
  ?>
    <div class="text-center border border-dark text-white bg-dark rounded tot_cl">
      <h4> Total  Clicks</h4>
       <h3><?php if(isset($hits)){ echo $hits ; 
       ?>
       </h3>
   <?php   } else{ ?>
        <h3>0</h3>
      <?php }  ?> 
   </div>
   <div class=" text-center border border-dark text-white bg-dark rounded tot_cl">
      <h4> Total Url Created</h4>
      <h3><?php if(isset($id)){ echo $id ; 
       ?>
       </h3>
   <?php   } else{ ?>
        <h3>0</h3>
      <?php }  ?> 
   </div>

   <?php 
  $sql =  "select count(customer_id) as id from customers  ";
  $stmt =   $conn->prepare($sql);
  $stmt->execute();
  $result= $stmt->fetch(PDO::FETCH_ASSOC);
  $id  = $result['id'];
  
  ?>
   <div class=" text-center border border-dark text-white bg-dark rounded tot_cl">
      <h4> Register Users</h4>
      <h3><?php if(isset($id)){ echo $id ; 
       ?>
       </h3>
   <?php   } else{ ?>
        <h3>0</h3>
      <?php }  ?> 
   </div>

    </div>
    
  </section>
</div><!--container end-->

<section class="contact_section"><!-- contatc section -->
  <div class=" font-weight-bold text-center contact_heading">Contact Us </div>
   <div class="container  py-3">
     <div class="row">
       <div class="col-md-9 mx-auto">
<form method='post'>
       <div class="form-group">
  <label for="usr">Name:</label>
  <input type="text" name='name' class="form-control" id="usr" required>
</div>
<div class="form-group">
  <label for="email">Email:</label>
  <input type="email" name='email' class="form-control" id="email" required>
</div>
<div class="form-group">
  <label for="comment">Query:</label>
  <textarea class="form-control" name='query' rows="5" id="comment" required></textarea>
</div>

<div class="more_feature_btn text-center"><button class="btn btn-outline-danger rounded-pill " type='submit' name='submit_query'>Submit</button></div>
</form>
       </div>
     </div>

   </div>
</section><!-- contatct section  end -->

<section class="price_Plan my-5">
  <div class="plan_content"><!-- plan_div start -->
    <h3>Plans </h3>
   <p>Simple pricing plans for everyone and every budget.</p>
  </div><!-- plan_div start -->

    <div class="container py-4">
     <div class="row"><!-- row start -->
          <div class="col-md-4 mb-md-0 mb-5"><!-- col-4 start -->
          <div class="card" >
           <div class="card-body">
            <h5 class="card-title">STARTER</h5>
            <hr />
             <p class="card-text">For startup businesses that are testing the waters.</p>
               </div>
             </div>

          </div><!-- col-4 end -->
         <div class="col-md-4 mb-md-0 mb-5"><!-- col-4 start -->
         <div class="card" >
           <div class="card-body">
            <h5 class="card-title">BUSINESS</h5>
            <hr />
             <p class="card-text">For small businesses that are looking to know their audience better.</p>
               </div>
             </div>
         </div><!-- col-4 end -->
         <div class="col-md-4 "><!-- col-4 start -->
         <div class="card" >
           <div class="card-body">
            <h5 class="card-title">ENTERPRISE</h5>
            <hr />
             <p class="card-text">For agile businesses that are looking for in-depth analytics.</p>
               </div>
             </div>
         </div><!-- col-4 end -->

     </div><!-- row end -->
     <div class=" text-center  btn-price-div">
     <a class="btn btn-primary mt-4" href="Price.php">View Prices</a>
     </div>
    
    </div>
</section>
<!-- <script >


var v =document.getElementById('copy_text').style.display="block";
console.log(v);
</script> -->

   <?php   include "Components/footer.php";
      include "Components/lastEnd.php"; ?>



