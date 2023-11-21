<?PHP $error = ""; ?>
<div id="idSuccessLogin" class="w3-modal" style="z-index:10;">
	<div class="w3-modal-content w3-round-large w3-card-4 w3-animate-zoom" style="max-width:500px">
      <header class="w3-container "> 
        <span onclick="document.getElementById('idSuccessLogin').style.display='none'" 
        class="w3-button w3-large w3-circle w3-display-topright "><i class="fa fa-fw fa-times"></i></span>
      </header>

		<div class="w3-container w3-padding">
		
		<form action="" method="post" >
			<div class="w3-padding"></div>
			<b class="w3-large">Success</b>
			  
			<hr class="w3-clear">
			
			Successfully login.
			
			<div class="w3-padding-16"></div>
			
			<a onclick="document.getElementById('idSuccessLogin').style.display='none'; self.location='index.php'" class="w3-button w3-block w3-padding-large w3-green w3-wide w3-margin-bottom w3-round">START SHOPPING <i class="fa fa-fw fa-lg fa-shopping-cart"></i></a>

		</form>
		</div>
	</div>
</div>

<div id="idErrorLogin" class="w3-modal" style="z-index:10;">
	<div class="w3-modal-content w3-round-large w3-card-4 w3-animate-zoom" style="max-width:500px">
      <header class="w3-container "> 
        <span onclick="document.getElementById('idErrorLogin').style.display='none'" 
        class="w3-button w3-large w3-circle w3-display-topright "><i class="fa fa-fw fa-times"></i></span>
      </header>

		<div class="w3-container w3-padding w3-center">
		
		<form action="" method="post" >
			<div class="w3-padding"></div>
			<b class="w3-large">Error</b>
			  
			<hr class="w3-clear">
			
			Invalid login.
			
			<div class="w3-padding-16"></div>
			
			<!--<a onclick="document.getElementById('idErrorLogin').style.display='none'; document.getElementById('idLogin').style.display='block';'" class="w3-button w3-block w3-padding-large w3-red w3-wide w3-margin-bottom w3-round">RETRY <i class="fa fa-fw fa-lg fa-history"></i></a>-->

		</form>
		</div>
	</div>
</div>
<?PHP 
$act 		= (isset($_REQUEST['act'])) ? trim($_REQUEST['act']) : '';	

$name 		= (isset($_POST['name'])) ? trim($_POST['name']) : '';
$email		= (isset($_POST['email'])) ? trim($_POST['email']) : '';
$phone 		= (isset($_POST['phone'])) ? trim($_POST['phone']) : '';
$gender 	= (isset($_POST['gender'])) ? trim($_POST['gender']) : '';
$dob 		= (isset($_POST['dob'])) ? trim($_POST['dob']) : '';
$password 	= (isset($_POST['passwordx'])) ? trim($_POST['passwordx']) : '';
$address 	= (isset($_POST['address'])) ? trim($_POST['address']) : '';
$bank 		= (isset($_POST['bank'])) ? trim($_POST['bank']) : '';
$acc_name 	= (isset($_POST['acc_name'])) ? trim($_POST['acc_name']) : '';
$acc_no 	= (isset($_POST['acc_no'])) ? trim($_POST['acc_no']) : '';

$name		=	mysqli_real_escape_string($con, $name);
$address	=	mysqli_real_escape_string($con, $address);

$suc_login = "";

if($act == "login") 
{
	$SQL_login = " SELECT * FROM `customer` WHERE `email` = '$email' AND BINARY `password` = '$password'  ";

	$result = mysqli_query($con, $SQL_login);
	$data_login	= mysqli_fetch_array($result);

	$valid = mysqli_num_rows($result);

	if($valid > 0)
	{
		$_SESSION["email"] = $email;
		$_SESSION["password"] = $password;
		$_SESSION["id_customer"] = $data_login["id_customer"];
		
		//header("Location:main.php");
		//print "<script>self.location='order-add.php';</script>";
		print "<script>document.getElementById('idSuccessLogin').style.display='block';</script>";
	}else{
		$error = "Invalid";
		print "<script>document.getElementById('idErrorLogin').style.display='block';</script>";
		//header( "refresh:1;url=index.php" );
		//print "<script>alert('Invalid!'); self.location='index.php';</script>";
	}
}

?>

<?PHP
if($act == "addRegister")
{
	$found 	= numRows($con, "SELECT * FROM `customer` WHERE `email` = '$email' ");
	if($found) $error ="Email already registered";

	// Validate password strength
	$uppercase = preg_match('@[A-Z]@', $password);
	$lowercase = preg_match('@[a-z]@', $password);
	$number    = preg_match('@[0-9]@', $password);
	$specialChars = preg_match('@[^\w]@', $password);

	if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
		$error = 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
	}
}
?>
<div id="id02" class="w3-modal" >
    <div class="w3-modal-content w3-round-large w3-card-4 w3-animate-zoom" style="max-width:500px">
	<header class="w3-container w3-center"> 
		<span onclick="document.getElementById('id02').style.display='none'" 
		class="w3-button w3-display-topright w3-circle">&times;</span>
		<h2><b><?PHP echo $SHOP_NAME;?></b></h2>
		Sign up new account
	</header>
	<hr>
	<div class="w3-container w3-padding">

<?PHP if($error) { ?>
	<div class="w3-content w3-container w3-white w3-text-red w3-round-large w3-border w3-border-red" style="max-width:600px">
		<div class="w3-padding">
		<div class="w3-large">Error!</div>
		<?PHP echo $error;?>
		</div>
	</div>
<?PHP } ?>

		<form action="" method="post">
			<div class="w3-section" >
				<label>Name *</label>
				<input class="w3-input w3-border w3-round" type="text" name="name" value="<?PHP echo $name;?>" required>
			</div>
			<div class="w3-section" >
				<label>Mobile Phone *</label>
				<input class="w3-input w3-border w3-round" type="tel" name="phone" pattern="^(\+?6?01)[01-46-9]-*[0-9]{7}$|^(\+?6?01)[1]-*[0-9]{8}$" placeholder="e.g: 60191234567" value="<?PHP echo $phone;?>" required>
			</div>
			<div class="w3-section" >
				<label>Email *</label>
				<input class="w3-input w3-border w3-round" type="email" name="email" value="<?PHP echo $email;?>" required>
			</div>
			<div class="w3-section" >
				<label>Gender *</label>
				<select class="w3-select w3-border w3-round" name="gender"  required>
					<option value="Male">Male</option>
					<option value="Female">Female</option>
				</select>
			</div>
			<div class="w3-section" >
				<label>Date of Birth *</label>
				<input class="w3-input w3-border w3-round" type="date" name="dob" value="<?PHP echo $dob;?>" required>
			</div>
			<div class="w3-section">
				<label>Password *</label>
				<input class="w3-input w3-border w3-round" type="password" name="passwordx" id="password" maxlength="20"  required>
				<div class="w3-text-gray w3-small" style="line-height: 1.1;" >Password must have at least 8-12 Characters with 1 Capital Letter and 1 Number Characters.</div>
				<div class="w3-padding "><input type="checkbox" onclick="myFunction()"> Show Password</div>
			</div>
			
			<script>
			function myFunction() {
			  var x = document.getElementById("password");
			  if (x.type === "password") {
				x.type = "text";
			  } else {
				x.type = "password";
			  }
			}
			</script>

			<div class="w3-section " >
				Address *
				<textarea class="w3-input w3-border w3-round" rows="2" name="address" required><?PHP echo $address;?></textarea>
			</div>

			<hr>

			<div class="w3-section " >
				Bank *
				<select class="w3-select w3-border w3-round" name="bank" required>
					<option value="Maybank" >Maybank</option>
					<option value="CIMB Bank" >CIMB Bank</option>
					<option value="Public Bank Berhad" >Public Bank Berhad</option>
					<option value="RHB Bank" >RHB Bank</option>
					<option value="Hong Leong Bank" >Hong Leong Bank</option>
					<option value="AmBank" >AmBank</option>
					<option value="UOB Malaysia Bank" >UOB Malaysia Bank</option>
					<option value="Bank Rakyat" >Bank Rakyat</option>
					<option value="OCBC Bank Malaysia" >OCBC Bank Malaysia</option>
					<option value="HSBC Bank Malaysia" >HSBC Bank Malaysia</option>
					<option value="Affin Bank" >Affin Bank</option>
					<option value="Bank Islam Malaysia" >Bank Islam Malaysia</option>
					<option value="Standard Chartered Bank Malaysia" >Standard Chartered Bank Malaysia</option>
					<option value="CitiBank Malaysia" >CitiBank Malaysia</option>
					<option value="Bank Simpanan Nasional (BSN)" >Bank Simpanan Nasional (BSN)</option>
					<option value="Bank Muamalat Malaysia" >Bank Muamalat Malaysia</option>
					<option value="Alliance Bank" >Alliance Bank</option>
					<option value="Agrobank" >Agrobank</option>
					<option value="Al-Rajhi Bank" >Al-Rajhi Bank</option>
					<option value="MBSB Bank Berhad" >MBSB Bank Berhad</option>
				</select>
			</div>

			<div class="w3-section " >
				Acc Name *
				<input class="w3-input w3-border w3-round" type="text" name="acc_name" value="<?PHP echo $acc_name;?>" placeholder="e.g. ABU BIN ISMAIL" required>
			</div>

			<div class="w3-section " >
				Acc No *
				<input class="w3-input w3-border w3-round" type="number" name="acc_no" value="<?PHP echo $acc_no;?>" placeholder="" required>
			</div>
			
			<input name="act" type="hidden" value="addRegister">
			<button type="reset" class="w3-button w3-padding-large w3-amber w3-wide w3-margin-bottom w3-round"><i class="fa fa-fw fa-history"></i>Reset</button>
			<button type="submit" class="w3-button w3-padding-large w3-red w3-wide w3-margin-bottom w3-round">Register</button>
		</form>  
		<div class="w3-center">Already registered? <a href="#" onclick="document.getElementById('idLogin').style.display='block';
		 document.getElementById('id02').style.display='none'" class="w3-text-red">Login Here</a></div>
    </div>
		
    <footer class="w3-container ">
		&nbsp;
    </footer>
    </div>
</div>
<div id="idLogin" class="w3-modal" >
    <div class="w3-modal-content w3-round-large w3-card-4 w3-animate-zoom" style="max-width:500px">
      <header class="w3-container w3-center"> 
        <span onclick="document.getElementById('idLogin').style.display='none'" 
        class="w3-button w3-display-topright w3-circle">&times;</span>
        <h2><b><?PHP echo $SHOP_NAME;?></b></h2>
		Sign in to your account
      </header>
	  <hr>
      <div class="w3-container w3-padding">

		 <form action="" method="post">
			  <div class="w3-section" >
				<label>Email *</label>
				<input class="w3-input w3-border w3-round" type="email" name="email"  required>
			  </div>
			  <div class="w3-section">
				<label>Password *</label>
				<input class="w3-input w3-border w3-round" type="password" name="passwordx" maxlength="20"  required>
			  </div>
			  <input name="act" type="hidden" value="login">
			  <button type="submit" class="w3-button w3-block w3-padding-large w3-red w3-wide w3-margin-bottom w3-round">Login</button>
			</form>  
		<div class="w3-center">Don't have an account? <a href="#" onclick="document.getElementById('idLogin').style.display='none';
		 document.getElementById('id02').style.display='block';" class="w3-text-red">Register Now!</a></div>
      </div>
		
      <footer class="w3-container ">
		&nbsp;
      </footer>
    </div>
</div>

<div id="idSuccessRegister" class="w3-modal" style="z-index:10;">
	<div class="w3-modal-content w3-round-large w3-card-4 w3-animate-zoom" style="max-width:500px">
      <header class="w3-container "> 
        <span onclick="document.getElementById('idSuccessRegister').style.display='none'" 
        class="w3-button w3-large w3-circle w3-display-topright "><i class="fa fa-fw fa-times"></i></span>
      </header>

		<div class="w3-container w3-padding">
		
		<form action="" method="post" >
			<div class="w3-padding"></div>
			<b class="w3-large">Congratulation</b>
			  
			<hr class="w3-clear">
			
			Your account registered successfully! Please login.
			
			<div class="w3-padding-16"></div>
			
			<a onclick="document.getElementById('idSuccessRegister').style.display='none'; document.getElementById('idLogin').style.display='block'" class="w3-button w3-block w3-padding-large w3-red w3-wide w3-margin-bottom w3-round"><i class="fa fa-fw fa-lg fa-lock"></i>   LOGIN</a>


		</form>
		</div>
	</div>
</div>

<?PHP

if(($act == "addRegister") && ($error))
{
	print "<script>document.getElementById('id02').style.display='block';</script>";
}

if(($act == "addRegister") && (!$error))
{	
	$SQL_insert = " 
	INSERT INTO `customer`(`name`,  `email`, `password`,  `phone`, `gender`, `dob`, `address`, `bank`, `acc_name`, `acc_no`) 
				   VALUES ('$name', '$email', '$password', '$phone', '$gender', '$dob', '$address', '$bank','$acc_name','$acc_no')";
										
	$result = mysqli_query($con, $SQL_insert);

	$suc_login = "Successfully Registered";
	//echo $SQL_insert ;  exit;
	print "<script>document.getElementById('idSuccessRegister').style.display='block';</script>";
}
?>