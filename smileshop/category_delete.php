<?php 
	require 'dbconnect.php';
	session_start();

	$id = $_GET['id'];
	$sql = "DELETE FROM categories WHERE id=$id";
	mysqli_query($conn, $sql);

	$_SESSION['success_msg'] = "You deleted the category successfully.";
	header("location: category_list.php");
?>