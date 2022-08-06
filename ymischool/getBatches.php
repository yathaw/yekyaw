<?php 
	require 'connection.php';

	$courseid = $_POST['id'];

	$sql = "SELECT * FROM batches 
		WHERE course_id = :value1
		ORDER BY id DESC";
	$statement = $conn->prepare($sql);
	$statement->bindParam(':value1', $courseid);
	$statement->execute();

	$batches = $statement->fetchAll();

	echo json_encode($batches);
?>