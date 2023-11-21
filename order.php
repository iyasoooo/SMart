<?PHP
session_start();
include("database.php");
if( !verifyCustomer($con) ) 
{
	header( "Location: index.php" );
	return false;
}
?>
<?PHP
$id_customer	 = (isset($_SESSION['id_customer'])) ? trim($_SESSION['id_customer']) : '0';
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

<body class="w3-light-gray">

<?PHP include("menu-top.php");?>

<div class="w3-padding-32"></div>

<div class="" >

	<div class="w3-containerx " id="contact">
		<div class="w3-content w3-container " style="max-width:600px">

			<div class="w3-center">
			<div class="w3-xlarge"><b>ORDER HISTORY</b></div>
			</div>

			<div class="w3-row">
			<?PHP
			$bil = 0;
			$SQL_list = "SELECT * FROM `orders` WHERE `id_customer` = $id_customer";
			$result = mysqli_query($con, $SQL_list) ;
			while ( $data	= mysqli_fetch_array($result) )
			{
				$bil++;
				$id_order= $data["id_order"];
			?>

			<div class="w3-card w3-white w3-padding">
				<div class="w3-large">Order No : <b><?PHP echo $data["order_no"]; ?></b></div>
				<hr style="margin: 0 0px 0 0px">				
				<span class="w3-text-grey">Order Detail :</span><br>
				<?PHP echo $data["order_detail"]; ?><br>	
				<hr style="margin: 0 0px 0 0px">								
				<div class="w3-row">
					<div class="w3-col s4">Total : </div><div class="w3-col s8">RM <?PHP echo $data["total"]; ?></div>
					<div class="w3-col s4">Delivery : </div><div class="w3-col s8"><?PHP echo $data["delivery"]; ?></div>			
					<div class="w3-col s4">Status : </div><div class="w3-col s8"><?PHP echo $data["status"]; ?></div>
					<div class="w3-col s4">Remark :</div><div class="w3-col s8"> <?PHP echo $data["remark"]; ?></div>
				</div>
			</div>
			
			<div class="w3-padding"></div>

						
			<?PHP } ?>

				
				
			</div>
		  
		</div>
	</div>

<div class="w3-padding-16"></div>	
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