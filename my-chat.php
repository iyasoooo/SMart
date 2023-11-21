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
$id_seller 	= $_SESSION["id_customer"];
$id_sell  	= (isset($_REQUEST['id_sell'])) ? trim($_REQUEST['id_sell']) : '0';
$id_customer= (isset($_REQUEST['id_customer'])) ? trim($_REQUEST['id_customer']) : '0';
$id_chat	= (isset($_REQUEST['id_chat'])) ? trim($_REQUEST['id_chat']) : '0';
$act 		= (isset($_REQUEST['act'])) ? trim($_REQUEST['act']) : '';	

$status		= (isset($_POST['status'])) ? trim($_POST['status']) : '';
$remark		= (isset($_POST['remark'])) ? trim($_POST['remark']) : '';

$success = "";


if($act == "edit")
{	
	$SQL_update = " UPDATE `chat` SET `status` = '$status', `remark` = '$remark'  WHERE `id_chat` =  '$id_chat'";	
										
	$result = mysqli_query($con, $SQL_update) or die("Error in query: ".$SQL_update."<br />".mysqli_error($con));
		
	$success = "Successfully Update";
	//print "<script>alert('Successfully Update'); self.location='a-chat.php';</script>";
}

if($act == "del")
{
	$SQL_delete = " DELETE FROM `chat` WHERE `id_seller` =  '$id_sell' AND `id_customer` = $id_customer";
	$result = mysqli_query($con, $SQL_delete);
	
	$success = "Successfully Delete";
	//print "<script>self.location='a-chat.php';</script>";
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
//if($success) { Notify("success", $success, "a-chat.php"); }
?>	

<div class="" >

	
	<div class=" w3-center w3-text-blank">
		<span class="w3-xlarge"><b>CHAT</b></span><br>
	</div>


	<!-- Page Container -->
	<div class="w3-container w3-content" style="max-width:1400px;">    
	  <!-- The Grid -->
	  <div class="w3-row">
	  		
		<div class="">


			<?PHP
			$bil = 0;
			$SQL_list = "SELECT * FROM `chat`,`customer` WHERE chat.id_customer = customer.id_customer AND chat.id_customer AND chat.id_seller = $id_seller GROUP BY chat.id_customer";
			$result = mysqli_query($con, $SQL_list) ;
			while ( $data	= mysqli_fetch_array($result) )
			{
				$bil++;				
				$id_chat	= $data["id_chat"];
				$chat		= $data["chat"];
				$name		= $data["name"];
				$id_customer= $data["id_customer"];
				$id_seller	= $data["id_seller"];
			?>
			<div class="w3-card w3-center w3-white w3-padding">
				<div class="w3-large"><b><?PHP echo $data["name"]; ?></b></div>
				<hr>							
				<a href="chat-seller.php?id_customer=<?PHP echo $id_customer;?>&id_seller=<?PHP echo $id_seller;?>" class="w3-button w3-black w3-round-xlarge "><i class="fa fa-fw fa-comment fa-lg"></i>  Reply</a>
				<a title="Delete" onclick="document.getElementById('idDelete<?PHP echo $bil;?>').style.display='block'" class="w3-button w3-round-xlarge w3-red"><i class="fa fa-fw fa-trash fa-lg"></i> Delete</a>
			</div>
			<div class="w3-padding"></div>
			
			
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
			Are you sure to reset all this chat history ?
			<div class="w3-padding-16"></div>
			
			<input type="hidden" name="id_chat" value="<?PHP echo $data["id_chat"];?>" >
			<input type="hidden" name="id_customer" value="<?PHP echo $data["id_customer"];?>" >
			<input type="hidden" name="id_sell" value="<?PHP echo $data["id_seller"];?>" >
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
