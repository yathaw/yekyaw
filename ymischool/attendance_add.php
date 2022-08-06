<?php 

	require('connection.php');
  	session_start();

  	$today = date('Y-m-d'); $att_date = date('Y-m-d');
  	$today=date('Y-m-d', strtotime($today));

	$bid = $_GET['bid'];

    $login_user_type =$_SESSION['login_user_type'];
    $login_user_id =$_SESSION['login_user']['id'];

    if($login_user_type == "Student"){
    	$sql = "SELECT * FROM batches 
    		WHERE id= :value1";
	    $statement = $conn->prepare($sql);
		$statement->bindParam(':value1', $bid);
	    $statement->execute();
	    $batch = $statement->fetch(PDO::FETCH_ASSOC);

	    $teamlink = $batch['teamlink'];

	    $startdate = date('Y-m-d', strtotime($batch['startdate']));
		$enddate = date('Y-m-d', strtotime($batch['enddate']));

		if (($today >= $startdate) && ($today <= $enddate)){
		    
		    $sql = "SELECT * FROM attendance 
	    		WHERE student_id = :value1 AND batch_id = :value2 AND date = :value3";
		    $statement = $conn->prepare($sql);
			$statement->bindParam(':value1', $login_user_id);
			$statement->bindParam(':value2', $bid);
			$statement->bindParam(':value3', $att_date);
		    $statement->execute();

		    $attendance = $statement->fetch(PDO::FETCH_ASSOC);
		    if(!$attendance){
		    	$status = 1;

		    	$sql = "INSERT INTO attendance (date, status, student_id, batch_id) VALUES(:value1, :value2, :value3, :value4)";
				$stmt = $conn->prepare($sql);
				$stmt->bindParam(':value1', $att_date);
				$stmt->bindParam(':value2', $status);
				$stmt->bindParam(':value3', $login_user_id);
				$stmt->bindParam(':value4', $bid);
				$stmt->execute();
		    }

		    header("Location: $teamlink"); exit();

		}else{
		    exit; 
		}

    }
?>