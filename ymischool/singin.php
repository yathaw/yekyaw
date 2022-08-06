<?php 
    require("connection.php");
    session_start();

    $email = $_POST['email'];
    $password = $_POST['password'];
    $status = $_POST['status'];

    if($status == "Student"){
    	$sql = "SELECT * FROM students 
            WHERE email = :v1 AND password = :v2";

	    $stmt = $conn->prepare($sql);
	    $stmt->bindParam(':v1', $email);
	    $stmt->bindParam(':v2', $password);
	    $stmt->execute();

	    $user = $stmt->fetch(PDO::FETCH_ASSOC);


	    if ($stmt->rowCount() <= 0) {
	        
	        $_SESSION['login_fail'] = 'Your current email and password is invalid';

	        header('location:index.php');

	    }
	    else{
	        # success

	        $_SESSION['login_user'] = $user;
	        $_SESSION['login_user_type'] = $status;

	        header('location:course_list.php');

	    }
    }else{
		$sql = "SELECT staff.*, position.id as pid, position.name as pname FROM staff 
				INNER JOIN staff_position ON staff.id = staff_position.staff_id
				INNER JOIN position ON staff_position.position_id = position.id
            	WHERE email = :v1 AND password = :v2";

	    $stmt = $conn->prepare($sql);
	    $stmt->bindParam(':v1', $email);
	    $stmt->bindParam(':v2', $password);
	    $stmt->execute();

	    $user = $stmt->fetch(PDO::FETCH_ASSOC);

	    if ($stmt->rowCount() <= 0) {
	        
	        $_SESSION['login_fail'] = 'Your current email and password is invalid';

	        header('location:index.php');

	    }
	    else{
	        # success

	        $_SESSION['login_user'] = $user;
	        $_SESSION['login_user_type'] = $status;

	        header('location:course_list.php');
	        
	    }
    }


    


?>