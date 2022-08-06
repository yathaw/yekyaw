<?php 
	require('connection.php');
  	session_start();

  	$courseworkid = $_POST['courseworkid'];
  	// $courseworkid = 1;

  	$assignmentid = $_POST['assignmentid'];
  	$marks = $_POST['marks'];
  	$notes = $_POST['notes'];
  	$students = $_POST['students'];
  	$assignment_submission_ids = $_POST['assignment_submission_ids'];
  	$userid = $_SESSION['login_user']['id'];

  	

  	foreach($assignment_submission_ids as $key => $assignment_submission_id){

  		$sql = "SELECT * FROM assignment_grading 
		WHERE student_id =:value1 AND assignment_id=:value2 AND assignment_submission_id=:value3";
	    $statement = $conn->prepare($sql);
	    $statement->bindParam(':value1', $students[$key]);
	    $statement->bindParam(':value2', $assignmentid);
	    $statement->bindParam(':value3', $assignment_submission_id);
	    $statement->execute();
	    $assignment_grading = $statement->fetch(PDO::FETCH_ASSOC);

	    if($assignment_grading){
	    	$sql = "UPDATE assignment_grading SET mark=:value1, note=:value2, assignment_submission_id=:value3, assignment_id=:value4, student_id=:value5 , staff_id=:value6 WHERE id=:value7";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':value1', $marks[$key]);
		  	$stmt->bindParam(':value2', $notes[$key]);
		  	$stmt->bindParam(':value3', $assignment_submission_id);
		  	$stmt->bindParam(':value4', $assignmentid);
		  	$stmt->bindParam(':value5', $students[$key]);
		  	$stmt->bindParam(':value6', $userid);
		  	$stmt->bindParam(':value7', $assignment_grading['id']);
		  	$stmt->execute();

	    }else{

	  		$sql = "INSERT INTO assignment_grading (mark, note, assignment_submission_id, assignment_id, student_id, staff_id) VALUES(:value1, :value2, :value3, :value4, :value5, :value6)";
		  	$stmt = $conn->prepare($sql);
		  	$stmt->bindParam(':value1', $marks[$key]);
		  	$stmt->bindParam(':value2', $notes[$key]);
		  	$stmt->bindParam(':value3', $assignment_submission_id);
		  	$stmt->bindParam(':value4', $assignmentid);
		  	$stmt->bindParam(':value5', $students[$key]);
		  	$stmt->bindParam(':value6', $userid);
		  	$stmt->execute();
		}
  	}

  

  	

  	$_SESSION['success_msg']="Grades are <b> CREATED </b> successfully in our database.";

  	header("Location: assignment_list.php?id=$courseworkid");
?>