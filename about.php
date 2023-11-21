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

<?PHP include("menu-top.php");?>

<div class="w3-padding-32"></div>

<div class="" >

	<div class="w3-container w3-padding" id="contact">
		<div class="w3-content w3-container " style="max-width:500px">

			<div class="w3-row">
				

					<div class="w3-padding">
					<img src="images/about-us.png" class="w3-image">
					</div>

				
				

					<div class=" w3-padding ">
						<div style="font-size: 50px;" class="w3-animate-right"><b>ABOUT US</b></div>
						<div class="w3-padding-16">
<p><b>  Welcome to the 'SMart' app!</b> a place to enhancing your university experience at University Poly-Tech Malaysia (UPTM). The mission here is to provide a seamless and convenient platform for UPTM students to connect, share, and trade in a digital marketplace designed exclusively for you. 'SMart' aims to bridge the gap between traditional selling methods and the modern digital world, making it easier for you to buy, sell, and even share your expertise with fellow students.</p>

<p>This app is more than just a marketplace, it's a community. 'SMart' not only allows you to list and buy products but also offers a platform to connect, learn, and grow. Features like direct messaging enable you to communicate with sellers in real-time, ensuring transparent and efficient transactions. Moreover, you can advertise your expertise, whether it's tutoring, teaching, or sharing your knowledge with others. The belief here is in fostering a sense of unity and collaboration among UPTM students, all while providing a convenient and secure marketplace for your needs.</p>

<p>Your experience with 'SMart' is at the heart of what is done, and there is a continuous effort to enhance and improve the app based on your valuable feedback. Thank you for being a part of this growing community. Together, university life at UPTM can become smarter, easier, and more enjoyable.</p>
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