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
$act 		= (isset($_REQUEST['act'])) ? trim($_REQUEST['act']) : '';	
$id_customer= (isset($_REQUEST['id_customer'])) ? trim($_REQUEST['id_customer']) : '';	

$password 	= (isset($_POST['password'])) ? trim($_POST['password']) : '';
$repassword = (isset($_POST['repassword'])) ? trim($_POST['repassword']) : '';
$copassword = (isset($_POST['copassword'])) ? trim($_POST['copassword']) : '';

$error_pass	= "";
$success = "";

if($act == "edit")
{
	if($password <> $_SESSION["password"])
		$error_pass .= "<p>Invalid current password</p>";
	
	if($repassword <> $copassword)
		$error_pass .= "<p>New password missmatch</p>";

	// Validate password strength
	$uppercase = preg_match('@[A-Z]@', $password);
	$lowercase = preg_match('@[a-z]@', $password);
	$number    = preg_match('@[0-9]@', $password);
	$specialChars = preg_match('@[^\w]@', $password);

	if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
		$error_pass .= '<p>Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.</p>';
	}
}

if(($act == "edit") && (!$error_pass))
{	
	$SQL_update = " UPDATE `customer` SET 
						`password` = '$password'
					WHERE `email` =  '". $_SESSION["email"] ."'";	
										
	$result = mysqli_query($con, $SQL_update) or die("Error in query: ".$SQL_update."<br />".mysqli_error($con));
	
	$success = "Successfully Update";
}

$SQL_view 	= " SELECT * FROM `customer` WHERE `email` =  '". $_SESSION["email"] ."'";
$result 	= mysqli_query($con, $SQL_view);
$data		= mysqli_fetch_array($result);
$name 		= $data["name"];
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

	<div class="w3-container w3-paddingx" id="contact">
		<div class="w3-content w3-container" style="max-width:600px">
		
		
			<div class="w3-center">
			<div class="w3-xlarge"><b>MANAGE PASSWORD</b></div>
			</div>
			
			<?PHP 
			if($success)
			{
				echo '<div class="w3-pale-green w3-padding w3-border w3-border-green">Successfully Update</div>';
			}
			?>
			
			<?PHP 
			if($error_pass)
			{
				echo '<div class="w3-pale-red w3-padding w3-border w3-border-red">'.$error_pass.'</div>';
			}
			?>
		
			<div class="w3-padding-16"></div>
			
		<div class="w3-card w3-white w3-paddingx w3-padding-16 w3-round">	
			<div class="w3-row">
			
			
			<form action="" method="post">
				<div class="w3-padding">
				<b class="w3-large">Update Password</b>
				<hr>

				<div class="w3-section " >
					Current Password
					<input class="w3-input w3-border w3-round" type="password" name="password" value="" placeholder="Enter Current Password" required>
				</div>
				
				<div class="w3-section " >
					New Password
					<input class="w3-input w3-border w3-round" type="password" name="repassword" value="" placeholder="Enter New Password" required>
				</div>
				
				<div class="w3-section " >
					Confirm Password
					<input class="w3-input w3-border w3-round" type="password" name="copassword" value="" placeholder="Confirm New Password" required>
				</div>

				<hr class="w3-clear">

				<input type="hidden" name="act" value="edit" >
				<button type="submit" class="w3-button w3-black w3-text-white w3-margin-bottom w3-round">SAVE CHANGES</button>

			  </div>
			</form>	
			
				
			</div>
		
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