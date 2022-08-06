<?php 
	
	require('connection.php');	
	session_start();

	$id = $_POST['id'];
	$name = $_POST['name'];
	$category = $_POST['category'];

	

	$sql = "UPDATE subcategories SET name=:value1, category_id=:value2 WHERE id=:value3";
	$stmt= $conn->prepare($sql);
	$stmt->bindParam(':value1', $name);
	$stmt->bindParam(':value2', $category);
	$stmt->bindParam(':value3', $id);

	$stmt->execute();

	$_SESSION['success_msg']="One Subject is <b> UPDATED </b> successfully in our database.";


	header('location:subject_list.php');





?>