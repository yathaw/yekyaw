<?php 
	require 'backend_header.php';
	require 'connection.php';

	$id = $_GET['id'];

	$sql = "SELECT assignment.*, coursework.id as courseworkid, coursework.title as coursework, coursework.semester, courses.title as course,  courses.codeno
			FROM assignment 
			INNER JOIN coursework ON assignment.coursework_id = coursework.id
			INNER JOIN courses ON coursework.course_id = courses.id
    		WHERE assignment.id = :value1";	
    $statement = $conn->prepare($sql);
	$statement->bindParam(':value1', $id);
    $statement->execute();
    $assignment = $statement->fetch(PDO::FETCH_ASSOC);

    $coursename = $assignment['course'];
    $coursecodeno = $assignment['codeno'];
    $courseworktitle = $assignment['coursework'];
    $semester = $assignment['semester'];

	
?>
	
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<div class="app-card app-card-orders-table shadow-sm mb-5">
		<div class="app-card-header p-3">
	        <div class="row justify-content-between align-items-center">
		        <div class="col-auto">
	                <h1 class="app-page-title mb-0"> Edit Assignment </h1>
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

	    	<form class="forms-sample" action="assignment_update.php" method="POST" enctype="multipart/form-data">
	    		<input type="hidden" name="id" value="<?= $id; ?>">
	    		<input type="hidden" name="oldfile" value="<?= $assignment['file']; ?>">
	    		<input type="hidden" name="courseworkid" value="<?= $assignment['courseworkid']; ?>">

	    		

                <div class="row mb-3">
				    <label for="inputTitle" class="col-sm-2 col-form-label">Name:</label>
				    <div class="col-sm-10">
				      	<input type="text" class="form-control" id="inputTitle" name="name" placeholder="e.g: Status Code or Subject Name" value="<?= $assignment['name']; ?>" required> 
				    </div>
				</div>

				<div class="row mb-3">
				    <label for="inputEnddate" class="col-sm-2 col-form-label">End Submission:</label>
				    <div class="col-sm-10">
				      	<input type="date" class="form-control" id="inputEnddate" name="enddate" value="<?= $assignment['enddate']; ?>" required>
				    </div>
				</div>

				<div class="row mb-3">
				    <label for="inputPhoto" class="col-sm-2 col-form-label">File:</label>
				    <div class="col-sm-10">
				    	<ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
						  	<li class="nav-item" role="presentation">
						    	<button class="nav-link active" id="oldprofile-tab" data-bs-toggle="tab" data-bs-target="#oldprofile" type="button" role="tab" aria-controls="oldprofile" aria-selected="true">Old File</button>
						  	</li>
						  	<li class="nav-item" role="presentation">
						    	<button class="nav-link" id="newprofile-tab" data-bs-toggle="tab" data-bs-target="#newprofile" type="button" role="tab" aria-controls="newprofile" aria-selected="false">New File</button>
						  	</li>
						</ul>
						<div class="tab-content" id="myTabContent">
						  	<div class="tab-pane fade show active" id="oldprofile" role="tabpanel" aria-labelledby="oldprofile-tab">
								<a href="<?= $assignment['file']; ?>" class="btn btn-primary" target="_blank"> Download </a>
						  	</div>
						  	<div class="tab-pane fade" id="newprofile" role="tabpanel" aria-labelledby="newprofile-tab">
				      			<input type="file" id="inputPhoto" name="file">
						  	</div>
						</div>

				    </div>
				</div>

				<div class="row mb-3">
				    <label for="inputDescription" class="col-sm-2 col-form-label">Desciption:</label>
				    <div class="col-sm-10">
				      	<textarea class="form-control" name="description" style="height:150px"><?= $assignment['description']; ?></textarea>
				    </div>
				</div>


                <button type="submit" class="offset-2 btn app-btn-primary me-2">Save</button>
            </form>
	    </div>
	</div>

<?php 
	require 'backend_footer.php';
?>