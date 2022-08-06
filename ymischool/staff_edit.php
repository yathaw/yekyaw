<?php 
	require 'backend_header.php';
	require 'connection.php';
	$id = $_GET['id'];

	$sql = "SELECT * FROM staff 
			INNER JOIN staff_position ON staff_position.staff_id = staff.id
			WHERE staff.id=:value1";
    $statement = $conn->prepare($sql);
    $statement->bindParam(':value1', $id);
    $statement->execute();
    $staff = $statement->fetch(PDO::FETCH_ASSOC);


	$sql = "SELECT * FROM position 
    		ORDER BY name ASC";
    $statement = $conn->prepare($sql);
    $statement->execute();

    $positions = $statement->fetchAll();

	$name = $staff['name'];
	$dob = $staff['dob'];
	$address = $staff['address'];
	$profile = $staff['profile'];
	$email = $staff['email'];

	$position_id = $staff['position_id'];

?>
	
	<div class="app-card app-card-orders-table shadow-sm mb-5">
		<div class="app-card-header p-3">
	        <div class="row justify-content-between align-items-center">
		        <div class="col-auto">
	                <h1 class="app-page-title mb-0"> Edit Staff </h1>
		        </div>
		        <div class="col-auto">
			        <div class="card-header-action">
				        <a href="staff_list.php" class="btn app-btn-secondary text-decoration-none"> Go Back </a>
			        </div>
		        </div>
	        </div>
        </div>
	    <div class="app-card-body p-3">

	    	<form class="forms-sample" action="staff_update.php" method="POST" enctype="multipart/form-data">
	    		<input type="hidden" name="id" value="<?= $id ?>">
	    		<input type="hidden" name="oldphoto" value="<?= $profile ?>">

	    		<div class="row mb-3">
				    <label for="inputPhoto" class="col-sm-2 col-form-label">Profile:</label>
				    <div class="col-sm-10">
				    	<ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
						  	<li class="nav-item" role="presentation">
						    	<button class="nav-link active" id="oldprofile-tab" data-bs-toggle="tab" data-bs-target="#oldprofile" type="button" role="tab" aria-controls="oldprofile" aria-selected="true">Old Profile</button>
						  	</li>
						  	<li class="nav-item" role="presentation">
						    	<button class="nav-link" id="newprofile-tab" data-bs-toggle="tab" data-bs-target="#newprofile" type="button" role="tab" aria-controls="newprofile" aria-selected="false">New Profile</button>
						  	</li>
						</ul>
						<div class="tab-content" id="myTabContent">
						  	<div class="tab-pane fade show active" id="oldprofile" role="tabpanel" aria-labelledby="oldprofile-tab">
						  		<img src="<?= $profile; ?> " class="w-25 h-25 img-thumbnail ">
						  	</div>
						  	<div class="tab-pane fade" id="newprofile" role="tabpanel" aria-labelledby="newprofile-tab">
				      			<input type="file" id="inputPhoto" name="newphoto">
						  	</div>
						</div>
				    </div>
				</div>

                <div class="row mb-3">
				    <label for="inputTitle" class="col-sm-2 col-form-label">Name:</label>
				    <div class="col-sm-10">
				      	<input type="text" class="form-control" id="inputTitle" name="name" value="<?= $name; ?>" required>
				    </div>
				</div>

				<div class="row mb-3">
				    <label for="inputDob" class="col-sm-2 col-form-label">Date of Birth:</label>
				    <div class="col-sm-10">
				      	<input type="date" class="form-control" id="inputDob" name="dob" value="<?= $dob; ?>" required>
				    </div>
				</div>

				<div class="row mb-3">
				    <label for="inputEmail" class="col-sm-2 col-form-label">Email:</label>
				    <div class="col-sm-10">
				      	<input type="email" class="form-control" id="inputEmail" name="email" value="<?= $email; ?>" required>
				    </div>
				</div>
				

				<div class="row mb-3">
				    <label for="inputDescription" class="col-sm-2 col-form-label">Address:</label>
				    <div class="col-sm-10">
				      	<textarea class="form-control" name="address" style="height:150px"><?= $address; ?></textarea>
				    </div>
				</div>

                <button type="submit" class="offset-2 btn app-btn-primary me-2">Save</button>
            </form>
	    </div>
	</div>

<?php 
	require 'backend_footer.php';
?>