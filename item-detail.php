<?PHP
session_start();
require_once("database.php");
?>
<?PHP
$id_customer = (isset($_SESSION['id_customer'])) ? trim($_SESSION['id_customer']) : '0';
$id_product	= (isset($_REQUEST['id_product'])) ? trim($_REQUEST['id_product']) : '0';

$SQL_list = "SELECT * FROM `product` WHERE `id_product` = $id_product";
$result = mysqli_query($con, $SQL_list) ;
$data	= mysqli_fetch_array($result);

$id_seller	= $data["id_customer"];
$photo	= $data["photo"];
if(!$photo) $photo = "noimage.jpg";
$id_product= $data["id_product"];		
?>
<!DOCTYPE html>
<html>
<title><?PHP echo $SHOP_NAME;?></title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Poppins", sans-serif}

body, html {
  height: 100%;
  line-height: 1.8;
}

a:link {
  text-decoration: none;
}

.w3-bar .w3-button {
  padding: 16px;
}
</style>

<body class="w3-white">

<?PHP include("menu-top.php");?>

<div class="w3-padding-48"></div>

<div class="" >

	<div class="w3-container " id="contact">
		<div class="w3-content w3-container " style="max-width:500px">

			<div class="w3-row">
				
				<div class="w3-col m5">
					<div class="">
					<div class="w3-card w3-white w3-padding-small w3-paddingx w3-round-large">
					<img src="upload/<?PHP echo $photo;?>" class="w3-image w3-round-large">
					</div>
					</div>
				</div>
				
				<div class="w3-col m7 w3-padding-16">
					<div class="">
						<div class="w3-card w3-white w3-padding-16 w3-padding w3-round-large">
						<div class="w3-large"><b><?PHP echo $data["product"];?></b></div>
						<b class="w3-tag w3-small w3-blue"><?PHP echo $data["category"];?></b>
						<p>Price : RM <?PHP echo $data["price"];?></b></p>
						
						<p><?PHP echo $data["description"];?></b></p>

						<?PHP if(!isset($_SESSION["id_customer"])) { ?>
							<a  onclick="document.getElementById('idLogin').style.display='block'" class="w3-button w3-red w3-round w3-padding-16">ORDER NOW <i class="fa fa-fw fa-shopping-cart"></i></a>
						<?PHP 
						} 
						else 
						{ 
							if($data["id_customer"] <> $id_customer) {
						?>						
							<a href="cart.php?id_product=<?PHP echo $id_product;?>" class="w3-button w3-block w3-red w3-round w3-padding-16">ORDER NOW <i class="fa fa-fw fa-shopping-cart"></i></a>
						<?PHP 
							} else {
						?>						
							<a class="w3-disabled w3-button w3-block w3-red w3-round w3-padding-16">ORDER NOW <i class="fa fa-fw fa-shopping-cart"></i></a>
						<?PHP 		
							}
						} ?>
						</div>
					</div>
				</div>
				<?PHP if(isset($_SESSION["id_customer"])) { ?>
					<?PHP  if($data["id_customer"] <> $id_customer) { ?>
					<a href="sembang.php?id_seller=<?PHP echo $id_seller;?>&chat_intro=Saya berminat dengan <?PHP echo $data["product"];?>" class="w3-button w3-block w3-green w3-round-large"><i class="fa fa-fw fa-comment"></i> Chat to Seller</a>
					<?PHP } ?>
				<?PHP } else { ?>
				<a class="w3-button w3-disabled w3-block w3-green w3-round-large"><i class="fa fa-fw fa-comment"></i> Chat to Seller</a>
				<?PHP } ?>
			</div>
		  
		</div>
	</div>

<div class="w3-padding-48"><div>
	
</div>

 
<script>

// Toggle between showing and hiding the sidebar when clicking the menu icon
var mySidebar = document.getElementById("mySidebar");

function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
  } else {
    mySidebar.style.display = 'block';
  }
}

// Close the sidebar with the close button
function w3_close() {
    mySidebar.style.display = "none";
}
</script>

</body>
</html>