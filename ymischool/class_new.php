<?php 
	require 'backend_header.php';
	require 'connection.php';

    $sql = "SELECT * FROM courses ORDER BY title ASC";
    $statement = $conn->prepare($sql);
    $statement->execute();

    $courses = $statement->fetchAll();

    $teacherid = 3;
    $sql = "SELECT staff.*, position.name as pname 
    		FROM staff 
    		INNER JOIN staff_position ON staff_position.staff_id = staff.id
    		INNER JOIN position ON staff_position.position_id = position.id
    		WHERE position.id=:value1";
    $statement = $conn->prepare($sql);
    $statement->bindParam(':value1', $teacherid);
    $statement->execute();

    $staffLists = $statement->fetchAll();
	
?>
	
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<div class="app-card app-card-orders-table shadow-sm mb-5">
		<div class="app-card-header p-3">
	        <div class="row justify-content-between align-items-center">
		        <div class="col-auto">
	                <h1 class="app-page-title mb-0"> Create New </h1>
		        </div>
		        <div class="col-auto">
			        <div class="card-header-action">
				        <a href="class_list.php" class="btn app-btn-secondary text-decoration-none"> Go Back </a>
			        </div>
		        </div>
	        </div>
        </div>
	    <div class="app-card-body p-3">

	    	<form class="forms-sample" action="class_add.php" method="POST" enctype="multipart/form-data">

	    		<div class="row mb-3">
				    <label for="inputCourse" class="col-sm-2 col-form-label">Select Course:</label>
				    <div class="col-sm-10">
				      	<select class="form-control" id="inputCourse" name="course">
                            <option selected disabled> Choose One Course </option>

				      		<?php foreach($courses as $course){ ?>
				      		<option value="<?= $course['id']; ?>"> <?= $course['title']; ?> </option>
				      		<?php } ?>

				      	</select>
				    </div>
				</div>

                <div class="row mb-3">
				    <label for="inputName" class="col-sm-2 col-form-label">Class Name:</label>
				    <div class="col-sm-10">
				      	<input type="text" class="form-control" id="inputName" name="name">
				    </div>
				</div>

				<div class="row mb-3">
				    <label for="inputStartdate" class="col-sm-2 col-form-label">Start Date:</label>
				    <div class="col-sm-10">
				      	<input type="date" class="form-control" id="inputStartdate" name="startdate">
				    </div>
				</div>

				<div class="row mb-3">
				    <label for="inputEnddate" class="col-sm-2 col-form-label">End Date:</label>
				    <div class="col-sm-10">
				      	<input type="date" class="form-control" id="inputEnddate" name="enddate">
				    </div>
				</div>

				<div class="row mb-3">
				    <label for="inputStarttime" class="col-sm-2 col-form-label">Start Time:</label>
				    <div class="col-sm-10">
				      	<input type="time" class="form-control" id="inputStarttime" name="starttime">
				    </div>
				</div>

				<div class="row mb-3">
				    <label for="inputEndtime" class="col-sm-2 col-form-label">End Time:</label>
				    <div class="col-sm-10">
				      	<input type="time" class="form-control" id="inputEndtime" name="endtime">
				    </div>
				</div>

				<div class="row mb-3">
				    <label for="inputEndtime" class="col-sm-2 col-form-label">Type:</label>
				    <div class="col-sm-10">
				      	<div class="form-check form-check-inline">
						  	<input class="form-check-input" type="radio" name="type" id="weekday" value="0">
						  	<label class="form-check-label" for="weekday"> Weekday </label>
						</div>
						<div class="form-check form-check-inline">
						  	<input class="form-check-input" type="radio" name="type" id="weekend" value="1">
						  	<label class="form-check-label" for="weekend"> Weekend </label>
						</div>
				    </div>
				</div>

				<div class="row mb-3">
				    <label for="inputTeacher" class="col-sm-2 col-form-label"> Teachers:</label>
				    <div class="col-sm-10">
				      	<select class="form-control select2" id="inputTeacher" name="teachers[]" multiple="multiple">

				      		<?php foreach($staffLists as $staffList){ ?>
				      		<option value="<?= $staffList['id']; ?>"> <?= $staffList['name']; ?> </option>
				      		<?php } ?>

				      	</select>
				    </div>
				</div>

				<div class="row mb-3">
				    <label for="inputTeam" class="col-sm-2 col-form-label">Team Link:</label>
				    <div class="col-sm-10">
				      	<input type="text" class="form-control" id="inputTeam" name="teamlink">
				    </div>
				</div>

				

                <button type="submit" class="offset-2 btn app-btn-primary me-2">Save</button>
            </form>
	    </div>
	</div>

<?php 
	require 'backend_footer.php';
?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
	$(".select2").select2({
	    width: '100%', // need to override the changed default,
	    style: 'bootstrap4',
	    placeholder: 'Choose One Teacher'
	});
</script>
