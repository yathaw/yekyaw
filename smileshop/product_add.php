<?php 
	
	require 'dbconnect.php';
	session_start();
	$valid = true;
	$errors = array();

	$codeno = $_POST['codeno'];
	$name = $_POST['name'];
	$categoryid = $_POST['categoryid'];
	$price = $_POST['price'];
	$stockdate = $_POST['stockdate'];
	$stockcount = $_POST['stockcount'];

	if(empty($codeno)){
		array_push($errors, 'The codeno field is required.');
		$valid = false;
	}

	if(empty($name)){
		array_push($errors, 'The name field is required.');
		$valid = false;
	}

	if(empty($categoryid)){
		array_push($errors, 'The category field is required.');
		$valid = false;
	}

	if(empty($price)){
		array_push($errors, 'The price field is required.');
		$valid = false;
	}

	if(empty($stockdate)){
		array_push($errors, 'The stock date field is required.');
		$valid = false;
	}

	if(empty($stockcount)){
		array_push($errors, 'The stock count field is required.');
		$valid = false;
	}

	if(isset($_FILES['photo']['name'])){
		// move upload file
		$uploadFileDir = 'img/product/';

		$fileTmpPath = $_FILES['photo']['tmp_name'];
		$fileName = $_FILES['photo']['name']; // p1.png => 1234.png 
		$fileSize = $_FILES['photo']['size'];
		$fileType = $_FILES['photo']['type'];


		$fileNameCmps = explode(".", $fileName); // string to array
        $fileExtension = strtolower(end($fileNameCmps)); // PNG => png

        $newFileName = md5(time()) . '.' . $fileExtension;

		// img/product/1234.png;
		$dbPath = $uploadFileDir.$newFileName;

		move_uploaded_file($fileTmpPath, $dbPath);

	}else{
		// reply error message 
		$valid = false;
		array_push($errors, 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.');
	}

	
	if($valid){
		$sql = "INSERT INTO products (codeno, name, photo, price, category_id) VALUES ('$codeno', '$name', '$dbPath', '$price', '$categoryid')";
		mysqli_query($conn, $sql);

		$productid = $conn->insert_id; // product table ထဲ နောက်ဆုံး၀င်တဲ့ အကြောင်းရဲ့ id ကို ပြန်ခေါ်တာ 

		$sql = "INSERT INTO stocks (qty, date, product_id) VALUES ('$stockcount', '$stockdate', '$productid')";
		mysqli_query($conn, $sql);

		$_SESSION['success_msg'] = "You saved new product.";
		header("location: product_list.php");
	}else{
		$_SESSION['err_msg'] = $errors;
		header("location: product_new.php");
	}




?>