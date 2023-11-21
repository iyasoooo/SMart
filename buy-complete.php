<?PHP
session_start();

include("database.php");
if( !verifyCustomer($con) ) 
{
	header( "Location: index.php" );
	return false;
}
?>
<script type="text/javascript">
window.history.forward();
function noBack() {
	window.history.forward();
}
</script>
<?PHP
$id_customer= (isset($_SESSION['id_customer'])) ? trim($_SESSION['id_customer']) : '0';
$act 		= (isset($_POST['act'])) ? trim($_POST['act']) : '';	

$delivery	= (isset($_POST['delivery'])) ? trim($_POST['delivery']) : 'Standard Delivery';
$pay_date 	= (isset($_POST['pay_date'])) ? trim($_POST['pay_date']) : '';
$pay_time	= (isset($_POST['pay_time'])) ? trim($_POST['pay_time']) : '';
$total		= (isset($_POST['total'])) ? trim($_POST['total']) : '';

$bil=0;

$id_product	= (isset($_POST['id_product'])) ? trim($_POST['id_product']) : '0';
$quantity	= (isset($_POST['quantity'])) ? trim($_POST['quantity']) : '0';

$SQL_list = "SELECT * FROM `product` WHERE `id_product` = $id_product";
$result = mysqli_query($con, $SQL_list) ;
$data	= mysqli_fetch_array($result);

$product= $data["product"];
$price	= $data["price"];
$photo	= $data["photo"];
$id_seller	= $data["id_customer"];

$success = "";

if($act == "add")
{	
	$act = "";
	$order_detail = "
	$product x $quantity
	";
	
	$order_no = rand(10000, 99999);
	
	$SQL_insert = " 
	INSERT INTO `orders`(`id_order`, `id_customer`, `order_no`, `order_detail`, `delivery`, `total`, `pay_date`, `pay_time`, `pay_slip`, `status`, `remark`, `id_seller`) 
	VALUES (NULL,'$id_customer','$order_no','$order_detail','$delivery','$total','$pay_date','$pay_time','','Pending' , '', $id_seller) ";
								
	$result = mysqli_query($con, $SQL_insert);
	
	$id_order = mysqli_insert_id($con);
	
	// -------- Photo -----------------
	if(isset($_FILES['pay_slip'])){
		if($_FILES["pay_slip"]["error"] == 4) {
				//means there is no file uploaded
		} else { 

			$file_name = $_FILES['pay_slip']['name'];
			$file_size = $_FILES['pay_slip']['size'];
			$file_tmp = $_FILES['pay_slip']['tmp_name'];
			$file_type = $_FILES['pay_slip']['type'];

			$fileNameCmps = explode(".", $file_name);
			$file_ext = strtolower(end($fileNameCmps));
			$new_file	= rand() . "." . $file_ext;

			if(empty($errors)==true) {
				move_uploaded_file($file_tmp,"pay_slip/".$new_file);
			 
				$query = "UPDATE `orders` SET `pay_slip`='$new_file' WHERE `id_order` = '$id_order'";			
				$result = mysqli_query($con, $query) or die("Error in query: ".$query."<br />".mysqli_error($con));
			}else{
				print_r($errors);
			}  
		  
		}
	}
	// -------- End Photo -----------------

	$success = "Successfully Paid";
	
	print "<script>self.location='buy-completed.php?order_no=".$order_no."';</script>";
}
?>