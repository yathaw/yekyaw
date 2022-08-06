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
	        <h1 class="app-page-title mb-0"> Schedules </h1>
	    </div>
	    <?php if($login_user_type == "Staff"): ?>
	    <div class="col-auto">
	    	<div class="card-header-action">
		        <a href="schedule_new.php" class="btn app-btn-secondary text-decoration-none"> Create New </a>
	        </div>
	    </div>
	<?php endif; ?>
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
	            		$sql = "SELECT * FROM batches 
					    		WHERE batches.course_id = :value1
					    		ORDER BY batches.startdate DESC";
					    $statement = $conn->prepare($sql);
    					$statement->bindParam(':value1', $courseid);
					    $statement->execute();

					    $batches = $statement->fetchAll();
					    if($batches){
	            	?>
	            	<div class="table-responsive">
	            		<ul class="nav nav-pills mb-3 border-bottom pb-3" id="pills-tab" role="tablist">
						  	
						  	<?php $i=1; foreach($batches as $batch): ?>
						  	<li class="nav-item" role="presentation">
						    	<button class="nav-link" id="pills-<?= $batch['id']; ?>-tab" data-bs-toggle="pill" data-bs-target="#pills-<?= $batch['id']; ?>" type="button" role="tab" aria-controls="pills-<?= $batch['id']; ?>" aria-selected="false">
						    		<?= $batch['name']; ?>
						    	</button>
						  	</li>
						  	<?php endforeach ?>
						</ul>
						<div class="tab-content" id="pills-tabContent">
						  	<?php $i=1; foreach($batches as $batch): ?>
						  		<div class="tab-pane fade" id="pills-<?= $batch['id']; ?>" role="tabpanel" aria-labelledby="pills-<?= $batch['id']; ?>-tab">
						  			<div class="alert alert-secondary" role="alert">
						  				<div class="container">
						  					<div class="row">
						  						<div class="col-6">
													<p>
														<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-event" viewBox="0 0 16 16">
														  	<path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z"/>
														  	<path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
														</svg>

														<?= date('d F Y',strtotime($batch['startdate'])); ?> - 
														<?= date('d F Y',strtotime($batch['enddate'])); ?>
													</p>
													<p>
														<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
														  	<path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
														  	<path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
														</svg>
														<?= date('H:i',strtotime($batch['starttime'])); ?> -
														<?= date('H:i',strtotime($batch['endtime'])); ?>
													</p>
												</div>
						  						<div class="col-6">
													<p>
														<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-video3 me-2" viewBox="0 0 16 16">
														  	<path d="M14 9.5a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm-6 5.7c0 .8.8.8.8.8h6.4s.8 0 .8-.8-.8-3.2-4-3.2-4 2.4-4 3.2Z"/>
														  	<path d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h5.243c.122-.326.295-.668.526-1H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v7.81c.353.23.656.496.91.783.059-.187.09-.386.09-.593V4a2 2 0 0 0-2-2H2Z"/>
														</svg>
														<?php 
										            		$sql = "SELECT * FROM staff 
										            				INNER JOIN batch_staff ON batch_staff.staff_id = staff.id
														    		WHERE batch_staff.batch_id = :value1
														    		ORDER BY batch_staff.staff_id ASC";
														    $statement = $conn->prepare($sql);
									    					$statement->bindParam(':value1', $batch['id']);
														    $statement->execute();

														    $teachers = $statement->fetchAll();
														    if($teachers){
														    foreach($teachers as $teacher){
										            	?>
												            <span class="badge bg-success"> <?= $teacher['name']; ?> </span>
										            	<?php } } ?>
													</p>

												</div>
											</div>
										</div>
						  			</div>
							  		<div class="row">
							  			<div class="col-12">
							  				<div class="table-responsive">
												<table class="table table-bordered">
													<tr>
														<td> Monday </td>
														<?php 
															$day = "Monday";
															$sql = "SELECT schedules.*, staff.name as teacher 	
																	FROM schedules 
																	INNER JOIN staff ON schedules.staff_id = staff.id
														    		WHERE schedules.batch_id = :value1 AND schedules.day = :value2
														    		ORDER BY time_event ASC";
														    $statement = $conn->prepare($sql);
									    					$statement->bindParam(':value1', $batch['id']);
									    					$statement->bindParam(':value2', $day);
														    $statement->execute();

														    $schedules = $statement->fetchAll();
														?>
														<td>
															<div class="container">
																<div class="row">
																	<?php 
																    	foreach($schedules as $schedule){
																	?>

																	<div class="card col-4 mx-3 my-2 p-0" style="border-color: <?= $schedule['color']; ?> ;">
																		<div class="card-header bg-transparent">
																			<?= $schedule['time_event']; ?>
																		</div>
		  																<div class="card-body">
																		  	<p> <?= $schedule['title']; ?> </p>
																		  	<p>
																		  		<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-square" viewBox="0 0 16 16">
																				  	<path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
																				  	<path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12z"/>
																				</svg>
																				<?= $schedule['teacher']; ?>
																		  	</p>
																		</div>
																		<div class="card-footer bg-transparent">
																			<div class="row">
																				<div class="d-grid gap-2 col-6 mx-auto">
																				  	<a href="schedule_edit.php?id=<?= $schedule['id']; ?>" class="btn btn-warning" > Edit </a>
																				</div>
																				<div class="d-grid gap-2 col-6 mx-auto">
																					<form class="d-block" onsubmit="return confirm('Are you sure want to delete?')" action="schedule_delete.php" method="POST">

											                                            <input type="hidden" name="id" value="<?= $id ?>">
											                                            
											                                            <button class="btn btn-danger w-100 fw-normal">
											                                                Delete
											                                            </button>                                            
											                                        </form>
																				</div>
																			</div>
																		</div>
																	</div>

																	<?php } ?>
																</div>
															</div>
															
														</td>
													</tr>
													<tr>
														<td> Tuesday </td>
														<?php 
															$day = "Tuesday";
															$sql = "SELECT schedules.*, staff.name as teacher 	
																	FROM schedules 
																	INNER JOIN staff ON schedules.staff_id = staff.id
														    		WHERE schedules.batch_id = :value1 AND schedules.day = :value2
														    		ORDER BY time_event ASC";
														    $statement = $conn->prepare($sql);
									    					$statement->bindParam(':value1', $batch['id']);
									    					$statement->bindParam(':value2', $day);
														    $statement->execute();

														    $schedules = $statement->fetchAll();
														?>
														<td>
															<div class="container">
																<div class="row">
																	<?php 
																    	foreach($schedules as $schedule){
																	?>

																	<div class="card col-4 mx-3 my-2 p-0" style="border-color: <?= $schedule['color']; ?> ;">
																		<div class="card-header bg-transparent">
																			<?= $schedule['time_event']; ?>
																		</div>
		  																<div class="card-body">
																		  	<p> <?= $schedule['title']; ?> </p>
																		  	<p>
																		  		<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-square" viewBox="0 0 16 16">
																				  	<path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
																				  	<path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12z"/>
																				</svg>
																				<?= $schedule['teacher']; ?>
																		  	</p>
																		</div>
																		<div class="card-footer bg-transparent">
																			<div class="row">
																				<div class="d-grid gap-2 col-6 mx-auto">
																				  	<a href="schedule_edit.php?id=<?= $schedule['id']; ?>" class="btn btn-warning" > Edit </a>
																				</div>
																				<div class="d-grid gap-2 col-6 mx-auto">
																					<form class="d-block" onsubmit="return confirm('Are you sure want to delete?')" action="schedule_delete.php" method="POST">

											                                            <input type="hidden" name="id" value="<?= $id ?>">
											                                            
											                                            <button class="btn btn-danger w-100 fw-normal">
											                                                Delete
											                                            </button>                                            
											                                        </form>
																				</div>
																			</div>
																		</div>
																	</div>

																	<?php } ?>
																</div>
															</div>
															
														</td>
													</tr>
													<tr>
														<td> Wednesday </td>
														<?php 
															$day = "Wednesday";
															$sql = "SELECT schedules.*, staff.name as teacher 	
																	FROM schedules 
																	INNER JOIN staff ON schedules.staff_id = staff.id
														    		WHERE schedules.batch_id = :value1 AND schedules.day = :value2
														    		ORDER BY time_event ASC";
														    $statement = $conn->prepare($sql);
									    					$statement->bindParam(':value1', $batch['id']);
									    					$statement->bindParam(':value2', $day);
														    $statement->execute();

														    $schedules = $statement->fetchAll();
														?>
														<td>
															<div class="container">
																<div class="row">
																	<?php 
																    	foreach($schedules as $schedule){
																	?>

																	<div class="card col-4 mx-3 my-2 p-0" style="border-color: <?= $schedule['color']; ?> ;">
																		<div class="card-header bg-transparent">
																			<?= $schedule['time_event']; ?>
																		</div>
		  																<div class="card-body">
																		  	<p> <?= $schedule['title']; ?> </p>
																		  	<p>
																		  		<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-square" viewBox="0 0 16 16">
																				  	<path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
																				  	<path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12z"/>
																				</svg>
																				<?= $schedule['teacher']; ?>
																		  	</p>
																		</div>
																		<div class="card-footer bg-transparent">
																			<div class="row">
																				<div class="d-grid gap-2 col-6 mx-auto">
																				  	<a href="schedule_edit.php?id=<?= $schedule['id']; ?>" class="btn btn-warning" > Edit </a>
																				</div>
																				<div class="d-grid gap-2 col-6 mx-auto">
																					<form class="d-block" onsubmit="return confirm('Are you sure want to delete?')" action="schedule_delete.php" method="POST">

											                                            <input type="hidden" name="id" value="<?= $id ?>">
											                                            
											                                            <button class="btn btn-danger w-100 fw-normal">
											                                                Delete
											                                            </button>                                            
											                                        </form>
																				</div>
																			</div>
																		</div>
																	</div>

																	<?php } ?>
																</div>
															</div>
															
														</td>
													</tr>
													<tr>
														<td> Thursday </td>
														<?php 
															$day = "Thursday";
															$sql = "SELECT schedules.*, staff.name as teacher 	
																	FROM schedules 
																	INNER JOIN staff ON schedules.staff_id = staff.id
														    		WHERE schedules.batch_id = :value1 AND schedules.day = :value2
														    		ORDER BY time_event ASC";
														    $statement = $conn->prepare($sql);
									    					$statement->bindParam(':value1', $batch['id']);
									    					$statement->bindParam(':value2', $day);
														    $statement->execute();

														    $schedules = $statement->fetchAll();
														?>
														<td>
															<div class="container">
																<div class="row">
																	<?php 
																    	foreach($schedules as $schedule){
																	?>

																	<div class="card col-4 mx-3 my-2 p-0" style="border-color: <?= $schedule['color']; ?> ;">
																		<div class="card-header bg-transparent">
																			<?= $schedule['time_event']; ?>
																		</div>
		  																<div class="card-body">
																		  	<p> <?= $schedule['title']; ?> </p>
																		  	<p>
																		  		<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-square" viewBox="0 0 16 16">
																				  	<path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
																				  	<path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12z"/>
																				</svg>
																				<?= $schedule['teacher']; ?>
																		  	</p>
																		</div>
																		<div class="card-footer bg-transparent">
																			<div class="row">
																				<div class="d-grid gap-2 col-6 mx-auto">
																				  	<a href="schedule_edit.php?id=<?= $schedule['id']; ?>" class="btn btn-warning" > Edit </a>
																				</div>
																				<div class="d-grid gap-2 col-6 mx-auto">
																					<form class="d-block" onsubmit="return confirm('Are you sure want to delete?')" action="schedule_delete.php" method="POST">

											                                            <input type="hidden" name="id" value="<?= $id ?>">
											                                            
											                                            <button class="btn btn-danger w-100 fw-normal">
											                                                Delete
											                                            </button>                                            
											                                        </form>
																				</div>
																			</div>
																		</div>
																	</div>

																	<?php } ?>
																</div>
															</div>
															
														</td>
													</tr>
													<tr>
														<td> Friday </td>
														<?php 
															$day = "Friday";
															$sql = "SELECT schedules.*, staff.name as teacher 	
																	FROM schedules 
																	INNER JOIN staff ON schedules.staff_id = staff.id
														    		WHERE schedules.batch_id = :value1 AND schedules.day = :value2
														    		ORDER BY time_event ASC";
														    $statement = $conn->prepare($sql);
									    					$statement->bindParam(':value1', $batch['id']);
									    					$statement->bindParam(':value2', $day);
														    $statement->execute();

														    $schedules = $statement->fetchAll();
														?>
														<td>
															<div class="container">
																<div class="row">
																	<?php 
																    	foreach($schedules as $schedule){
																	?>

																	<div class="card col-4 mx-3 my-2 p-0" style="border-color: <?= $schedule['color']; ?> ;">
																		<div class="card-header bg-transparent">
																			<?= $schedule['time_event']; ?>
																		</div>
		  																<div class="card-body">
																		  	<p> <?= $schedule['title']; ?> </p>
																		  	<p>
																		  		<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-square" viewBox="0 0 16 16">
																				  	<path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
																				  	<path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12z"/>
																				</svg>
																				<?= $schedule['teacher']; ?>
																		  	</p>
																		</div>
																		<div class="card-footer bg-transparent">
																			<div class="row">
																				<div class="d-grid gap-2 col-6 mx-auto">
																				  	<a href="schedule_edit.php?id=<?= $schedule['id']; ?>" class="btn btn-warning" > Edit </a>
																				</div>
																				<div class="d-grid gap-2 col-6 mx-auto">
																					<form class="d-block" onsubmit="return confirm('Are you sure want to delete?')" action="schedule_delete.php" method="POST">

											                                            <input type="hidden" name="id" value="<?= $id ?>">
											                                            
											                                            <button class="btn btn-danger w-100 fw-normal">
											                                                Delete
											                                            </button>                                            
											                                        </form>
																				</div>
																			</div>
																		</div>
																	</div>

																	<?php } ?>
																</div>
															</div>
															
														</td>
													</tr>
													<tr>
														<td> Saturday </td>
														<?php 
															$day = "Saturday";
															$sql = "SELECT schedules.*, staff.name as teacher 	
																	FROM schedules 
																	INNER JOIN staff ON schedules.staff_id = staff.id
														    		WHERE schedules.batch_id = :value1 AND schedules.day = :value2
														    		ORDER BY time_event ASC";
														    $statement = $conn->prepare($sql);
									    					$statement->bindParam(':value1', $batch['id']);
									    					$statement->bindParam(':value2', $day);
														    $statement->execute();

														    $schedules = $statement->fetchAll();
														?>
														<td>
															<div class="container">
																<div class="row">
																	<?php 
																    	foreach($schedules as $schedule){
																	?>

																	<div class="card col-4 mx-3 my-2 p-0" style="border-color: <?= $schedule['color']; ?> ;">
																		<div class="card-header bg-transparent">
																			<?= $schedule['time_event']; ?>
																		</div>
		  																<div class="card-body">
																		  	<p> <?= $schedule['title']; ?> </p>
																		  	<p>
																		  		<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-square" viewBox="0 0 16 16">
																				  	<path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
																				  	<path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12z"/>
																				</svg>
																				<?= $schedule['teacher']; ?>
																		  	</p>
																		</div>
																		<div class="card-footer bg-transparent">
																			<div class="row">
																				<div class="d-grid gap-2 col-6 mx-auto">
																				  	<a href="schedule_edit.php?id=<?= $schedule['id']; ?>" class="btn btn-warning" > Edit </a>
																				</div>
																				<div class="d-grid gap-2 col-6 mx-auto">
																					<form class="d-block" onsubmit="return confirm('Are you sure want to delete?')" action="schedule_delete.php" method="POST">

											                                            <input type="hidden" name="id" value="<?= $id ?>">
											                                            
											                                            <button class="btn btn-danger w-100 fw-normal">
											                                                Delete
											                                            </button>                                            
											                                        </form>
																				</div>
																			</div>
																		</div>
																	</div>

																	<?php } ?>
																</div>
															</div>
															
														</td>
													</tr>
													<tr>
														<td> Sunday </td>
														<?php 
															$day = "Sunday";
															$sql = "SELECT schedules.*, staff.name as teacher 	
																	FROM schedules 
																	INNER JOIN staff ON schedules.staff_id = staff.id
														    		WHERE schedules.batch_id = :value1 AND schedules.day = :value2
														    		ORDER BY time_event ASC";
														    $statement = $conn->prepare($sql);
									    					$statement->bindParam(':value1', $batch['id']);
									    					$statement->bindParam(':value2', $day);
														    $statement->execute();

														    $schedules = $statement->fetchAll();
														?>
														<td>
															<div class="container">
																<div class="row">
																	<?php 
																    	foreach($schedules as $schedule){
																	?>

																	<div class="card col-4 mx-3 my-2 p-0" style="border-color: <?= $schedule['color']; ?> ;">
																		<div class="card-header bg-transparent">
																			<?= $schedule['time_event']; ?>
																		</div>
		  																<div class="card-body">
																		  	<p> <?= $schedule['title']; ?> </p>
																		  	<p>
																		  		<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-square" viewBox="0 0 16 16">
																				  	<path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
																				  	<path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12z"/>
																				</svg>
																				<?= $schedule['teacher']; ?>
																		  	</p>
																		</div>
																		<div class="card-footer bg-transparent">
																			<div class="row">
																				<div class="d-grid gap-2 col-6 mx-auto">
																				  	<a href="schedule_edit.php?id=<?= $schedule['id']; ?>" class="btn btn-warning" > Edit </a>
																				</div>
																				<div class="d-grid gap-2 col-6 mx-auto">
																					<form class="d-block" onsubmit="return confirm('Are you sure want to delete?')" action="schedule_delete.php" method="POST">

											                                            <input type="hidden" name="id" value="<?= $id ?>">
											                                            
											                                            <button class="btn btn-danger w-100 fw-normal">
											                                                Delete
											                                            </button>                                            
											                                        </form>
																				</div>
																			</div>
																		</div>
																	</div>

																	<?php } ?>
																</div>
															</div>
															
														</td>
													</tr>
												</table>
											</div>
							  			</div>
							  		</div>	
						  		</div>


						  	<?php endforeach ?>


						</div>
		            </div>
		        	<?php } else{ ?>

		        		<p> There is no class added in this course. </p>

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

	            	<div class="alert alert-secondary" role="alert">
		  				<div class="container">
		  					<div class="row">
		  						<div class="col-6">
									<p>
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-event" viewBox="0 0 16 16">
										  	<path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z"/>
										  	<path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
										</svg>

										<?= date('d F Y',strtotime($course['bstartdate'])); ?> - 
										<?= date('d F Y',strtotime($course['benddate'])); ?>
									</p>
									<p>
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
										  	<path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
										  	<path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
										</svg>
										<?= date('H:i',strtotime($course['bstarttime'])); ?> -
										<?= date('H:i',strtotime($course['bendtime'])); ?>
									</p>
								</div>
		  						<div class="col-6">
									<p>
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-video3 me-2" viewBox="0 0 16 16">
										  	<path d="M14 9.5a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm-6 5.7c0 .8.8.8.8.8h6.4s.8 0 .8-.8-.8-3.2-4-3.2-4 2.4-4 3.2Z"/>
										  	<path d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h5.243c.122-.326.295-.668.526-1H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v7.81c.353.23.656.496.91.783.059-.187.09-.386.09-.593V4a2 2 0 0 0-2-2H2Z"/>
										</svg>
										<?php 
						            		$sql = "SELECT * FROM staff 
						            				INNER JOIN batch_staff ON batch_staff.staff_id = staff.id
										    		WHERE batch_staff.batch_id = :value1
										    		ORDER BY batch_staff.staff_id ASC";
										    $statement = $conn->prepare($sql);
					    					$statement->bindParam(':value1', $course['bid']);
										    $statement->execute();

										    $teachers = $statement->fetchAll();
										    if($teachers){
										    foreach($teachers as $teacher){
						            	?>
								            <span class="badge bg-success"> <?= $teacher['name']; ?> </span>
						            	<?php } } ?>
									</p>

								</div>
							</div>
						</div>
		  			</div>
			  		<div class="row">
			  			<div class="col-12">
			  				<div class="table-responsive">
								<table class="table table-bordered">
									<tr>
										<td> Monday </td>
										<?php 
											$day = "Monday";
											$sql = "SELECT schedules.*, staff.name as teacher 	
													FROM schedules 
													INNER JOIN staff ON schedules.staff_id = staff.id
										    		WHERE schedules.batch_id = :value1 AND schedules.day = :value2
										    		ORDER BY time_event ASC";
										    $statement = $conn->prepare($sql);
					    					$statement->bindParam(':value1', $course['bid']);
					    					$statement->bindParam(':value2', $day);
										    $statement->execute();

										    $schedules = $statement->fetchAll();
										?>
										<td>
											<div class="container">
												<div class="row">
													<?php 
												    	foreach($schedules as $schedule){
													?>

													<div class="card col-4 mx-3 my-2 p-0" style="border-color: <?= $schedule['color']; ?> ;">
														<div class="card-header bg-transparent">
															<?= $schedule['time_event']; ?>
														</div>
															<div class="card-body">
														  	<p> <?= $schedule['title']; ?> </p>
														  	<p>
														  		<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-square" viewBox="0 0 16 16">
																  	<path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
																  	<path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12z"/>
																</svg>
																<?= $schedule['teacher']; ?>
														  	</p>
														</div>
													</div>

													<?php } ?>
												</div>
											</div>
											
										</td>
									</tr>
									<tr>
										<td> Tuesday </td>
										<?php 
											$day = "Tuesday";
											$sql = "SELECT schedules.*, staff.name as teacher 	
													FROM schedules 
													INNER JOIN staff ON schedules.staff_id = staff.id
										    		WHERE schedules.batch_id = :value1 AND schedules.day = :value2
										    		ORDER BY time_event ASC";
										    $statement = $conn->prepare($sql);
					    					$statement->bindParam(':value1', $course['bid']);
					    					$statement->bindParam(':value2', $day);
										    $statement->execute();

										    $schedules = $statement->fetchAll();
										?>
										<td>
											<div class="container">
												<div class="row">
													<?php 
												    	foreach($schedules as $schedule){
													?>

													<div class="card col-4 mx-3 my-2 p-0" style="border-color: <?= $schedule['color']; ?> ;">
														<div class="card-header bg-transparent">
															<?= $schedule['time_event']; ?>
														</div>
															<div class="card-body">
														  	<p> <?= $schedule['title']; ?> </p>
														  	<p>
														  		<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-square" viewBox="0 0 16 16">
																  	<path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
																  	<path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12z"/>
																</svg>
																<?= $schedule['teacher']; ?>
														  	</p>
														</div>
													</div>

													<?php } ?>
												</div>
											</div>
											
										</td>
									</tr>
									<tr>
										<td> Wednesday </td>
										<?php 
											$day = "Wednesday";
											$sql = "SELECT schedules.*, staff.name as teacher 	
													FROM schedules 
													INNER JOIN staff ON schedules.staff_id = staff.id
										    		WHERE schedules.batch_id = :value1 AND schedules.day = :value2
										    		ORDER BY time_event ASC";
										    $statement = $conn->prepare($sql);
					    					$statement->bindParam(':value1', $course['bid']);
					    					$statement->bindParam(':value2', $day);
										    $statement->execute();

										    $schedules = $statement->fetchAll();
										?>
										<td>
											<div class="container">
												<div class="row">
													<?php 
												    	foreach($schedules as $schedule){
													?>

													<div class="card col-4 mx-3 my-2 p-0" style="border-color: <?= $schedule['color']; ?> ;">
														<div class="card-header bg-transparent">
															<?= $schedule['time_event']; ?>
														</div>
															<div class="card-body">
														  	<p> <?= $schedule['title']; ?> </p>
														  	<p>
														  		<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-square" viewBox="0 0 16 16">
																  	<path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
																  	<path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12z"/>
																</svg>
																<?= $schedule['teacher']; ?>
														  	</p>
														</div>
													</div>

													<?php } ?>
												</div>
											</div>
											
										</td>
									</tr>
									<tr>
										<td> Thursday </td>
										<?php 
											$day = "Thursday";
											$sql = "SELECT schedules.*, staff.name as teacher 	
													FROM schedules 
													INNER JOIN staff ON schedules.staff_id = staff.id
										    		WHERE schedules.batch_id = :value1 AND schedules.day = :value2
										    		ORDER BY time_event ASC";
										    $statement = $conn->prepare($sql);
					    					$statement->bindParam(':value1', $course['bid']);
					    					$statement->bindParam(':value2', $day);
										    $statement->execute();

										    $schedules = $statement->fetchAll();
										?>
										<td>
											<div class="container">
												<div class="row">
													<?php 
												    	foreach($schedules as $schedule){
													?>

													<div class="card col-4 mx-3 my-2 p-0" style="border-color: <?= $schedule['color']; ?> ;">
														<div class="card-header bg-transparent">
															<?= $schedule['time_event']; ?>
														</div>
															<div class="card-body">
														  	<p> <?= $schedule['title']; ?> </p>
														  	<p>
														  		<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-square" viewBox="0 0 16 16">
																  	<path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
																  	<path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12z"/>
																</svg>
																<?= $schedule['teacher']; ?>
														  	</p>
														</div>
													</div>

													<?php } ?>
												</div>
											</div>
											
										</td>
									</tr>
									<tr>
										<td> Friday </td>
										<?php 
											$day = "Friday";
											$sql = "SELECT schedules.*, staff.name as teacher 	
													FROM schedules 
													INNER JOIN staff ON schedules.staff_id = staff.id
										    		WHERE schedules.batch_id = :value1 AND schedules.day = :value2
										    		ORDER BY time_event ASC";
										    $statement = $conn->prepare($sql);
					    					$statement->bindParam(':value1', $course['bid']);
					    					$statement->bindParam(':value2', $day);
										    $statement->execute();

										    $schedules = $statement->fetchAll();
										?>
										<td>
											<div class="container">
												<div class="row">
													<?php 
												    	foreach($schedules as $schedule){
													?>

													<div class="card col-4 mx-3 my-2 p-0" style="border-color: <?= $schedule['color']; ?> ;">
														<div class="card-header bg-transparent">
															<?= $schedule['time_event']; ?>
														</div>
															<div class="card-body">
														  	<p> <?= $schedule['title']; ?> </p>
														  	<p>
														  		<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-square" viewBox="0 0 16 16">
																  	<path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
																  	<path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12z"/>
																</svg>
																<?= $schedule['teacher']; ?>
														  	</p>
														</div>
													</div>

													<?php } ?>
												</div>
											</div>
											
										</td>
									</tr>
									<tr>
										<td> Saturday </td>
										<?php 
											$day = "Saturday";
											$sql = "SELECT schedules.*, staff.name as teacher 	
													FROM schedules 
													INNER JOIN staff ON schedules.staff_id = staff.id
										    		WHERE schedules.batch_id = :value1 AND schedules.day = :value2
										    		ORDER BY time_event ASC";
										    $statement = $conn->prepare($sql);
					    					$statement->bindParam(':value1', $course['bid']);
					    					$statement->bindParam(':value2', $day);
										    $statement->execute();

										    $schedules = $statement->fetchAll();
										?>
										<td>
											<div class="container">
												<div class="row">
													<?php 
												    	foreach($schedules as $schedule){
													?>

													<div class="card col-4 mx-3 my-2 p-0" style="border-color: <?= $schedule['color']; ?> ;">
														<div class="card-header bg-transparent">
															<?= $schedule['time_event']; ?>
														</div>
															<div class="card-body">
														  	<p> <?= $schedule['title']; ?> </p>
														  	<p>
														  		<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-square" viewBox="0 0 16 16">
																  	<path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
																  	<path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12z"/>
																</svg>
																<?= $schedule['teacher']; ?>
														  	</p>
														</div>
													</div>

													<?php } ?>
												</div>
											</div>
											
										</td>
									</tr>
									<tr>
										<td> Sunday </td>
										<?php 
											$day = "Sunday";
											$sql = "SELECT schedules.*, staff.name as teacher 	
													FROM schedules 
													INNER JOIN staff ON schedules.staff_id = staff.id
										    		WHERE schedules.batch_id = :value1 AND schedules.day = :value2
										    		ORDER BY time_event ASC";
										    $statement = $conn->prepare($sql);
					    					$statement->bindParam(':value1', $course['bid']);
					    					$statement->bindParam(':value2', $day);
										    $statement->execute();

										    $schedules = $statement->fetchAll();
										?>
										<td>
											<div class="container">
												<div class="row">
													<?php 
												    	foreach($schedules as $schedule){
													?>

													<div class="card col-4 mx-3 my-2 p-0" style="border-color: <?= $schedule['color']; ?> ;">
														<div class="card-header bg-transparent">
															<?= $schedule['time_event']; ?>
														</div>
															<div class="card-body">
														  	<p> <?= $schedule['title']; ?> </p>
														  	<p>
														  		<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-square" viewBox="0 0 16 16">
																  	<path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
																  	<path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12z"/>
																</svg>
																<?= $schedule['teacher']; ?>
														  	</p>
														</div>
													</div>

													<?php } ?>
												</div>
											</div>
											
										</td>
									</tr>
								</table>
							</div>
			  			</div>
			  		</div>	
	            	
	            </div>
	        </div>
	    </div>
		<?php } ?>
	    
	</div>

	<?php endif; ?>

<?php 
	require 'backend_footer.php';
?>