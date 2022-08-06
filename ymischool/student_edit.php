<?php 
	require 'backend_header.php';
	require 'connection.php';

    $id = $_GET['id'];
	$sql = "SELECT * FROM students WHERE id=:value1";
    $statement = $conn->prepare($sql);
    $statement->bindParam(':value1', $id);
    $statement->execute();

    $student = $statement->fetch(PDO::FETCH_ASSOC);

	
?>

	<div class="app-card app-card-orders-table shadow-sm mb-5">
		<div class="app-card-header p-3">
	        <div class="row justify-content-between align-items-center">
		        <div class="col-auto">
	                <h1 class="app-page-title mb-0"> Edit Existing Student</h1>
		        </div>
		        <div class="col-auto">
			        <div class="card-header-action">
				        <a href="student_list.php" class="btn app-btn-secondary text-decoration-none"> Go Back </a>
			        </div>
		        </div>
	        </div>
        </div>
	    <div class="app-card-body p-3">

	    	<form class="forms-sample" action="student_update.php" method="POST" enctype="multipart/form-data">
	    		<input type="hidden" name="id" value="<?= $id; ?>">

                <div class="row mb-3">
				    <label for="inputTitle" class="col-sm-2 col-form-label">Name:</label>
				    <div class="col-sm-10">
				      	<input type="text" class="form-control" id="inputTitle" name="name" value="<?= $student['name']; ?>">
				    </div>
				</div>

				<div class="row mb-3">
				    <label for="inputDob" class="col-sm-2 col-form-label">Date of Birth:</label>
				    <div class="col-sm-10">
				      	<input type="date" class="form-control" id="inputDob" name="dob" value="<?= $student['dob']; ?>" required>
				    </div>
				</div>

				<div class="row mb-3">
				    <label for="inputEmail" class="col-sm-2 col-form-label">Email:</label>
				    <div class="col-sm-10">
				      	<input type="email" class="form-control" id="inputEmail" name="email" value="<?= $student['email']; ?>" required>
				    </div>
				</div>

				<div class="row mb-3">
				    <label for="inputPhone" class="col-sm-2 col-form-label">Phone:</label>
				    <div class="col-sm-10">
				      	<input type="text" class="form-control" id="inputPhone" name="phone" value="<?= $student['phone']; ?>">
				    </div>
				</div>

				<div class="row mb-3">
				    <label for="inputDescription" class="col-sm-2 col-form-label">Address:</label>
				    <div class="col-sm-10">
				      	<textarea class="form-control" name="address" style="height:150px"><?= $student['address']; ?></textarea>
				    </div>
				</div>

                <button type="submit" class="offset-2 btn app-btn-primary me-2">Save</button>
            </form>
	    </div>
	</div>

<?php 
	require 'backend_footer.php';
?>
