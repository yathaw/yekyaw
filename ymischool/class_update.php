<?php

	require ('connection.php');
	session_start();

	$course = $_POST['course'];
	$name = $_POST['name'];
	$startdate = $_POST['startdate'];
	$enddate = $_POST['enddate'];
	$starttime = $_POST['starttime'];
	$endtime = $_POST['endtime'];
	$teachers = $_POST['teachers'];
	$userid = 1;
  	$type = $_POST['type']; 
  	$teamlink = $_POST['teamlink'];

	$id = $_POST['id'];

	$sql = "SELECT * FROM batch_staff WHERE batch_id =:value1";
	$statement = $conn->prepare($sql);
	$statement->bindParam(':value1', $id);
	$statement->execute();
	$batch_staff = $statement->fetchAll();

	$staffids = [];
	foreach ($batch_staff as $bs)
	{
	    $staffids[] = $bs['staff_id'];
	}

	foreach ($teachers as $teacher)
	{
		if(!in_array($teacher, $staffids)){
		    $sql = "INSERT INTO batch_staff (batch_id, staff_id) VALUES(:value1, :value2)";
		    $stmt = $conn->prepare($sql);
		    $stmt->bindParam(':value1', $id);
		    $stmt->bindParam(':value2', $teacher);
		    $stmt->execute();
		}
	}

	foreach ($staffids as $staffid)
	{
		if(!in_array($staffid, $teachers)){
			$sql = "DELETE FROM batch_staff WHERE batch_id=:value1 AND staff_id=:value2";
		    $stmt = $conn->prepare($sql);
		    $stmt->bindParam(':value1', $id);
		    $stmt->bindParam(':value2', $staffid);
		    $stmt->execute();
		}
	}

	$sql = "UPDATE batches SET name=:value1, startdate=:value2, enddate=:value3, starttime=:value4, endtime=:value5, course_id=:value6, created_by=:value7, type=:value8, teamlink=:value10 WHERE id=:value9";

	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':value1', $name);
	$stmt->bindParam(':value2', $startdate);
	$stmt->bindParam(':value3', $enddate);
	$stmt->bindParam(':value4', $starttime);
	$stmt->bindParam(':value5', $endtime);
	$stmt->bindParam(':value6', $course);
	$stmt->bindParam(':value7', $userid);
	$stmt->bindParam(':value8', $type);
	$stmt->bindParam(':value10', $teamlink);
	$stmt->bindParam(':value9', $id);
	$stmt->execute();

	

	$_SESSION['success_msg'] = "One Class is <b> CREATED </b> successfully in our database.";

	header('location:class_list.php');

?>
