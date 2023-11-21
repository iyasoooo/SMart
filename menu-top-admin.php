<!-- Menu top -->
<div class="w3-topx w3-card w3-white">
  <div class="w3-bar" id="myNavbar">
	<span class=" w3-hide-large  w3-hide-medium">
	&nbsp;<a href="a-main.php" class="w3-bar-item"><img src="images/logo.png" style="height:40px"></a>
    </span>

    <!-- Hide right-floated links on small screens and replace them with a menu icon -->
	<a href="javascript:void(0)" class="w3-bar-item1 w3-button w3-right w3-hide-large w3-hide-medium" onclick="w3_open()">
      <i class="fa fa-bars"></i>
    </a>

  </div>
</div>

<!-- Sidebar on small screens when clicking the menu icon -->
<nav class="w3-sidebar w3-bar-block w3-white w3-card w3-animate-left w3-hide-medium w3-hide-large" style="display:none" id="mySidebar">
	<a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-large w3-padding-16">Close ×</a>

	<?PHP if(isset($_SESSION["id_admin"])) { ?>
	<a href="a-main.php" class="w3-bar-item w3-button">DASHBOARD</a>	
	<a href="a-product.php" class="w3-bar-item w3-button">PRODUCT</a>  
	<a href="a-category.php" class="w3-bar-item w3-button">CATEGORY</a> 
	<a href="a-user.php" class="w3-bar-item w3-button">USER</a>  	
	<a href="a-profile.php" class="w3-bar-item w3-button">PROFILE</a>
	<a href="a-sign-out.php" class="w3-bar-item w3-button">LOGOUT</a>
	<?PHP } ?>
</nav>
<!-- Menu top -->