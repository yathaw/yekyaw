<?php 
		
	require 'dbconnect.php';
	session_start();

	$username = $_POST['username'];
	$password = $_POST['password'];

	$valid = true;
	$errors = array();

	if(empty($username)){
		array_push($errors, 'The username field is required.');
		$valid = false;
	}

	if(empty($password)){
		array_push($errors, 'The password field is required.');
		$valid = false;
	}


	if($valid){

		$sql = "SELECT * FROM staff WHERE username='$username' AND password='$password' ";
	    $query = mysqli_query($conn, $sql);

	    $count = mysqli_num_rows($query);

	    if ($count > 0) {
	    	// usenrame / password => Correct ...
	    	$data = mysqli_fetch_array($query);

	    	$_SESSION['login_user'] = $data;
    		
    		$roleid = $data['role_id'];

    		if($roleid == 1){
    			// ADMIN
    			header("location: category_list.php");
    		}else{
    			// STAFF
    			header("location: sale.php");
    		}

	    }else{
	    	// username / password => Wrong
	    	array_push($errors, 'Invalid Username or password.');
	    	$_SESSION['err_msg'] = $errors;
			header("location: index.php");
	    }

	    
		
	}else{
		$_SESSION['err_msg'] = $errors;
		header("location: index.php");
	}

?>