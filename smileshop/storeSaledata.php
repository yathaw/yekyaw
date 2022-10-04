<?php 
	
	require 'dbconnect.php';

	$carts = $_POST['cart'];
	$total = $_POST['total'];

	date_default_timezone_set('Asia/Rangoon');

	$date = date('Y-m-d');
	$voucherno = strtotime(date('h:i:s')); // 12:00:20 = 24574832348

	$staffid = 2;

	$sql = "INSERT INTO sales (voucherno, date, total, staff_id) VALUES ('$voucherno', '$date', '$total', '$staffid')";
	mysqli_query($conn, $sql);

	$saleid = $conn->insert_id; // sale table ထဲ နောက်ဆုံး၀င်တဲ့ အကြောင်းရဲ့ id ကို ပြန်ခေါ်တာ 

	foreach($carts as $cart){
		$productid = $cart['id'];
		$name = $cart['name'];
		$codeno = $cart['codeno'];
		$price = $cart['price'];
		$qty = $cart['qty'];

		$sql = "INSERT INTO saledetails (qty, product_id, sale_id) VALUES ('$qty', '$productid', '$saleid')";
		mysqli_query($conn, $sql);		

	}


?>