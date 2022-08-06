<?php 
	require('connection.php');
  	session_start();

	$studentid = $_POST['studentid'];
	$batchid = $_POST['batchid'];
	$type = $_POST['type'];
	$price = $_POST['price'];
	$fullprice = $_POST['fullprice'];
	$balance = $_POST['balance'];

	$paidamount = $_POST['paidprice'];
	$courseid = $_POST['courseid'];
	$userid = $_SESSION['login_user']['id'];


	$paid = $paidamount + $price;
 	$registerdate = date('Y-m-d');

	if ($fullprice == $paid) {
	    $paymentstatus = 1;

	    $sql = "SELECT * FROM enroll 
			WHERE student_id =:value1 AND batch_id=:value2";
	    $statement = $conn->prepare($sql);
	    $statement->bindParam(':value1', $studentid);
	    $statement->bindParam(':value2', $batchid);
	    $statement->execute();
	    $enroll = $statement->fetch(PDO::FETCH_ASSOC);

	    $enrollid = $enroll['id'];

	    $sql = "UPDATE enroll SET paymentstatus=:value1 WHERE id=:value2";
	    $stmt = $conn->prepare($sql);
		$stmt->bindParam(':value1', $paymentstatus);
		$stmt->bindParam(':value2', $enrollid);

		$stmt->execute();

	}

  	if($type == 1){
  		$transaction = $_POST['transaction'];
	    $file = $_FILES['file'];

	    $uploadFileDir = "upload/file/";

	    $fileTmpPath = $_FILES['file']['tmp_name'];
	    $fileName = $_FILES['file']['name'];
	    $fileSize = $_FILES['file']['size'];
	    $fileType = $_FILES['file']['type'];
	    $fileNameCmps = explode(".", $fileName);
	    $fileExtension = strtolower(end($fileNameCmps));


	    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
	    $dest_path = $uploadFileDir . $newFileName; 

	    move_uploaded_file($fileTmpPath, $dest_path);
	}
	else{
		$dest_path = NULL;
    	$transaction = NULL;
	}

	$sql = "INSERT INTO payment(date, type, amount, transaction, transferfile, student_id, course_id, batch_id, created_by) VALUES (?,?,?,?,?,?,?,?,?)";
	$conn->prepare($sql)->execute([$registerdate, $type, $price, $transaction, $dest_path, $studentid, $courseid, $batchid, $userid]);

	$_SESSION['success_msg']="One Payment is <b> CREATED </b> successfully in our database.";

	header('location:student_list.php');

?>