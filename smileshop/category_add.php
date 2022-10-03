<?php 
	require 'dbconnect.php';
	session_start();

	$name = $_POST['name'];

	$valid = true;

	if(empty($name)){
		$nameErr = 'The category field is required.';
		$valid = false;
	}
	if($valid){
		$sql = "INSERT INTO categories (name) VALUES ('$name')";
		mysqli_query($conn, $sql);

		$_SESSION['success_msg'] = "You saved the category.";
		header("location: category_list.php");
	}else{
		$_SESSION['err_msg'] = $nameErr;
		header("location: category_new.php");
	}
	
?>