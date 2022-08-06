<?php 
	require 'backend_header.php';
	require 'connection.php';

    $sql = "SELECT * FROM courses ORDER BY title ASC";
    $statement = $conn->prepare($sql);
    $statement->execute();

    $courses = $statement->fetchAll();
	
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
				        <a href="coursework_list.php" class="btn app-btn-secondary text-decoration-none"> Go Back </a>
			        </div>
		        </div>
	        </div>
        </div>
	    <div class="app-card-body p-3">

	    	<form class="forms-sample" action="coursework_add.php" method="POST" enctype="multipart/form-data">

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
				    <label for="inputTitle" class="col-sm-2 col-form-label">Title:</label>
				    <div class="col-sm-10">
				      	<input type="text" class="form-control" id="inputTitle" name="title" placeholder="e.g: Term no.: 1">
				    </div>
				</div>

				<div class="row mb-3">
				    <label for="inputSemester" class="col-sm-2 col-form-label">Teaching Semester:</label>
				    <div class="col-sm-10">
				      	<input type="text" class="form-control" id="inputSemester" name="semester" placeholder="e.g: SPRING 2022">
				    </div>
				</div>

				<div class="row mb-3">
				    <label for="inputBatch" class="col-sm-2 col-form-label"> Batches:</label>
				    <div class="col-sm-10">
				      	<select class="form-control select2" id="inputBatch" name="batches[]" multiple="multiple">
				      	</select>
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
	    placeholder: 'Choose One Option'
	});
	
	$('#inputCourse').change(function (e) {
        var course_id = $(this).val();
        getBatch(course_id);

    });

    function getBatch(course_id){
        $('#inputBatch').prop('disabled',false);

        $.ajax({
            url: "getBatches.php",
            type:'POST',
            data: { id:course_id }
        }).done(function(data){
            var batch = JSON.parse(data);
            var batchhtml ='<option></option>';

            $.each(batch,function (i,v) {
                batchhtml +=`<option value="${v.id}">${v.name}</option>`;
            });

            $('#inputBatch').html(batchhtml);

        });

        
    }

</script>