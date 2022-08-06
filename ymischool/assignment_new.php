<?php 
	require 'backend_header.php';
	require 'connection.php';

	$id = $_GET['id'];
	$sql = "SELECT coursework.*, courses.title as course, courses.codeno as codeno 
			FROM coursework 
			INNER JOIN courses ON coursework.course_id = courses.id
    		WHERE coursework.id = :value1";	
    $statement = $conn->prepare($sql);
	$statement->bindParam(':value1', $id);
    $statement->execute();
    $coursework = $statement->fetch(PDO::FETCH_ASSOC);

    $coursename = $coursework['course'];
    $coursecodeno = $coursework['codeno'];
    $courseworktitle = $coursework['title'];
    $semester = $coursework['semester'];

	
?>
	
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<div class="app-card app-card-orders-table shadow-sm mb-5">
		<div class="app-card-header p-3">
	        <div class="row justify-content-between align-items-center">
		        <div class="col-auto">
	                <h1 class="app-page-title mb-0"> Add Assignment </h1>
		        </div>
		        <div class="col-auto">
			        <div class="card-header-action">
				        <a href="coursework_list.php" class="btn app-btn-secondary text-decoration-none"> Go Back </a>
			        </div>
		        </div>
	        </div>
        </div>
	    <div class="app-card-body p-3">
	    	<div class="row mb-3">
    			<div class="col-12">
    				<div class="mb-2"> 
						<span class="fw-bold"> Course : </span> 
						<small class="fw-lighter"> <?= $coursename; ?> 
	    					( <?= $coursecodeno; ?> ) 
	    				</small>
					</div>
					<div class="mb-2"> 
						<span class="fw-bold"> Coursework : </span> 
						<small class="fw-lighter"> <?= $courseworktitle; ?> </small>
					</div>
					<div class="mb-2"> 
						<span class="fw-bold"> Semester : </span> 
						<small class="fw-lighter"> <?= $semester; ?> </small>
					</div>
    			</div>
    		</div>

	    	<form class="forms-sample" action="assignment_add.php" method="POST" enctype="multipart/form-data">
	    		<input type="hidden" name="courseworkid" value="<?= $id; ?>">

                <div class="row mb-3">
				    <label for="inputTitle" class="col-sm-2 col-form-label">Name:</label>
				    <div class="col-sm-10">
				      	<input type="text" class="form-control" id="inputTitle" name="name" placeholder="e.g: Status Code or Subject Name" required> 
				    </div>
				</div>

				<div class="row mb-3">
				    <label for="inputEnddate" class="col-sm-2 col-form-label">End Submission:</label>
				    <div class="col-sm-10">
				      	<input type="date" class="form-control" id="inputEnddate" name="enddate" required>
				    </div>
				</div>

				<div class="row mb-3">
				    <label for="inputPhoto" class="col-sm-2 col-form-label">File:</label>
				    <div class="col-sm-10">
				      	<input type="file" id="inputPhoto" name="file" required>
				    </div>
				</div>

				<div class="row mb-3">
				    <label for="inputDescription" class="col-sm-2 col-form-label">Desciption:</label>
				    <div class="col-sm-10">
				      	<textarea class="form-control" name="description" style="height:150px"></textarea>
				    </div>
				</div>


                <button type="submit" class="offset-2 btn app-btn-primary me-2">Save</button>
            </form>
	    </div>
	</div>

<?php 
	require 'backend_footer.php';
?>