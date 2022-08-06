<?php 
	require 'backend_header.php';
	require 'connection.php';

	$id = $_GET['id'];


    $sql = "SELECT courses.*, subcategories.name as sname 
    		FROM courses 
    		INNER JOIN subcategories ON courses.subcategory_id = subcategories.id
    		WHERE courses.id = :value1";
    $statement = $conn->prepare($sql);
    $statement->bindParam(':value1', $id);
    $statement->execute();

    $course = $statement->fetch(PDO::FETCH_ASSOC);
?>
	

	<div class="app-card app-card-orders-table shadow-sm mb-5">
		<div class="app-card-header p-3">
	        <div class="row justify-content-between align-items-center">
		        <div class="col-auto">
	                <h1 class="app-page-title mb-0"> Add New Materials For <?= $course['codeno']; ?> </h1>
	                <p> <?= $course['title']; ?> </p>
		        </div>
		        <div class="col-auto">
			        <div class="card-header-action">
				        <a href="course_detail.php?id=<?= $id; ?>" class="btn app-btn-secondary text-decoration-none"> Go Back </a>
			        </div>
		        </div>
	        </div>
        </div>
	    <div class="app-card-body p-3">

	    	<form class="forms-sample" action="material_add.php" method="POST" enctype="multipart/form-data">
	    		<input type="hidden" name="courseid" value="<?= $id; ?>">
	    		<div class="row mb-3">
				    <label for="inputTitle" class="col-sm-2 col-form-label">Title:</label>
				    <div class="col-sm-10">
				      	<input type="text" class="form-control" id="inputTitle" name="title" required>
				    </div>
				</div>

				<div class="row mb-3">
				    <label for="inputFile1" class="col-sm-2 col-form-label"> File:</label>
				    <div class="col-sm-10">
				      	<input type="file" id="inputFile1" name="file" required>
				    </div>
				</div>


                <button type="submit" class="offset-2 btn app-btn-primary me-2">Save</button>
            </form>
	    </div>
	</div>

<?php 
	require 'backend_footer.php';
?>