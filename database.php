<?PHP
	/*	-----------------------------
		Developed by : BelajarPHP.com
		Date : 23 Oct 2023
		-----------------------------	*/
	//https://studentmart.u-ji.com/index.php
	//http://studentmart.000.pe/index.php
	date_default_timezone_set('Asia/Kuala_Lumpur');
	
	$SHOP_NAME = "SMart";
	
	if($_SERVER['HTTP_HOST']=="localhost")
	{	
		//localhost
		$dbHost = "localhost";	// Database host
		$dbName = "studentmart";		// Database name
		$dbUser = "root";		// Database user
		$dbPass = "";			// Database password
	}
	else
	{
		//local live @ hosting
		$dbHost = "sql104.infinityfree.com";			// Database host
		$dbName = "if0_35325527_studentmart";		// Database name
		$dbUser = "if0_35325527";		// Database user
		$dbPass = "9SOcmxJrzYyzWg";		// Database password
		
		//local live @ hosting
		//$dbHost = "localhost";			// Database host
		//$dbName = "jseacom_studentmart";		// Database name
		//$dbUser = "jseacom_root";		// Database user
		//$dbPass = "O1[8tZjrL~!1";		// Database password
	}
	
	$con = mysqli_connect($dbHost,$dbUser ,$dbPass,$dbName);
	
	function verifyAdmin($con)
	{
		if ($_SESSION['username'] && $_SESSION['password'] ) 
		{
		  $result=mysqli_query($con,"SELECT  `username`, `password` FROM `admin` WHERE `username`='$_SESSION[username]' AND `password`='$_SESSION[password]' " ) ;

          if( mysqli_num_rows( $result ) == 1 ) 
	  	  return true;
		}
		return false;
	}
	
	function verifyCustomer($con)
	{
		if ($_SESSION['email'] && $_SESSION['password'] ) 
		{
		  $result=mysqli_query($con,"SELECT  `email`, `password` FROM `customer` WHERE `email`='$_SESSION[email]' AND `password`='$_SESSION[password]' " ) ;

          if( mysqli_num_rows( $result ) == 1 ) 
	  	  return true;
		}
		return false;
	}

	function numRows($con, $query) {
        $result  = mysqli_query($con, $query);
        $rowcount = mysqli_num_rows($result);
        return $rowcount;
    }
	
	function Notify($status, $alert, $redirect)
	{
		$color = ($status == "success") ? "w3-green" : "w3-blue";

		echo '<div class="'.$color.' w3-top w3-card w3-padding-24" style="z-index=999">
			<span onclick="this.parentElement.style.display=\'none\'" class="w3-button w3-large w3-display-topright">&times;</span>
				<div class="w3-padding w3-center">
				<div class="w3-large">'.$alert.'</div>
				</div>
			</div>';
		
		if($_SERVER['HTTP_HOST']=="localhost")
			header( "refresh:1;url=$redirect" );
		else
			print "<script>self.location='$redirect';</script>";
	}
	
	
	function NotifyNew($status, $alert, $redirect)
	{
		$color = ($status == "success") ? "w3-green" : "w3-blue";

		echo '<div class="'.$color.' w3-top w3-card w3-padding-24" style="z-index=999">
			<span onclick="this.parentElement.style.display=\'none\'" class="w3-button w3-large w3-display-topright">&times;</span>
				<div class="w3-padding w3-center">
				<div class="w3-large">'.$alert.'</div>
				</div>
			</div>';
	}
	
	function substrwords($text, $maxchar, $end='...') {
		if (strlen($text) > $maxchar || $text == '') {
			$words = preg_split('/\s/', $text);      
			$output = '';
			$i      = 0;
			while (1) {
				$length = strlen($output)+strlen($words[$i]);
				if ($length > $maxchar) {
					break;
				} 
				else {
					$output .= " " . $words[$i];
					++$i;
				}
			}
			$output .= $end;
		} 
		else {
			$output = $text;
		}
		return $output;
	}
	
?>