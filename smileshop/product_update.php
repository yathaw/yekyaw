<?php 
	
	require 'dbconnect.php';
	session_start();
	$valid = true;
	$errors = array();

	$codeno = $_POST['codeno'];
	$name = $_POST['name'];
	$categoryid = $_POST['categoryid'];
	$price = $_POST['price'];

	$id = $_POST['id'];
	$oldphoto = $_POST['oldphoto'];

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

	if($_FILES['photo']['size'] > 0){
		unlink($oldphoto);

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
		$dbPath = $oldphoto;
	}

	
	if($valid){
		$sql = "UPDATE products SET codeno='$codeno', name='$name', photo='$dbPath', price='$price', category_id='$categoryid' WHERE id='$id'";

		mysqli_query($conn, $sql);

		$_SESSION['success_msg'] = "You updated the product.";
		header("location: product_list.php");
	}else{
		$_SESSION['err_msg'] = $errors;
		header("location: product_edit.php");
	}




?>