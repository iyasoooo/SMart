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
$id_customer= $_SESSION["id_customer"];
$quantity= (isset($_POST['quantity'])) ? trim($_POST['quantity']) : '1';

$success = "";

$SQL_c 	= " SELECT * FROM `customer` WHERE `id_customer` =  '". $_SESSION["id_customer"] ."'";
$rst_c 	= mysqli_query($con, $SQL_c);
$data_c	= mysqli_fetch_array($rst_c);
$name 	= $data_c["name"];
$address= $data_c["address"];
$phone	= $data_c["phone"];

$bil=0;

$delivery	= (isset($_REQUEST['delivery'])) ? trim($_REQUEST['delivery']) : 'Standard Delivery';
$id_product	= (isset($_REQUEST['id_product'])) ? trim($_REQUEST['id_product']) : '0';

$SQL_list = "SELECT * FROM `product` WHERE `id_product` = $id_product";
$result = mysqli_query($con, $SQL_list) ;
$data	= mysqli_fetch_array($result);
$id_seller = $data["id_customer"];

$price	= $data["price"];
$photo	= $data["photo"];
if(!$photo) $photo = "noimage.jpg";
$id_product= $data["id_product"];

// owner product
$sql_o 	= " SELECT * FROM `customer` WHERE `id_customer` =  '$id_seller'";
$rst_o 	= mysqli_query($con, $sql_o);
$data_o	= mysqli_fetch_array($rst_o);
$bank 	= $data_o["bank"];
$acc_name= $data_o["acc_name"];
$acc_no	= $data_o["acc_no"];

$delivery_charge = 0;

if($delivery == "Standard Delivery") $delivery_charge = 5;

$total = $price * $quantity;
$total = $total + $delivery_charge;
$total = number_format($total,2);
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

<div class="w3-padding-48"></div>

<div class="" >

	<div class="w3-container w3-paddingx" id="contact">
		<div class="w3-content w3-containerx " style="max-width:600px">
			
			<form action="" method="post" >
			<div class="w3-row">
				
				<div class="w3-card w3-white w3-padding w3-padding-16 w3-round">
				
				<div class="w3-xlarge"><b>ORDER DETAIL</b></div>
					<hr>
					
					<div class="w3-row" >
						<div class="w3-col s4" >
						Item : 
						</div>
						<div class="w3-col s8" >
						<?PHP echo $data["product"]; ?>
						</div>
					</div>
					<div class="w3-row" >
						<div class="w3-col s4" >
						Price : 
						</div>
						<div class="w3-col s8" >
						RM  <?PHP echo $data["price"]; ?>
						</div>
					</div>
					<div class="w3-row" >
						<div class="w3-col s4" >
						Quantity :
						</div>
						<div class="w3-col s8" >						
						<select class="w3-padding w3-border w3-round" name="quantity" required>
							<option value="1" <?PHP if($quantity == "1") echo "selected";?> >1</option>
							<option value="2" <?PHP if($quantity == "2") echo "selected";?> >2</option>
							<option value="3" <?PHP if($quantity == "3") echo "selected";?> >3</option>
							<option value="4" <?PHP if($quantity == "4") echo "selected";?> >4</option>
							<option value="5" <?PHP if($quantity == "5") echo "selected";?> >5</option>
							<option value="6" <?PHP if($quantity == "6") echo "selected";?> >6</option>
							<option value="7" <?PHP if($quantity == "7") echo "selected";?> >7</option>
							<option value="8" <?PHP if($quantity == "8") echo "selected";?> >8</option>
							<option value="9" <?PHP if($quantity == "9") echo "selected";?> >9</option>
							<option value="10" <?PHP if($quantity == "10") echo "selected";?> >10</option>
						</select>
						</div>
					</div>
					
					<div class="w3-row" >
						<div class="w3-col s4" >
						Delivery :
						</div>
						<div class="w3-col s8" >						
						<select class="w3-select w3-border w3-round" name="delivery" required>
							<option value="Standard Delivery" <?PHP if($delivery == "Standard Delivery") echo "selected";?> >Standard Delivery</option>
							<option value="Pick up at UPTM" <?PHP if($delivery == "Pick up at UPTM") echo "selected";?> >Pick up at UPTM</option>
						</select>
						</div>
					</div>
					
					<div class="w3-row" >
						<div class="w3-col s4" >
						Del.Charge : 
						</div>
						<div class="w3-col s8" >
						<b>RM  <?PHP echo number_format($delivery_charge,2); ?></b>
						</div>
					</div>
					
					<div class="w3-row" >
						<div class="w3-col s4" >
						Total : 
						</div>
						<div class="w3-col s8" >
						<b>RM  <?PHP echo $total; ?></b>
						</div>
					</div>
					<div class="w3-padding-16" >
						<input name="act" type="hidden" value="update">
						<button type="submit" class="w3-button w3-black w3-text-white w3-round w3-small">Update</button>
					</div>
				</div>			
			</div>
			</form>
			
			<div class="w3-row">
				
				<?PHP if($delivery == "Standard Delivery") { ?>
				<div class="w3-padding-16"></div>
				<div class="w3-card w3-white w3-paddingx  w3-round">
					<div class="w3-padding">
						<p>Delivery Address</p>
						<div class="w3-pale-red w3-padding w3-border w3-border-red">notes: delivery on Cheras area only</div>
						<div class="w3-border w3-padding w3-round">
						<p><?PHP echo $data_c["name"]; ?></p>
						<p><?PHP echo $data_c["address"]; ?></p>
						<p>Phone : <?PHP echo $data_c["phone"]; ?></p>
						</div>
						<a href="profile.php" class="w3-button w3-padding-16"><i class="fa fa-fw fa-user-secret"></i> Update profile </a>
					</div>					
				</div>
				<?PHP } ?>
				
				<div class="w3-padding-16"></div>
				
				<form action="buy-complete.php" method="post" enctype="multipart/form-data" >
				<div class="w3-card w3-white w3-paddingx w3-padding-16 w3-round">
					<div class="w3-padding">  
						<p>Please make payment to the following account:</p>
						<div class="w3-sand">
						<table class="w3-table w3-bordered w3-border">
							<tr>
								<td>Bank</td>
								<td><?PHP echo $data_o["bank"];?></td>
							</tr>
							<tr>
								<td>Acc Name</td>
								<td><?PHP echo $data_o["acc_name"];?></td>
							</tr>
							<tr>
								<td>Acc No</td>
								<td><?PHP echo $data_o["acc_no"];?></td>
							</tr>
						</table>
						</div>
						<hr>
						
						<div class="w3-section" >
							Payment Date *
							<input class="w3-input w3-border w3-round" type="date" name="pay_date" value="" required>
						</div>
						
						<div class="w3-section" >
							Payment Time *
							<input class="w3-input w3-border w3-round" type="time" name="pay_time" value="" required>
						</div>
						
						<div class="w3-section" >
							Total Amount (RM)*
							<input class="w3-input w3-border w3-round" type="text" name="total" value="<?PHP echo $total;?>" required>
						</div>
						
						<div class="w3-section" >
							Payment Slip *
							<input class="w3-input w3-border w3-round" type="file" name="pay_slip" required >
							<small>  only JPEG, JPG, PNG or GIF allowed </small>
						</div>
						
						<hr>
							  
						<div class="w3-section" >
							<input name="delivery" type="hidden" value="<?PHP echo $delivery;?>">
							<input name="quantity" type="hidden" value="<?PHP echo $quantity;?>">
							<input name="id_product" type="hidden" value="<?PHP echo $id_product;?>">
							<input name="act" type="hidden" value="add">
							<button type="submit" class="w3-button w3-block w3-black w3-text-white w3-round"><i class="fa fa-fw fa-shopping-cart"></i> SUBMIT PAYMENT APPROVAL</button>
						</div>
					</div> 
				</div>
				</form>
			</div>
			
			
		</div>
	</div>

<div class="w3-padding-48"></div>	
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