<?php 
	require 'backend_header.php';
	require 'connection.php';

	$id = $_GET['id'];

	$sql = "SELECT * FROM schedules WHERE id=:value1";
    $statement = $conn->prepare($sql);
    $statement->bindParam(':value1', $id);
    $statement->execute();

    $schedule = $statement->fetch(PDO::FETCH_ASSOC);

    $sql = "SELECT * FROM courses ORDER BY title ASC";
    $statement = $conn->prepare($sql);
    $statement->execute();

    $courses = $statement->fetchAll();

	$time_str = $schedule['time_event'];

	$time_arr = explode("-",$time_str);
	$starttime = $time_arr[0];
	$endtime = $time_arr[1];

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

	    	<form class="forms-sample" action="schedule_update.php" method="POST" enctype="multipart/form-data">
	    		<input type="hidden" name="id" value="<?= $schedule['id']; ?>">
                <div class="row mb-3">
				    <label for="inputTitle" class="col-sm-2 col-form-label">Title:</label>
				    <div class="col-sm-10">
				      	<input type="text" class="form-control" id="inputTitle" name="title" value="<?= $schedule['title']; ?>">
				    </div>
				</div>

				<div class="row mb-3">
				    <label for="inputDay" class="col-sm-2 col-form-label">Choose Day:</label>
				    <div class="col-sm-10">
				      	<div class="btn-group" role="group" aria-label="Basic radio toggle button group">
						  	<input type="radio" class="btn-check" name="day" id="monday" autocomplete="off"  value="Monday" <?php if($schedule['day'] == "Monday"){ echo "checked"; } ?> >
						  	<label class="btn btn-outline-success" for="monday"> Monday </label>

						 	<input type="radio" class="btn-check" name="day" id="tuesday" autocomplete="off" value="Tuesday" <?php if($schedule['day'] == "Tuesday"){ echo "checked"; } ?>>
						  	<label class="btn btn-outline-success" for="tuesday">Tuesday</label>

						  	<input type="radio" class="btn-check" name="day" id="wednesday" autocomplete="off" value="Wednesday" <?php if($schedule['day'] == "Wednesday"){ echo "checked"; } ?>>
						  	<label class="btn btn-outline-success" for="wednesday">Wednesday</label>

						  	<input type="radio" class="btn-check" name="day" id="thursday" autocomplete="off" value="Thursday" <?php if($schedule['day'] == "Thursday"){ echo "checked"; } ?>>
						  	<label class="btn btn-outline-success" for="thursday">Thursday</label>

						  	<input type="radio" class="btn-check" name="day" id="friday" autocomplete="off" value="Friday" <?php if($schedule['day'] == "Friday"){ echo "checked"; } ?>>
						  	<label class="btn btn-outline-success" for="friday">Friday</label>

						  	<input type="radio" class="btn-check" name="day" id="saturday" autocomplete="off" value="Saturday" <?php if($schedule['day'] == "Saturday"){ echo "checked"; } ?>>
						  	<label class="btn btn-outline-success" for="saturday">Saturday</label>

						  	<input type="radio" class="btn-check" name="day" id="sunday" autocomplete="off" value="Sunday" <?php if($schedule['day'] == "Sunday"){ echo "checked"; } ?>>
						  	<label class="btn btn-outline-success" for="sunday">Sunday</label>

						</div>
				    </div>
				</div>

				<div class="row mb-3">
				    <label for="inputTime" class="col-sm-2 col-form-label">Time:</label>
				    <div class="col-sm-5">
				      	<label for="inputStarttime" >Start Time:</label>
				      	<input type="time" class="form-control" id="inputStarttime" name="starttime" value="<?= $starttime; ?>">
				    </div>
				    <div class="col-sm-5">
				    	<label for="inputEndtime" >End Time:</label>
				      	<input type="time" class="form-control" id="inputEndtime" name="endtime" value="<?= $endtime; ?>">
				    </div>
				</div>

				<div class="row mb-3">
				    <label for="inputColor" class="col-sm-2 col-form-label">Color:</label>
				    <div class="col-sm-10">
				      	<input type="color" class="form-control" id="inputColor" name="color" value="<?= $schedule['color']; ?>">
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
	var batch_id = "<?= $schedule['batch_id']; ?>";
	var staff_id = "<?= $schedule['staff_id']; ?>";

	$(document).ready(function() {
	    getTeacher(batch_id);
	});

	$(".select2").select2({
	    width: '100%', // need to override the changed default,
	    style: 'bootstrap4',
	    placeholder: 'Choose One Option'
	});

	$('#inputBatch').change(function (e) {
        var batch_id = $(this).val();
        var type = $(this).attr("data-type");
        getTeacher(batch_id);

        if(type == 0){
        	// weekday
        	$('#monday').prop('disabled',true);
	        $('#tuesday').prop('disabled',true);
	        $('#wednesday').prop('disabled',true);
	        $('#thursday').prop('disabled',true);
			$('#friday').prop('disabled',true);

	        $('#saturday').prop('disabled',false);
	        $('#sunday').prop('disabled',false);


        }else{
        	// weekend
        	$('#monday').prop('disabled',false);
	        $('#tuesday').prop('disabled',false);
	        $('#wednesday').prop('disabled',false);
	        $('#thursday').prop('disabled',false);
			$('#friday').prop('disabled',false);

        	$('#saturday').prop('disabled',true);
	        $('#sunday').prop('disabled',true);

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
                // staffhtml +=`<option value="${v.id}" >${v.name}</option>`;
                staffhtml +=`<option value="${v.id}"`;
                if(v.id == staff_id){
                	staffhtml += `selected`;
                }
                staffhtml += `>${v.name}</option>`;

            });

            $('#inputTeacher').html(staffhtml);

        });

        
    }

</script>