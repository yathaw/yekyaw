<?php 
	
	require 'dbconnect.php';
	session_start();

	$id = $_POST['id'];
	$stockdate = $_POST['date'];
	$stockcount = $_POST['count'];


	$sql = "INSERT INTO stocks (qty, date, product_id) VALUES ('$stockcount', '$stockdate', '$id')";
	mysqli_query($conn, $sql);

	$_SESSION['success_msg'] = "You saved new stock.";
	header("location: stock.php");

?>