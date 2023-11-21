<?PHP
session_start();
?>
<!DOCTYPE html>
<html>
<title>SMART</title>
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

<body class="w3-white">

<!-- Menu top -->
<div class="w3-top w3-content w3-card w3-white" style="max-width:600px">
  <div class="w3-bar" id="myNavbar">
	<span class="w3-bar-item w3-button w3-hide-large w3-hide-medium">
	&nbsp;<img src="images/logo.png" style="height:40px">
    </span>
  </div>
</div>

<div class="w3-padding-64"></div>

<div class="" >

	<div class="w3-container w3-padding" id="contact">
		<div class="w3-content w3-container " style="max-width:500px">

			<div class="w3-row  w3-center">			
				<div class=" w3-padding ">
					<div class="w3-xlarge w3-animate-right"><b>User Manual</b></div>
					<div class="w3-padding-16">
					<a href="MANUAL.pdf" class="w3-bar-item w3-button w3-round-large w3-red"><i class="fa fa-fw fa-download"></i> User Manual.pdf</a>	
					</div>
				</div>
			</div>
		  
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