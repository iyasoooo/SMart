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
$id_chat	= (isset($_GET['id_chat'])) ? trim($_GET['id_chat']) : '0';
$id_customer= (isset($_REQUEST['id_customer'])) ? trim($_REQUEST['id_customer']) : '0';
$id_seller	= (isset($_REQUEST['id_seller'])) ? trim($_REQUEST['id_seller']) : '0';
$id_product	= (isset($_REQUEST['id_product'])) ? trim($_REQUEST['id_product']) : '0';
$act 		= (isset($_REQUEST['act'])) ? trim($_REQUEST['act']) : '';	

$chat		= (isset($_POST['chat'])) ? trim($_POST['chat']) : '';
$chat		=	mysqli_real_escape_string($con, $chat);

$success = "";

if($act == "add")
{	
	$SQL_insert = " 
	INSERT INTO `chat`(`id_chat`, `id_customer`, `id_seller`, `chat`, `created_by`, `created_date`) 
			VALUES (NULL,'$id_customer','$id_seller','$chat', '".$_SESSION["id_customer"]."', NOW())";
										
	$result = mysqli_query($con, $SQL_insert);
	
	$id_product = mysqli_insert_id($con);
		
	$success = "Successfully Add";
	
	print "<script>self.location='chat-seller.php?id_customer=".$id_customer."&id_seller=".$id_seller."';</script>";
}

if($act == "del")
{
	$SQL_delete = " DELETE FROM `chat` WHERE `id_chat` =  '$id_chat' ";
	$result = mysqli_query($con, $SQL_delete);
	
	$success = "Successfully Delete";
	print "<script>self.location='chat-seller.php?id_customer=".$id_customer."&id_seller=".$id_seller."';</script>";
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

<!--- Toast Notification -->
<?PHP 
//if($success) { Notify("success", $success, "profile.php"); }
?>

<div class="" >

	<div class="w3-containerx w3-paddingx" id="contact">
		<div class="w3-contentx w3-container" style="max-width:600px">
		
		
			<div class="w3-center">
			<div class="w3-xlarge"><b>CHAT</b></div>
			</div>
			<div class="w3-padding"></div>
			
			<?PHP
			$bil = 0;
			$SQL_list = "SELECT * FROM `chat`,`customer` WHERE chat.id_customer = customer.id_customer AND chat.id_customer = $id_customer AND chat.id_seller = $id_seller";
			$result = mysqli_query($con, $SQL_list) ;
			while ( $data	= mysqli_fetch_array($result) )
			{
				$bil++;
				$id_chat	= $data["id_chat"];
				$name	= $data["name"];
				$chat	= $data["chat"];
				$created_by	= $data["created_by"];
				if($created_by == $_SESSION["id_customer"]){
					$color = "w3-pale-blue w3-border-blue w3-margin-right";
					$by = "You";
				}else{
					$color = "w3-pale-yellow w3-border-amber w3-margin-left";
					$by = $name;
				}
			?>
			<div class="<?PHP echo $color; ?> w3-border w3-padding-small w3-round ">	
				<?PHP if($created_by == $_SESSION["id_customer"]){ ?>
				<div class="w3-right"><a href="?act=del&id_customer=<?PHP echo $id_customer;?>&id_seller=<?PHP echo $id_seller;?>&id_chat=<?PHP echo $id_chat;?>"><i class="fa fa-trash"></i></a></div>
				<?PHP } ?>
				<div class="w3-small"><?PHP echo $by;?></div>
				<?PHP echo $chat;?>
			</div>
			<div class="w3-padding-small"></div>
			<?PHP } ?>
		
		</div>
	</div>

<div class="w3-padding-16"></div>	
</div>

<div class="w3-bottom">
	<div class="w3-card w3-white w3-paddingx w3-padding-small w3-round">	
		<div class="w3-row">

		<form action="" method="post">
			<div class="w3-padding">
				<textarea class="w3-input w3-border w3-round" rows="2" name="chat" required></textarea>
				<div class="w3-padding-small"></div>
				<input type="hidden" name="id_customer" value="<?PHP echo $id_customer;?>" >
				<input type="hidden" name="id_seller" value="<?PHP echo $id_seller;?>" >
				<input type="hidden" name="act" value="add" >
				<button type="submit" class="w3-button w3-black w3-block w3-text-white w3-margin-bottom w3-round"><i class="fa fa-fw fa-reply"></i> SEND MESSAGE</button>
		  </div>
		</form>	
	
		</div>
	</div>
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