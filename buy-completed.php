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
$order_no 	= (isset($_GET['order_no'])) ? trim($_GET['order_no']) : '';

$bil=0;


$SQL_list = "SELECT * FROM `orders` WHERE `order_no` = '$order_no'";
$result = mysqli_query($con, $SQL_list) ;
$data	= mysqli_fetch_array($result);

$success = "";

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?PHP echo $SHOP_NAME;?></title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link href="css/table.css" rel="stylesheet" />

<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Poppins", sans-serif}
.w3-bar-block .w3-bar-item {padding: 16px}

a:link {
  text-decoration: none;
}
</style>
</head>
<body class="w3-light-gray">

<!-- Side Navigation -->
<?PHP include("menu-top.php");?>


<div class="w3-padding-32"></div>

<div class="w3-container w3-content w3-xlarge w3-center" style="max-width:600px;"> Order Completed</div>
<div class="w3-container w3-content w3-center" style="max-width:600px;"> 
Thank you for your purchase.
</div>

	
<div class="w3-container">

	<!-- Page Container -->
	<div class="w3-container w3-content  w3-padding-16 " style="max-width:600px;">    
		<!-- The Grid -->
		<div class="">
	  
			<div class="w3-card w3-white w3-padding w3-padding-16">
				
				
				<div class="w3-xlarge">Order No : <b><?PHP echo $order_no;?></b></div>
				<hr>
								
				Order Detail :<br>
				<?PHP echo $data["order_detail"]; ?><br>				
				<hr>
				Delivery :	<?PHP echo $data["delivery"]; ?><br>
				Total Paid : RM <?PHP echo $data["total"]; ?><br>
				Pay Date : <?PHP echo $data["pay_date"]; ?><br>
				Pay Time : <?PHP echo $data["pay_time"]; ?><br>				
				 
			</div>
		
			
			<div class="w3-padding-16"></div>
			
			<div class="w3-center">
			<a href="index.php" class="w3-button w3-black w3-round">Continue Shopping</a>
			</div>
		<!-- End Grid -->
		</div>
	  
	<!-- End Page Container -->
	</div>
	
	
	

</div>
<!-- container end -->
	

<div class="w3-padding-24"></div>
     
</div>
<!-- Page content -->

 
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