<?php 
	require 'dbconnect.php';
	session_start();

	$id = $_POST['id'];
	$name = $_POST['name'];

	$valid = true;

	if(empty($name)){
		$nameErr = 'The category field is required.';
		$valid = false;
	}
	if($valid){
		$sql = "UPDATE categories SET name='$name' WHERE id='$id'";
		mysqli_query($conn, $sql);

		$_SESSION['success_msg'] = "You updated the category.";
		header("location: category_list.php");
	}else{
		$_SESSION['err_msg'] = $nameErr;
		header("location: category_edit.php?id=$id");
	}
	
?>