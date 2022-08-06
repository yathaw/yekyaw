<?php 
	require 'backend_header.php';
	require 'connection.php';

	$sql = "SELECT * FROM position 
    		ORDER BY name ASC";
    $statement = $conn->prepare($sql);
    $statement->execute();

    $positions = $statement->fetchAll();
?>
	

	<div class="app-card app-card-orders-table shadow-sm mb-5">
		<div class="app-card-header p-3">
	        <div class="row justify-content-between align-items-center">
		        <div class="col-auto">
	                <h1 class="app-page-title mb-0"> Create New </h1>
		        </div>
		        <div class="col-auto">
			        <div class="card-header-action">
				        <a href="staff_list.php" class="btn app-btn-secondary text-decoration-none"> Go Back </a>
			        </div>
		        </div>
	        </div>
        </div>
	    <div class="app-card-body p-3">

	    	<form class="forms-sample" action="staff_add.php" method="POST" enctype="multipart/form-data">
	    		<div class="row mb-3">
				    <label for="inputPhoto" class="col-sm-2 col-form-label">Profile:</label>
				    <div class="col-sm-10">
				      	<input type="file" id="inputPhoto" name="photo" required>
				    </div>
				</div>

                <div class="row mb-3">
				    <label for="inputTitle" class="col-sm-2 col-form-label">Name:</label>
				    <div class="col-sm-10">
				      	<input type="text" class="form-control" id="inputTitle" name="name" required>
				    </div>
				</div>

				<div class="row mb-3">
				    <label for="inputDob" class="col-sm-2 col-form-label">Date of Birth:</label>
				    <div class="col-sm-10">
				      	<input type="date" class="form-control" id="inputDob" name="dob" required>
				    </div>
				</div>

				<div class="row mb-3">
				    <label for="inputEmail" class="col-sm-2 col-form-label">Email:</label>
				    <div class="col-sm-10">
				      	<input type="email" class="form-control" id="inputEmail" name="email" required>
				    </div>
				</div>

				<div class="row mb-3">
				    <label for="inputPassword" class="col-sm-2 col-form-label">Password:</label>
				    <div class="col-sm-10">
				      	<input type="password" class="form-control" id="inputPassword" name="password" required>
				    </div>
				</div>

				
				<div class="row mb-3">
				    <label for="inputPosition" class="col-sm-2 col-form-label">Select Position:</label>
				    <div class="col-sm-10">
				      	<select class="form-control" id="inputPosition" name="position">
                            <option selected disabled> Choose One Position </option>

				      		<?php foreach($positions as $position){ ?>
				      		<option value="<?= $position['id']; ?>"> <?= $position['name']; ?> </option>
				      		<?php } ?>

				      	</select>
				    </div>
				</div>

				<div class="row mb-3">
				    <label for="inputDescription" class="col-sm-2 col-form-label">Address:</label>
				    <div class="col-sm-10">
				      	<textarea class="form-control" name="address" style="height:150px"></textarea>
				    </div>
				</div>

                <button type="submit" class="offset-2 btn app-btn-primary me-2">Save</button>
            </form>
	    </div>
	</div>

<?php 
	require 'backend_footer.php';
?>