<?php 
	
	require('connection.php');	
	session_start();

	$id = $_POST['id'];
	$name = $_POST['name'];
	$dob = $_POST['dob'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$address = $_POST['address'];
	$sql = "UPDATE students SET name=:value1, dob=:value2, phone=:value3, address=:value4, email=:value5 WHERE id=:value6";
	$stmt= $conn->prepare($sql);
	$stmt->bindParam(':value1', $name);
	$stmt->bindParam(':value2', $dob);
	$stmt->bindParam(':value3', $phone);
	$stmt->bindParam(':value4', $address);
	$stmt->bindParam(':value5', $email);
	$stmt->bindParam(':value6', $id);


	$stmt->execute();

	$_SESSION['success_msg']="One Student is <b> UPDATED </b> successfully in our database.";


	header('location:student_list.php');





?>