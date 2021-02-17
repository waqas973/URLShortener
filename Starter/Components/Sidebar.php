
  <!--header area end-->
    <!--mobile navigation bar start-->
    <div class="mobile_nav">
      <div class="nav_bar">
        <img src="images/justin.jpg" class="mobile_profile_image" alt="">
        <i class="fa fa-bars nav_btn"></i>
      </div>
      <div class="mobile_nav_items">
        <a href="index.php"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
        <a href="Createlink.php"><i class="fas fa-cogs"></i><span>Create Links</span></a>
        <a href="Viewlink.php"><i class="fas fa-table"></i><span>View Links</span></a>
    
        <a href="EditAccount.php"><i class="fas fa-info-circle"></i><span>Edit Account</span></a>
       
        <a href="DeleteAccount.php"><i class="fas fa-sliders-h"></i><span>Delete Account</span></a>
        <a href="logout.php"><i class="fas fa-sliders-h"></i><span>Log out</span></a>
        
      </div>
    </div>
    <!--mobile navigation bar end-->
    <!--sidebar start-->
    <div class="sidebar">
      <div class="profile_info">
        <img class='d-none' src="images/justin.jpg" class="profile_image" alt="">
        <h4><?php

echo $_SESSION['username'];
?>  
  </h4>
      </div>
      <a href="index.php"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
      <a href="Createlink.php"><i class="fas fa-cogs"></i><span>Create Links</span></a>
      <a href="Viewlink.php"><i class="fas fa-table"></i><span>View Links</span></a>
    
      <a href="EditAccount.php"><i class="fas fa-info-circle"></i><span>Edit Account</span></a>
      <a href="DeleteAccount.php"><i class="fas fa-sliders-h"></i><span>Delete Account</span></a>
      <a href="logout.php"><i class="fas fa-sliders-h"></i><span>Log out</span></a>
    </div>
    <!--sidebar end-->