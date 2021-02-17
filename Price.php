<?php include "Components/header.php "; ?>
<?php include "Components/Navbar.php "; ?>
<link rel="stylesheet" href="Css/price.css">

<div class="container py-5">
  
<div> <!--Start Followers cards area line-->
   <h2 class="mt-5 bg-warning py-3 text-center cnrround">Prices</h2>
</div> <!--END Followers cards area line-->

<div class="row mt-5"><!--Row Start-->

 <div class="col-lg-4 col-md-6 mb mb-4"><!--4 col Start-->
  <div class="card cardback cardcnr"><!--Card Start-->
    <div class="card-body text-center "><!--Card Body Start-->
      <h5 class="card-title">Starter</h5>
      <p class="card-text price_text">15 Short Url</p>
      <p class="card-text price_text">Temporary </p>
      <p class="card-text price_text">Random Alphbet Url</p>
      <p class="card-text price_text">One Month only</p>
      <div class="mb-5 dotcircle"> 
      <i class="fas fa-dot-circle " style =" color:pink"></i>
      <i class="fas fa-dot-circle " style =" color:pink"></i>
      <i class="fas fa-dot-circle " style =" color:pink"></i>
      <i class="fas fa-dot-circle " style =" color:pink"></i>
      <i class="fas fa-dot-circle " style =" color:pink"></i>
     </div>
      <a class="neweffect rounded-pill" href=""  onClick="requestFun(event,1);">
      <span></span>
       Buy Now
       </a>
  </div> <!--Card body END-->

    <div class="price_div"><h5 class="text-center " style="line-height:68px"> free</h5></div><!--Price div end-->

 </div><!--Card div END-->
</div><!--Col 4 div END-->

<div class="col-lg-4 col-md-6 mb mb-4"><!--4 col Start-->
  <div class="card cardback cardcnr"><!--Card Start-->
    <div class="card-body text-center"><!--Card Body Start-->
      <h5 class="card-title">Business</h5>
      <p class="card-text price_text">35 Short Url</p>
      <p class="card-text price_text">Temporary and Permanent Url</p>
      <p class="card-text price_text">Random Alphbet Url</p>
    
      <p class='font-weight-bold'  data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" style='cursor:pointer;'>
    See more 
</p>
      <div class="collapse" id="collapseExample">
      <p class="card-text price_text">Top Url</p>
      <p class="card-text price_text">Top browser</p>
      <p class="card-text price_text">Top Platform</p>
      <p class="card-text price_text">Only For One Month</p>
        </div>
      
      <div class="mb-5 dotcircle"> 
      <i class="fas fa-dot-circle " style =" color:pink"></i>
      <i class="fas fa-dot-circle " style =" color:pink"></i>
      <i class="fas fa-dot-circle " style =" color:pink"></i>
      <i class="fas fa-dot-circle " style =" color:pink"></i>
      <i class="fas fa-dot-circle " style =" color:pink"></i>
     </div>
      <a class="neweffect rounded-pill" href=""  onClick="requestFun(event,2);">
      <span></span>
       Buy Now
       </a>
  </div> <!--Card body END-->

    <div class="price_div"><h5 class="text-center " style="line-height:68px"> 100</h5></div><!--Price div end-->

 </div><!--Card div END-->
</div><!--Col 4 div END-->

<div class="col-lg-4 col-md-6 mb-4"><!--4 col Start-->
  <div class="card cardback cardcnr"><!--Card Start-->
    <div class="card-body text-center"><!--Card Body Start-->
      <h5 class="card-title">Enterprise</h5>
      <p class="card-text price_text">Unlimited Short Url</p>
      <p class="card-text price_text">Temporary and Permanent Url</p>
      <p class="card-text price_text">Random and Custom Alphbet Url</p>

      <p class='font-weight-bold'  data-toggle="collapse" data-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample1" style='cursor:pointer;'>
    See more 
</p>
      <div class="collapse" id="collapseExample1">
      <p class="card-text price_text">Top Url</p>
      <p class="card-text price_text">Lastest Comparion</p>
      <p class="card-text price_text">Top Countries</p>
      <p class="card-text price_text">Hide Url</p>
      <p class="card-text price_text">Top Peferrel Website</p>
      <p class="card-text price_text">Lastest Url Comparsion</p>
      <p class="card-text price_text">Top Browser</p>
      <p class="card-text price_text">Top Platform</p>
      <p class="card-text price_text">Top Os System</p>
      <p class="card-text price_text">Only For One Month</p>
        </div>
      
 
      <div class="mb-5 dotcircle"> 
      <i class="fas fa-dot-circle " style =" color:pink"></i>
      <i class="fas fa-dot-circle " style =" color:pink"></i>
      <i class="fas fa-dot-circle " style =" color:pink"></i>
      <i class="fas fa-dot-circle " style =" color:pink"></i>
      <i class="fas fa-dot-circle " style =" color:pink"></i>
     </div>
      <a class="neweffect rounded-pill" href=''  onClick="requestFun(event,3);">
    
       Buy Now
       </a>
  </div> <!--Card body END-->

    <div class="price_div"><h5 class="text-center " style="line-height:68px"> 200</h5></div><!--Price div end-->

 </div><!--Card div END-->
</div><!--Col 4 div END-->

</div>
</div>


<?php include "Components/footer.php"; ?>
<?php include "Components/lastEnd.php"; ?>
<script>
function requestFun(e,val){
e.preventDefault();
if(val == 3){
  location.href='signup.php';
}
else if(val == 2){
  location.href='signup.php';
}
else{
  location.href='Freesignup.php';
}

}

</script>