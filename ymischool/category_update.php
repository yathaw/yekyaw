<?php 
	
	require('connection.php');	
	session_start();

	$id = $_POST['id'];
	$name = $_POST['name'];
	

	$sql = "UPDATE categories SET name=:value1 WHERE id=:value2";
	$stmt= $conn->prepare($sql);
	$stmt->bindParam(':value1', $name);
	$stmt->bindParam(':value2', $id);
	$stmt->execute();

	$_SESSION['success_msg']="One Category is <b> UPDATED </b> successfully in our database.";


	header('location:category_list.php');





?>