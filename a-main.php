<?PHP
session_start();

include("database.php");
if( !verifyAdmin($con) ) 
{
	header( "Location: index.php" );
	return false;
}
?>
<?PHP
$id_product	= (isset($_REQUEST['id_product'])) ? trim($_REQUEST['id_product']) : '0';
$act 		= (isset($_REQUEST['act'])) ? trim($_REQUEST['act']) : '';	
$status		= (isset($_REQUEST['status'])) ? trim($_REQUEST['status']) : 'Pending';	

$success = "";

if($act == "Approve")
{	
	$SQL_update = " UPDATE `product` SET `status` = 'Approve' WHERE `id_product` =  '$id_product'";											
	$result = mysqli_query($con, $SQL_update) or die("Error in query: ".$SQL_update."<br />".mysqli_error($con));	
	$success = "Successfully Update";
	print "<script>self.location='a-product.php';</script>";
}

if($act == "Reject")
{	
	$SQL_update = " UPDATE `product` SET `status` = 'Reject' WHERE `id_product` =  '$id_product'";											
	$result = mysqli_query($con, $SQL_update) or die("Error in query: ".$SQL_update."<br />".mysqli_error($con));	
	$success = "Successfully Update";
	print "<script>self.location='a-product.php';</script>";
}

if($act == "del")
{
	$SQL_delete = " DELETE FROM `product` WHERE `id_product` =  '$id_product' ";
	$result = mysqli_query($con, $SQL_delete);
	
	$success = "Successfully Delete";
	print "<script>self.location='a-product.php';</script>";
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

.w3-bar .w3-button {
  padding: 16px;
}
</style>

<body class="w3-blue w3-text-black">

<?PHP include("menu-top-admin.php");?>

<div class="" >


<!--- Toast Notification -->
<?PHP 
//if($success) { Notify("success", $success, "a-product.php"); }
?>	

<div class="" >

	
	<div class=" w3-center w3-text-blank w3-padding-32">
		<span class="w3-xlarge">
			<?PHP if($status=="Pending") {?>
			<b>PENDING PRODUCT</b>
			<?PHP } else {?>
			<b>PRODUCT LIST</b>
			<?PHP } ?>
		</span><br>
	</div>


	<!-- Page Container -->
	<div class="w3-container w3-content" style="max-width:600px;">    
	  <!-- The Grid -->
	  <div class="w3-row w3-white w3-productd w3-padding">	
		
		<hr>
		
		<div class="w3-row w3-margin ">
		<div class="table-responsive">
		<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
			<thead>
				<tr>
					<th>#</th>
					<th>Seller</th>
					<th>Phone</th>
					<th>Category</th>
					<th>Product</th>
					<th>Price</th>
					<th>Photo</th>
					<th>Status</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			<?PHP
			$sql_status = "";
			if($status == 'Pending') $sql_status = "AND product.status = 'Pending'";
			$bil = 0;
			$SQL_list = "SELECT * FROM `product`,`customer` WHERE product.id_customer = customer.id_customer $sql_status ";
			$result = mysqli_query($con, $SQL_list) ;
			while ( $data	= mysqli_fetch_array($result) )
			{
				$bil++;
				$photo	= $data["photo"];
				if(!$photo) $photo = "noimage.jpg";
				$id_product= $data["id_product"];
				$product= $data["product"];
			?>			
			<tr>
				<td><?PHP echo $bil ;?></td>
				<td><?PHP echo $data["name"] ;?></td>
				<td><?PHP echo $data["phone"] ;?></td>
				<td><?PHP echo $data["category"] ;?></td>
				<td><?PHP echo $data["product"] ;?></td>
				<td><?PHP echo $data["price"] ;?></td>				
				<td><img src="upload/<?PHP echo $photo ;?>" height="40px"></td>
				<td><?PHP echo $data["status"] ;?></td>
				<td>				
				<a href="?act=Approve&id_product=<?PHP echo $id_product;?>" class="w3-button w3-green w3-round">Approve</a>
				<a href="?act=Reject&id_product=<?PHP echo $id_product;?>" class="w3-button w3-red w3-round">Reject</a>
				</td>
			</tr>				
			<?PHP } ?>
			</tbody>
		</table>
		</div>
		</div>

		
	  <!-- End Grid -->
	  </div>
	  
	<!-- End Page Container -->
	</div>
	
	<div class="w3-padding-24"></div>
	
</div>



<div id="add01" class="w3-modal" >
    <div class="w3-modal-content w3-round-large w3-productd-4 w3-animate-zoom" style="max-width:600px">
      <header class="w3-container "> 
        <span onclick="document.getElementById('add01').style.display='none'" 
        class="w3-button w3-large w3-circle w3-display-topright "><i class="fa fa-fw fa-times"></i></span>
      </header>
	  
      <div class="w3-container w3-padding">
		
		<form action="" method="post" enctype="multipart/form-data" >
			<div class="w3-padding"></div>
			<b class="w3-large">Add Category</b>
			<hr>

				<div class="w3-section" >
					Category *
					<input class="w3-input w3-border w3-round" type="text" name="product"  required>
				</div>
			  
			  <hr class="w3-clear">
			  
			  <div class="w3-section" >
				<input name="act" type="hidden" value="add">
				<button type="submit" class="w3-button w3-black w3-text-white w3-margin-bottom w3-round">SUBMIT</button>
			  </div>
			</div>  
		</form> 
         
      </div>
<div class="w3-padding-24"></div>
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
