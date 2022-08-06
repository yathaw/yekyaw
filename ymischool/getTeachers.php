<?php 
	require 'connection.php';

	$batchid = $_POST['id'];

	$sql = "SELECT staff.* FROM staff 
		INNER JOIN batch_staff ON batch_staff.staff_id = staff.id
		WHERE batch_staff.batch_id = :value1
		ORDER BY batch_staff.staff_id ASC";
	$statement = $conn->prepare($sql);
	$statement->bindParam(':value1', $batchid);
	$statement->execute();

	$teachers = $statement->fetchAll();

	echo json_encode($teachers);
?>