<?php 
	require 'backend_header.php';
	require 'connection.php';
	
	$login_user_type =$_SESSION['login_user_type'];
    $login_user_id =$_SESSION['login_user']['id'];

    if($login_user_type == "Staff"){

		$sql = "SELECT courses.*, subcategories.name as sname 
	    		FROM courses 
	    		INNER JOIN subcategories ON courses.subcategory_id = subcategories.id
	    		ORDER BY created_at DESC";
	    $statement = $conn->prepare($sql);
	    $statement->execute();

	    $courses = $statement->fetchAll();
	}else{
		$sql = "SELECT courses.*, subcategories.name as sname, 
				batches.name as bname, batches.id as bid, batches.startdate as bstartdate, batches.enddate as benddate,
				batches.starttime as bstarttime, batches.endtime as bendtime
				FROM courses
				INNER JOIN subcategories ON courses.subcategory_id = subcategories.id 
				INNER JOIN batches ON courses.id = batches.course_id
				INNER JOIN enroll ON batches.id = enroll.batch_id
				WHERE enroll.student_id = $login_user_id
				ORDER BY enroll.registerdate DESC
		";
		$statement = $conn->prepare($sql);
	    $statement->execute();

	    $courses = $statement->fetchAll();
	}
?>
	<div class="row g-3 mb-4 align-items-center justify-content-between">
	    <div class="col-auto">
	        <h1 class="app-page-title mb-0"> Coursework </h1>
	    </div>
		<?php if($login_user_type == "Staff"): ?>
		    <div class="col-auto">
		    	<div class="card-header-action">
			        <a href="coursework_new.php" class="btn app-btn-secondary text-decoration-none"> Create New </a>
		        </div>
		    </div>
		<?php endif ?>
	</div>
	<?php if (isset($_SESSION['success_msg'])) { ?>
        <div class="row">   
            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong> Success - </strong> <?php echo $_SESSION['success_msg']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>

        <?php unset($_SESSION['success_msg']); ?>

    <?php } ?>
	
	<?php if($login_user_type == "Staff"): ?>

	<div class="accordion" id="accordionExample">
    	<?php 
    		foreach($courses as $key => $course){
			$courseid = $course['id'];
			$codeno = $course['codeno'];
			$title = $course['title'];
			$sname = $course['sname'];
    	?>
	    <div class="accordion-item">
	        <h2 class="accordion-header" id="heading<?= $courseid ?>">
	            <button class="accordion-button <?php if($key != 0){ echo "collapsed"; } ?> " type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $courseid ?>" aria-expanded="<?php if($key == 0){ echo "true";} else{ echo "false";} ?>" aria-controls="collapse<?= $courseid ?>">
	            	<div class="row">
			            <div class="col-auto">
		            		<div class="title mb-1 "> <?= $title; ?> </div>
		            		<div class="small">
				            	<small> <?= $codeno; ?> </small> 
				            </div>
		        		</div>
		        	</div>
	            </button>
	        </h2>
	        <div id="collapse<?= $courseid ?>" class="accordion-collapse collapse <?php if($key == 0){ echo "show";}?>" aria-labelledby="heading<?= $courseid ?>" data-bs-parent="#accordionExample">
	            <div class="accordion-body">

	            	<?php 
	            		$sql = "SELECT coursework.*, staff.name as staffname 
	            				FROM coursework 
	            				INNER JOIN staff ON coursework.created_by = staff.id
					    		WHERE coursework.course_id = :value1";
					    $statement = $conn->prepare($sql);
    					$statement->bindParam(':value1', $courseid);
					    $statement->execute();

					    $courseworks = $statement->fetchAll();
					    if($courseworks){
	            	?>
	            	<div class="table-responsive">
		            	<table class="datatables table table-bordered table-striped">
		            		<thead class="bg-success">
					            <tr>
					                <th>#</th>
					                <th>Title</th>
					                <th>Semester</th>
					                <th>Created By</th>
					                <th>Action</th>
					            </tr>
					        </thead>
					        <tbody>
					        	<?php $i=1; foreach($courseworks as $coursework): ?>
					        	<tr>
					        		<td> <?= $i++; ?>. </td>
					        		<td> <?= $coursework['title']; ?> </td>
					        		<td> <?= $coursework['semester']; ?> </td>
					        		
					        		<td>
					        			<?= $coursework['staffname']; ?>
					        		</td>
					        		
					        		<td>
					        			<a href="assignment_list.php?id=<?= $coursework['id']; ?>" class="btn btn-primary fw-normal">
						                	View
						                </a>

					        			<a href="coursework_edit.php?id=<?= $coursework['id']; ?>" class="btn btn-warning fw-normal">
                                        	Edit
                                        </a>

                                        <form class="d-inline-block" onsubmit="return confirm('Are you sure want to delete?')" action="coursework_delete.php" method="POST">

                                            <input type="hidden" name="id" value="<?= $coursework['id']; ?>">
                                            
                                            <button class="btn btn-danger fw-normal">
                                                Delete
                                            </button>                                            
                                        </form>
                                        <a href="assignment_new.php?id=<?= $coursework['id']; ?>" class="btn btn-secondary fw-normal">
						                	Add Assignment
						                </a>
					        		</td>

					        	</tr>
					        	<?php endforeach ?>
					        </tbody>
		            	</table>
		            </div>
		        	<?php } else{ ?>

		        		<p> There is no coursework added in this course. </p>

	                <?php } ?>
	            </div>
	        </div>
	    </div>
		<?php } ?>
	    
	</div>
	<?php else: ?>

	<div class="accordion" id="accordionExample">
    	<?php 
    		foreach($courses as $key => $course){
			$courseid = $course['id'];
			$codeno = $course['codeno'];
			$title = $course['title'];
			$sname = $course['sname'];
    	?>
	    <div class="accordion-item">
	        <h2 class="accordion-header" id="heading<?= $courseid ?>">
	            <button class="accordion-button <?php if($key != 0){ echo "collapsed"; } ?> " type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $courseid ?>" aria-expanded="<?php if($key == 0){ echo "true";} else{ echo "false";} ?>" aria-controls="collapse<?= $courseid ?>">
	            	<div class="row">
			            <div class="col-auto">
		            		<div class="title mb-1 "> <?= $title; ?> </div>
		            		<div class="small">
				            	<small> <?= $codeno; ?> </small> 
				            </div>
		        		</div>
		        	</div>
	            </button>
	        </h2>
	        <div id="collapse<?= $courseid ?>" class="accordion-collapse collapse <?php if($key == 0){ echo "show";}?>" aria-labelledby="heading<?= $courseid ?>" data-bs-parent="#accordionExample">
	            <div class="accordion-body">

	            	<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
					  	<?php 
		            		$sql = "SELECT * FROM coursework 
		            				INNER JOIN batch_coursework ON batch_coursework.coursework_id = coursework.id
						    		WHERE batch_coursework.batch_id = :value1";
						    $statement = $conn->prepare($sql);
	    					$statement->bindParam(':value1', $course['bid']);
						    $statement->execute();

						    $courseworks = $statement->fetchAll();
						    if($courseworks){
						    	foreach($courseworks as $coursework){
		            	?>
					  	<li class="nav-item" role="presentation">
					    	<button class="nav-link" id="pills-<?= $coursework['id'] ?>-tab" data-bs-toggle="pill" data-bs-target="#pills-<?= $coursework['id'] ?>" type="button" role="tab" aria-controls="pills-<?= $coursework['id'] ?>" aria-selected="false">
					    		<span class="fs-5"> <?= $coursework['title']; ?> </span>
					    		<small class="d-block"> <?= $coursework['semester']; ?> </small>
					    	</button>
					  	</li>
					  	<?php 
					  		} }
					  	?>
					</ul>
					<div class="tab-content" id="pills-tabContent">
						<?php 
		            		$sql = "SELECT * FROM coursework 
		            				INNER JOIN batch_coursework ON batch_coursework.coursework_id = coursework.id
						    		WHERE batch_coursework.batch_id = :value1";
						    $statement = $conn->prepare($sql);
	    					$statement->bindParam(':value1', $course['bid']);
						    $statement->execute();

						    $courseworks = $statement->fetchAll();
						    if($courseworks){
						    	foreach($courseworks as $coursework){
		            	?>
					  	<div class="tab-pane fade" id="pills-<?= $coursework['id'] ?>" role="tabpanel" aria-labelledby="pills-<?= $coursework['id'] ?>-tab">
					  		<?php 
			            		$sql = "SELECT * FROM assignment 
							    		WHERE coursework_id = :value1";
							    $statement = $conn->prepare($sql);
		    					$statement->bindParam(':value1', $coursework['id']);
							    $statement->execute();

							    $assignments = $statement->fetchAll();
							    if($assignments){
			            	?>
			            	<div class="table-responsive">
				            	<table class="datatables table table-bordered table-striped">
				            		<thead class="bg-success">
							            <tr>
							                <th>#</th>
							                <th>Title</th>
							                <th>End Date</th>
							                <th>Action</th>
							            </tr>
							        </thead>
							        <tbody>
							        	<?php $i=1; foreach($assignments as $assignment): ?>
							        	<tr>
							        		<td> <?= $i++; ?>. </td>
							        		<td> 
							        			<?= $assignment['name']; ?>
							        			<small> <?= $assignment['description']; ?> </small>
							        		</td>
							        		<td> <?= date('d F Y',strtotime($assignment['enddate'])); ?> </td>
							        		
							        		
							        		<td>
							        			<a href="<?= $assignment['file'] ?>" target="_blank" class="btn btn-primary fw-normal" download>
								                	Download Question
								                </a>
								                <?php 
								                	$sql = "SELECT * FROM assignment_submission 
														WHERE student_id =:value1 AND assignment_id=:value2";
												    $statement = $conn->prepare($sql);
												    $statement->bindParam(':value1', $login_user_id);
												    $statement->bindParam(':value2', $assignment['id']);
												    $statement->execute();
												    $assignment_submission = $statement->fetch(PDO::FETCH_ASSOC);
												    if($assignment_submission){
												    	$status = 1;
												    }else{
												    	$status = 0;
												    }

								                ?>
								                <button class="btn app-btn-secondary text-decoration-none uploadBtn" data-courseworkid="<?= $coursework['id']; ?>" data-assignmentid="<?= $assignment['id']; ?>" data-status="<?= $status; ?>">
								                	Upload
								                </button>
								                <?php 
												    if($assignment_submission){
												    	echo "<span class='d-block text-danger'> You have already been uploaded file. </span>";
												    }
								                ?>
							        		</td>

							        	</tr>
							        	<?php endforeach ?>
							        </tbody>
				            	</table>
				            </div>
				        	<?php } else{ ?>

				        		<p> There is no assignment added in this coursework. </p>

			                <?php } ?>
					  	</div>
					  	<?php 
					  		} }
					  	?>
					</div>
	            	
	            </div>
	        </div>
	    </div>
		<?php } ?>
	    
	</div>

	<?php endif; ?>

<!-- Modal -->

<div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        	<form class="forms-sample" action="assignment_upload.php" method="POST" enctype="multipart/form-data">
        		<input type="hidden" name="courseworkid">
        		<input type="hidden" name="assignmentid">

	            <div class="modal-header">
	                <h5 class="modal-title" id="exampleModalLabel"> Upload Assignment </h5>
	                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	            </div>
	            <div class="modal-body">
	                <div class="row mb-3">
					    <label for="inputFile" class="col-sm-2 col-form-label">File:</label>
					    <div class="col-sm-10">
					      	<input type="file" id="inputFile" name="file" required>
					    </div>
					</div>

					<div class="row mb-3">
						<div class="col-12">
							<div id="result_block">
							  	<h5> File Include :</h5>
							  	<div id="result" style="overflow: hidden; max-height: 300px; overflow-y: scroll;"></div>
							</div>
						</div>
					</div>
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
	                <button type="submit" class="btn btn-primary">Save changes</button>
	            </div>
	        </form>

	        
        </div>
    </div>
</div>
<?php 
	require 'backend_footer.php';
?>

<script type="text/javascript">
	$('#result_block').hide();

	$('.uploadBtn').click(function(){
	    var status = $(this).data('status');
	    var courseworkid = $(this).data('courseworkid');
		var assignmentid = $(this).data('assignmentid');

		$("input[name='courseworkid']").val(courseworkid);
		$("input[name='assignmentid']").val(assignmentid);

	    if(status){

			if(confirm("This Assignment is already uploaed. Would you like to replace the existing one which the existing file will be irrevocably gone and not able to retrieve it again. Are you sure want to do this?")){
				$('#showModal').modal('show');
		    }
		    else{
		        return false;
		    }
		}else{

			$('#showModal').modal('show');
		}
		
	});

	var $result = $("#result");
	$("#inputFile").on("change", function(evt) {
	    // remove content
	    $result.html("");
	    // be sure to show the results
	    $("#result_block").show();

	    // Closure to capture the file information.
	    function handleFile(f) {
	        var $title = $("<h4>", {
	            text : f.name
	        });
	        var $fileContent = $("<ul>");
	        $result.append($title);
	        $result.append($fileContent);

	        var dateBefore = new Date();
	        JSZip.loadAsync(f)                                   // 1) read the Blob
	        .then(function(zip) {
	            var dateAfter = new Date();
	            $title.append($("<span>", {
	                "class": "small",
	                text:" (loaded in " + (dateAfter - dateBefore) + "ms)"
	            }));

	            zip.forEach(function (relativePath, zipEntry) {  // 2) print entries
	                $fileContent.append($("<li>", {
	                    text : zipEntry.name
	                }));
	            });
	        }, function (e) {
	            $result.append($("<div>", {
	                "class" : "alert alert-danger",
	                text : "Error reading " + f.name + ": " + e.message
	            }));
	        });
	    }

	    var files = evt.target.files;
	    for (var i = 0; i < files.length; i++) {
	        handleFile(files[i]);
	    }
	});
</script>