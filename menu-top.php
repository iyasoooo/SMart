<?PHP 
require_once("database.php");
include("login-pop.php");
?>	
<!-- Menu top -->
<div class="w3-top w3-content w3-card w3-white" style="max-width:600px">
  <div class="w3-bar" id="myNavbar">
	<span class=" w3-hide-large w3-hide-medium">
	&nbsp;<a href="index.php" class="w3-bar-item"><img src="images/logo.png" style="height:40px"></a>
    </span>

    <!-- Hide right-floated links on small screens and replace them with a menu icon -->
	<a href="javascript:void(0)" class="w3-bar-item1 w3-button w3-right w3-hide-large w3-hide-medium" onclick="w3_open()">
      <i class="fa fa-bars"></i>
    </a>

  </div>
</div>

<!-- Sidebar on small screens when clicking the menu icon -->
<nav class="w3-sidebar w3-bar-block w3-red w3-card w3-animate-left w3-hide-medium w3-hide-large" style="display:none" id="mySidebar">
	<a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-large w3-padding-16">Close ×</a>

	<a href="index.php" onclick="w3_close()" class="w3-bar-item w3-button">HOME</a>
	<a href="about.php" onclick="w3_close()" class="w3-bar-item w3-button">ABOUT</a>
	<a href="product.php" onclick="w3_close()" class="w3-bar-item w3-button">PRODUCT</a>		
	<?PHP if(!isset($_SESSION["id_customer"])) { ?>
	<a href="#" onclick="document.getElementById('idLogin').style.display='block'" class="w3-bar-item w3-button">LOGIN</a>
	<?PHP } ?>
		
	<?PHP if(isset($_SESSION["id_customer"])) { ?>
	<a href="order.php" class="w3-bar-item w3-button">ORDER HISTORY</a>
	<a href="profile.php" class="w3-bar-item w3-button">PROFILE</a>
	<a href="password.php" class="w3-bar-item w3-button">CHANGE PASSWORD</a>
	<div class="w3-black">
	<span class="w3-padding w3-small ">- SELLER -</span>

	<a href="my-sembang.php" class="w3-bar-item w3-button">MANAGE CHAT</a>
	<a href="my-order.php" class="w3-bar-item w3-button">MANAGE ORDER</a>
	<a href="my-product.php" class="w3-bar-item w3-button">MANAGE PRODUCT</a>
	</div>
	
	
	<a href="sign-out.php" class="w3-bar-item w3-button">LOGOUT</a>
	<?PHP } ?>
	
	<?PHP if((!isset($_SESSION["id_admin"]))&&(!isset($_SESSION["id_customer"]))) { ?>
	<hr style="margin: 0 0px 0 0px">
	<a href="admin.php" onclick="w3_close()" class="w3-bar-item w3-button">LOGIN ADMIN</a>	
	<?PHP } ?>	
	
	<a href="manual.php" onclick="w3_close()" class="w3-bar-item w3-button">USER MANUAL</a>	

</nav>
<!-- Menu top -->

<!-- Menu Footer -->
<?PHP if(isset($_SESSION["id_customer"])) { ?>
<div class="w3-containerx w3-bottom" id="contact" >
    <div class="w3-card w3-content w3-containerx w3-padding-small w3-text-red w3-white w3-center" style="max-width:600px">

	<div class="w3-row w3-small" style="line-height: 1.3;">
		<div class="w3-col" style="width:20%">
			<a href="index.php" class="w3-button w3-hover-black w3-padding-small">
				<i class="fa fa-home fa-3x"></i><br>
				HOME
			</a>
		</div>
		<div class="w3-col" style="width:20%">
			<a href="my-sembang.php" class="w3-button w3-hover-black w3-padding-small">
				<i class="fa fa-comment fa-3x"></i><br>
				CHAT
			</a>
		</div>
		<div class="w3-col" style="width:20%">
			<a href="my-order.php" class="w3-button w3-hover-black w3-padding-small">
				<i class="fa fa-shopping-cart fa-3x"></i><br>
				ORDER
			</a>
		</div>
		<div class="w3-col" style="width:20%">
			<a href="my-product.php" class="w3-button w3-hover-black w3-padding-small">
				<i class="fa fa-cube fa-3x"></i><br>
				PRODUCT
			</a>
		</div>
		<div class="w3-col" style="width:20%">
			<a href="profile.php" class="w3-button w3-hover-black w3-padding-small">
				<i class="fa fa-user-circle fa-3x"></i><br>
				PROFILE
			</a>
		</div>
	</div>
	
	</div>
</div>
<?PHP } ?>
<!-- Menu Footer End -->