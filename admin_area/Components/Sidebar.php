
  <!--header area end-->
    <!--mobile navigation bar start-->
    <div class="mobile_nav">
      <div class="nav_bar">
        <img src="images/justin.jpg" class="mobile_profile_image" alt="">
        <i class="fa fa-bars nav_btn"></i>
      </div>
      <div class="mobile_nav_items">
        <a href="index.php"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
        <a href='Viewquery.php'><i class="fas fa-cogs"></i><span>view Query</span></a>
        <a href="Viewuser.php"><i class="fas fa-table"></i><span>View user</span></a>
        <a href="EditAccount.php"><i class="fas fa-info-circle"></i><span>Edit Account</span></a>
        <a href="logout.php"><i class="fas fa-sliders-h"></i><span>Log out</span></a>
        
      </div>
    </div>
    <!--mobile navigation bar end-->
    <!--sidebar start-->
    <div class="sidebar">
      <div class="profile_info">
        <img src="images/justin.jpg" class="profile_image" alt="">
        <h4><?php

echo $_SESSION['admin_username'];
?>  
  </h4>
      </div>
      <a href="index.php"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
      <a href='Viewquery.php'><i class="fas fa-cogs"></i><span>View Query</span></a>
      <a href="Viewuser.php"><i class="fas fa-table"></i><span>View user</span></a>
      <a href="EditAccount.php"><i class="fas fa-info-circle"></i><span>Edit Account</span></a>
      <a href="logout.php"><i class="fas fa-sliders-h"></i><span>Log out</span></a>
    </div>
    <!--sidebar end-->