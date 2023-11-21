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
$id_customer = $_SESSION["id_customer"];
$id_order	= (isset($_REQUEST['id_order'])) ? trim($_REQUEST['id_order']) : '0';
$act 		= (isset($_REQUEST['act'])) ? trim($_REQUEST['act']) : '';	

$stat		= (isset($_REQUEST['stat'])) ? trim($_REQUEST['stat']) : 'Pending';
$status		= (isset($_POST['status'])) ? trim($_POST['status']) : '';
$remark		= (isset($_POST['remark'])) ? trim($_POST['remark']) : '';

$success = "";


if($act == "edit")
{	
	$SQL_update = " UPDATE `orders` SET `status` = '$status', `remark` = '$remark'  WHERE `id_order` =  '$id_order'";	
										
	$result = mysqli_query($con, $SQL_update) or die("Error in query: ".$SQL_update."<br />".mysqli_error($con));
		
	$success = "Successfully Update";
	//print "<script>alert('Successfully Update'); self.location='a-order.php';</script>";
}

if($act == "del")
{
	$SQL_delete = " DELETE FROM `orders` WHERE `id_order` =  '$id_order' ";
	$result = mysqli_query($con, $SQL_delete);
	
	$success = "Successfully Delete";
	//print "<script>self.location='a-order.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<title><?PHP echo $SHOP_NAME;?></title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link href="css/table.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />

<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Poppins", sans-serif}

body, html {
  height: 100%;
  line-height: 1.8;
}

a:link {
  text-decoration: none;
}

.w3-beige {background-color: rgba(237, 205, 172, 100); }

.w3-bar .w3-button {
  padding: 16px;
}
</style>

<body class="w3-light-gray">

<?PHP include("menu-top.php");?>

<div class="w3-padding-32"></div>

<div class="" >

<!--- Toast Notification -->
<?PHP 
if($success) { Notify("success", $success, "my-order.php"); }
?>	

<div class="" >

	
	<div class=" w3-center w3-text-blank">
		<span class="w3-xlarge"><b>ORDER LIST</b></span><br>
	</div>

	<div class="w3-container w3-content" style="max-width:600px;">    
		<a href="?stat=Pending" class="w3-tag w3-padding w3-round <?PHP if($stat == 'Pending') echo "w3-white";?>">Pending</a>
		<a href="?stat=All" class="w3-tag w3-padding w3-round <?PHP if($stat <> 'Pending') echo "w3-white";?>">All</a>	
	</div>
	
	<div class="w3-padding"></div>

	<!-- Page Container -->
	<div class="w3-container w3-content" style="max-width:600px;">    
	  <!-- The Grid -->
	  <div class="w3-row w3-whitex w3-cardx w3-paddingx">
	  		
		<div class="w3-row">

			<?PHP
			$sql_status = "";
			if($stat == 'Pending') $sql_status = "AND orders.status = 'Pending'";
			$bil = 0;
			$SQL_list = "SELECT * FROM `orders`,`customer` WHERE orders.id_customer = customer.id_customer AND orders.id_seller = $id_customer $sql_status";
			$result = mysqli_query($con, $SQL_list) ;
			while ( $data	= mysqli_fetch_array($result) )
			{
				$bil++;
				$pay_slip	= $data["pay_slip"];
				if(!$pay_slip) $pay_slip = "noimage.jpg";
				$id_order	= $data["id_order"];
			?>
			
			<div class="w3-card w3-white w3-padding">
				<div class="w3-xlarge">Order No : <b><?PHP echo $data["order_no"]; ?></b></div>
				<hr>							
				Order Detail :<br>
				<?PHP echo $data["order_detail"]; ?><br>				
				<hr>
				Customer : <?PHP echo $data["name"]; ?><br>
				Delivery : <?PHP echo $data["delivery"]; ?><br>
				Total Paid : RM <?PHP echo $data["total"]; ?><br>
				Pay Date : <?PHP echo $data["pay_date"]; ?><br>
				Pay Time : <?PHP echo $data["pay_time"]; ?><br>
				<a target="_blank" href="pay_slip/<?PHP echo $pay_slip; ?>" class="w3-tag w3-round w3-green">Payment Slip</a>				
				<?PHP if($data["delivery"] == "Standard Delivery") { ?>
				<hr>
				Delivery Address<br>
				<?PHP echo $data["address"]; ?>
				<?PHP } ?>
				<hr>
				Status : <?PHP echo $data["status"]; ?><br>						
				<hr>
				<div class="w3-center">
				<a href="#" onclick="document.getElementById('idEdit<?PHP echo $bil;?>').style.display='block'" class="w3-button w3-round-xlarge w3-blue"><i class="fa fa-fw fa-edit fa-lg"></i> Edit Status</a>				
				<a title="Delete" onclick="document.getElementById('idDelete<?PHP echo $bil;?>').style.display='block'" class="w3-button w3-round-xlarge w3-red"><i class="fa fa-fw fa-trash fa-lg"></i> Delete</a>
				</div>
			</div>
			
			<div class="w3-padding"></div>
			
<div id="idEdit<?PHP echo $bil; ?>" class="w3-modal" style="z-index:10;">
	<div class="w3-modal-content w3-round-large w3-card-4 w3-animate-zoom" style="max-width:600px">
      <header class="w3-container "> 
        <span onclick="document.getElementById('idEdit<?PHP echo $bil; ?>').style.display='none'" 
        class="w3-button w3-large w3-circle w3-display-topright "><i class="fa fa-fw fa-times"></i></span>
      </header>

		<div class="w3-container w3-padding">
		
		<form action="" method="post" >
			<div class="w3-padding"></div>
			<b class="w3-large">Update</b>
			<hr>
	
				<div class="w3-section " >
					<label>Status *</label>
					<select class="w3-input w3-border w3-round" name="status" required>
						<option value="Pending" <?PHP if($data["status"] == "Pending") echo "selected";?> >Pending</option>
						<option value="Paid" <?PHP if($data["status"] == "Paid") echo "selected";?> >Paid</option>
						<option value="Unpaid" <?PHP if($data["status"] == "Unpaid") echo "selected";?> >Unpaid</option>
						<option value="Preparing" <?PHP if($data["status"] == "Preparing") echo "selected";?> >Preparing</option>
						<option value="Delivered" <?PHP if($data["status"] == "Delivered") echo "selected";?> >Delivered</option>
						<option value="Refund" <?PHP if($data["status"] == "Refund") echo "selected";?> >Refund</option>
						<option value="Cancel" <?PHP if($data["status"] == "Cancel") echo "selected";?> >Cancel</option>
					</select>
				</div>
				
				<div class="w3-section " >
					Remark
					<textarea class="w3-input w3-border w3-round" rows="2" name="remark" placeholder="Tracking no"><?PHP echo $data["remark"];?></textarea>
				</div>
			  
			<hr class="w3-clear">
			<input type="hidden" name="id_order" value="<?PHP echo $data["id_order"];?>" >
			<input type="hidden" name="act" value="edit" >
			<button type="submit" class="w3-button w3-black w3-text-white w3-margin-bottom w3-round">SAVE CHANGES</button>

		</form>
		</div>
	</div>
<div class="w3-padding-24"></div>
</div>

<div id="idDelete<?PHP echo $bil; ?>" class="w3-modal" style="z-index:10;">
	<div class="w3-modal-content w3-round-large w3-card-4 w3-animate-zoom" style="max-width:500px">
      <header class="w3-container "> 
        <span onclick="document.getElementById('idDelete<?PHP echo $bil; ?>').style.display='none'" 
        class="w3-button w3-large w3-circle w3-display-topright "><i class="fa fa-fw fa-times"></i></span>
      </header>

		<div class="w3-container w3-padding">
		
		<form action="" method="post">
			<div class="w3-padding"></div>
			<b class="w3-large">Confirmation</b>
			  
			<hr class="w3-clear">			
			Are you sure to delete this record ?
			<div class="w3-padding-16"></div>
			
			<input type="hidden" name="id_order" value="<?PHP echo $data["id_order"];?>" >
			<input type="hidden" name="act" value="del" >
			<button type="button" onclick="document.getElementById('idDelete<?PHP echo $bil; ?>').style.display='none'"  class="w3-button w3-gray w3-text-white w3-margin-bottom w3-round">CANCEL</button>
			
			<button type="submit" class="w3-right w3-button w3-red w3-text-white w3-margin-bottom w3-round">YES, CONFIRM</button>
		</form>
		</div>
	</div>
</div>				
			<?PHP } ?>

		</div>

		
	  <!-- End Grid -->
	  </div>
	  
	<!-- End Page Container -->
	</div>
	
	<div class="w3-padding-48"></div>
	
</div>


<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
<!--<script src="assets/demo/datatables-demo.js"></script>-->


<script>
$(document).ready(function() {

  
	$('#dataTable').DataTable( {
		paging: true,
		
		searching: true
	} );
		
	
});
</script>

 
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
