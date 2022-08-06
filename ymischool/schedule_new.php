<?php 
	require 'backend_header.php';
	require 'connection.php';

    $sql = "SELECT * FROM courses ORDER BY title ASC";
    $statement = $conn->prepare($sql);
    $statement->execute();

    $courses = $statement->fetchAll();

	
?>
	
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style type="text/css">
	.select2-results__group{
		color: gray; 
		font-weight: normal;
	}
	.select2-container--default .select2-results__option--highlighted.select2-results__option--selectable{
		background-color: #15a362;
	    color: white;
	    padding-left: 40px;
	}
</style>
	<div class="app-card app-card-orders-table shadow-sm mb-5">
		<div class="app-card-header p-3">
	        <div class="row justify-content-between align-items-center">
		        <div class="col-auto">
	                <h1 class="app-page-title mb-0"> Create New </h1>
		        </div>
		        <div class="col-auto">
			        <div class="card-header-action">
				        <a href="schedule_list.php" class="btn app-btn-secondary text-decoration-none"> Go Back </a>
			        </div>
		        </div>
	        </div>
        </div>
	    <div class="app-card-body p-3">

	    	<form class="forms-sample" action="schedule_add.php" method="POST" enctype="multipart/form-data">
	    		<div class="row mb-3">
				    <label for="inputBatch" class="col-sm-2 col-form-label"> Batches:</label>
				    <div class="col-sm-10">
				      	<select class="form-control select2" id="inputBatch" name="batch">
				      		<option></option>
				      		<?php foreach($courses as $course){ ?>
				      			<optgroup label="<?= $course['title'] ?>">
				      				<?php
				      					$sql = "SELECT * FROM batches 
									    		WHERE batches.course_id = :value1
									    		ORDER BY batches.startdate DESC";
									    $statement = $conn->prepare($sql);
				    					$statement->bindParam(':value1', $course['id']);
									    $statement->execute();

									    $batches = $statement->fetchAll();
									    foreach($batches as $batch){
				      				?>
					      				<option value="<?= $batch['id']; ?>" data-type="<?= $batch['type']; ?>"> <?= $batch['name']; ?> </option>
					      			<?php } ?>
					      		</optgroup>
				      		<?php } ?>

				      	</select>
				    </div>
				</div>

                <div class="row mb-3">
				    <label for="inputTitle" class="col-sm-2 col-form-label">Title:</label>
				    <div class="col-sm-10">
				      	<input type="text" class="form-control" id="inputTitle" name="title">
				    </div>
				</div>

				<div class="row mb-3">
				    <label for="inputDay" class="col-sm-2 col-form-label">Choose Day:</label>
				    <div class="col-sm-10">
				      	<div class="btn-group" role="group" aria-label="Basic radio toggle button group">
						  	<input type="radio" class="btn-check" name="day" id="monday" autocomplete="off"  value="Monday">
						  	<label class="btn btn-outline-success" for="monday"> Monday </label>

						 	<input type="radio" class="btn-check" name="day" id="tuesday" autocomplete="off" value="Tuesday">
						  	<label class="btn btn-outline-success" for="tuesday">Tuesday</label>

						  	<input type="radio" class="btn-check" name="day" id="wednesday" autocomplete="off" value="Wednesday">
						  	<label class="btn btn-outline-success" for="wednesday">Wednesday</label>

						  	<input type="radio" class="btn-check" name="day" id="thursday" autocomplete="off" value="Thursday">
						  	<label class="btn btn-outline-success" for="thursday">Thursday</label>

						  	<input type="radio" class="btn-check" name="day" id="friday" autocomplete="off" value="Friday">
						  	<label class="btn btn-outline-success" for="friday">Friday</label>

						  	<input type="radio" class="btn-check" name="day" id="saturday" autocomplete="off" value="Saturday">
						  	<label class="btn btn-outline-success" for="saturday">Saturday</label>

						  	<input type="radio" class="btn-check" name="day" id="sunday" autocomplete="off" value="Sunday">
						  	<label class="btn btn-outline-success" for="sunday">Sunday</label>

						</div>
				    </div>
				</div>

				<div class="row mb-3">
				    <label for="inputTime" class="col-sm-2 col-form-label">Time:</label>
				    <div class="col-sm-5">
				      	<label for="inputStarttime" >Start Time:</label>
				      	<input type="time" class="form-control" id="inputStarttime" name="starttime">
				    </div>
				    <div class="col-sm-5">
				    	<label for="inputEndtime" >End Time:</label>
				      	<input type="time" class="form-control" id="inputEndtime" name="endtime">
				    </div>
				</div>

				<div class="row mb-3">
				    <label for="inputColor" class="col-sm-2 col-form-label">Color:</label>
				    <div class="col-sm-10">
				      	<input type="color" class="form-control" id="inputColor" name="color">
				    </div>
				</div>

				

				<div class="row mb-3">
				    <label for="inputTeacher" class="col-sm-2 col-form-label"> Staff:</label>
				    <div class="col-sm-10">
				      	<select class="form-control select2" id="inputTeacher" name="staff" disabled>
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
	$(".select2").select2({
	    width: '100%', // need to override the changed default,
	    style: 'bootstrap4',
	    placeholder: 'Choose One Option'
	});

	$('#inputBatch').change(function (e) {
        var batch_id = $(this).val();
        getTeacher(batch_id);
        var element = $(this).find('option:selected'); 
        var type = element.attr("data-type"); 

        if(type == 0){
        	// weekday
        	$('#monday').prop('disabled',false);
	        $('#tuesday').prop('disabled',false);
	        $('#wednesday').prop('disabled',false);
	        $('#thursday').prop('disabled',false);
			$('#friday').prop('disabled',false);

	        $('#saturday').prop('disabled',true);
	        $('#sunday').prop('disabled',true);


        }else{
        	// weekend
        	$('#monday').prop('disabled',true);
	        $('#tuesday').prop('disabled',true);
	        $('#wednesday').prop('disabled',true);
	        $('#thursday').prop('disabled',true);
			$('#friday').prop('disabled',true);

        	$('#saturday').prop('disabled',false);
	        $('#sunday').prop('disabled',false);

        }

    });

    function getTeacher(batch_id){
        $('#inputTeacher').prop('disabled',false);

        $.ajax({
            url: "getTeachers.php",
            type:'POST',
            data: { id:batch_id }
        }).done(function(data){
            var staff = JSON.parse(data);
            var staffhtml ='<option></option>';

            $.each(staff,function (i,v) {
                staffhtml +=`<option value="${v.id}">${v.name}</option>`;
            });

            $('#inputTeacher').html(staffhtml);

        });

        
    }

</script>