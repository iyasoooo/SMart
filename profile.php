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

$name 		= (isset($_POST['name'])) ? trim($_POST['name']) : '';
$email		= (isset($_POST['email'])) ? trim($_POST['email']) : '';
$phone 		= (isset($_POST['phone'])) ? trim($_POST['phone']) : '';
$address 	= (isset($_POST['address'])) ? trim($_POST['address']) : '';
$dob 		= (isset($_POST['dob'])) ? trim($_POST['dob']) : '';
$gender 	= (isset($_POST['gender'])) ? trim($_POST['gender']) : '';
$bank 		= (isset($_POST['bank'])) ? trim($_POST['bank']) : '';
$acc_name 	= (isset($_POST['acc_name'])) ? trim($_POST['acc_name']) : '';
$acc_no 	= (isset($_POST['acc_no'])) ? trim($_POST['acc_no']) : '';

$name		=	mysqli_real_escape_string($con, $name);
$address	=	mysqli_real_escape_string($con, $address);

$success = "";

if($act == "edit")
{	
	$SQL_update = " UPDATE `customer` SET 
						`name` = '$name',
						`email` = '$email',
						`phone` = '$phone',
						`address` = '$address',
						`dob` = '$dob',
						`gender` = '$gender',
						`bank` = '$bank',
						`acc_name` = '$acc_name',
						`acc_no` = '$acc_no'
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
if($success) { Notify("success", $success, "profile.php"); }
?>

<div class="" >

	<div class="w3-container w3-paddingx" id="contact">
		<div class="w3-content w3-container" style="max-width:600px">
				
			<div class="w3-center">
			<div class="w3-xlarge"><b>MY PROFILE</b></div>
			</div>			
			
		<div class="w3-card w3-white w3-paddingx w3-padding-16 w3-round">	
			<div class="w3-row">
			
			
			<form action="" method="post">
				<div class="w3-padding">
				<b class="w3-large">Update Profile</b>
				<hr>

				  <div class="w3-section " >
					Full Name
					<input class="w3-input w3-border w3-round" type="text" name="name" value="<?PHP echo $data["name"];?>" placeholder="First Name" required>
				  </div>
				  
				   <div class="w3-section " >
					Email
					<input class="w3-input w3-border w3-round" type="email" name="email" value="<?PHP echo $data["email"];?>" placeholder="Email" required>
				  </div>

				  <div class="w3-section " >
					Mobile Phone
					<input class="w3-input w3-border w3-round" type="text" name="phone" value="<?PHP echo $data["phone"];?>" placeholder="Contact No" required>
				  </div>
				  
				  <div class="w3-section " >
					Date of Birth
					<input class="w3-input w3-border w3-round" type="text" name="dob" value="<?PHP echo $data["dob"];?>" placeholder="" required>
				  </div>
				  
				  <div class="w3-section " >
					Gender
					<select class="w3-select w3-border w3-round" name="gender" required>
						<option value="Male" <?PHP  if($data["gender"] == "Male") echo "selected";?>>Male</option>
						<option value="Female" <?PHP  if($data["gender"] == "Female") echo "selected";?>>Female</option>
					</select>
				  </div>
				  
				  <div class="w3-section " >
					Address
					<textarea class="w3-input w3-border w3-round" rows="2" name="address" required><?PHP echo $data["address"];?></textarea>
				  </div>
				  
				  <hr>
				  
				  <div class="w3-section " >
					Bank
					<select class="w3-select w3-border w3-round" name="bank" required>
						<option value="Maybank" <?PHP  if($data["bank"] == "Maybank") echo "selected";?>>Maybank</option>
						<option value="CIMB Bank" <?PHP  if($data["bank"] == "CIMB Bank") echo "selected";?>>CIMB Bank</option>
						<option value="Public Bank Berhad" <?PHP  if($data["bank"] == "Public Bank Berhad") echo "selected";?>>Public Bank Berhad</option>
						<option value="RHB Bank" <?PHP  if($data["bank"] == "RHB Bank") echo "selected";?>>RHB Bank</option>
						<option value="Hong Leong Bank" <?PHP  if($data["bank"] == "Hong Leong Bank") echo "selected";?>>Hong Leong Bank</option>
						<option value="AmBank" <?PHP  if($data["bank"] == "AmBank") echo "selected";?>>AmBank</option>
						<option value="UOB Malaysia Bank" <?PHP  if($data["bank"] == "UOB Malaysia Bank") echo "selected";?>>UOB Malaysia Bank</option>
						<option value="Bank Rakyat" <?PHP  if($data["bank"] == "Bank Rakyat") echo "selected";?>>Bank Rakyat</option>
						<option value="OCBC Bank Malaysia" <?PHP  if($data["bank"] == "OCBC Bank Malaysia") echo "selected";?>>OCBC Bank Malaysia</option>
						<option value="HSBC Bank Malaysia" <?PHP  if($data["bank"] == "HSBC Bank Malaysia") echo "selected";?>>HSBC Bank Malaysia</option>
						<option value="Affin Bank" <?PHP  if($data["bank"] == "Affin Bank") echo "selected";?>>Affin Bank</option>
						<option value="Bank Islam Malaysia" <?PHP  if($data["bank"] == "Bank Islam Malaysia") echo "selected";?>>Bank Islam Malaysia</option>
						<option value="Standard Chartered Bank Malaysia" <?PHP  if($data["bank"] == "Standard Chartered Bank Malaysia") echo "selected";?>>Standard Chartered Bank Malaysia</option>
						<option value="CitiBank Malaysia" <?PHP  if($data["bank"] == "CitiBank Malaysia") echo "selected";?>>CitiBank Malaysia</option>
						<option value="Bank Simpanan Nasional (BSN)" <?PHP  if($data["bank"] == "Bank Simpanan Nasional (BSN)") echo "selected";?>>Bank Simpanan Nasional (BSN)</option>
						<option value="Bank Muamalat Malaysia" <?PHP  if($data["bank"] == "Bank Muamalat Malaysia") echo "selected";?>>Bank Muamalat Malaysia</option>
						<option value="Alliance Bank" <?PHP  if($data["bank"] == "Alliance Bank") echo "selected";?>>Alliance Bank</option>
						<option value="Agrobank" <?PHP  if($data["bank"] == "Agrobank") echo "selected";?>>Agrobank</option>
						<option value="Al-Rajhi Bank" <?PHP  if($data["bank"] == "Al-Rajhi Bank") echo "selected";?>>Al-Rajhi Bank</option>
						<option value="MBSB Bank Berhad" <?PHP  if($data["bank"] == "MBSB Bank Berhad") echo "selected";?>>MBSB Bank Berhad</option>
					</select>
				  </div>
				  
				  <div class="w3-section " >
					Acc Name
					<input class="w3-input w3-border w3-round" type="text" name="acc_name" value="<?PHP echo $data["acc_name"];?>" placeholder="e.g. ABU BIN ISMAIL" required>
				  </div>
				  
				  <div class="w3-section " >
					Acc No
					<input class="w3-input w3-border w3-round" type="text" name="acc_no" value="<?PHP echo $data["acc_no"];?>" placeholder="" required>
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