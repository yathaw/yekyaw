<?php 
	require 'backend_header.php';
	require 'connection.php';

	$id = $_GET['id'];
	$sql = "SELECT coursework.*, courses.title as course, courses.codeno as codeno, staff.name as staffname  
			FROM coursework 
			INNER JOIN courses ON coursework.course_id = courses.id
			INNER JOIN staff ON coursework.created_by = staff.id
    		WHERE coursework.id = :value1";	
    $statement = $conn->prepare($sql);
	$statement->bindParam(':value1', $id);
    $statement->execute();
    $coursework = $statement->fetch(PDO::FETCH_ASSOC);

    $coursename = $coursework['course'];
    $coursecodeno = $coursework['codeno'];
    $courseworktitle = $coursework['title'];
    $semester = $coursework['semester'];
    $staffname = $coursework['staffname'];

    $sql = "SELECT batches.id as bid, batches.name as bname 
    		FROM batch_coursework 
    		INNER JOIN batches ON batch_coursework.batch_id = batches.id
    		WHERE batch_coursework.coursework_id=:value1";
  	$statement = $conn->prepare($sql);
  	$statement->bindParam(':value1', $id);
  	$statement->execute();

  	$batches_coursework = $statement->fetchAll();

  	$sql = "SELECT assignment.*, staff.name as staffname 
			FROM assignment 
			INNER JOIN staff ON assignment.created_by = staff.id
			WHERE assignment.coursework_id = :value1";
	$statement = $conn->prepare($sql);
	$statement->bindParam(':value1', $id);
	$statement->execute();

	$assignments = $statement->fetchAll();
?>
	
	<div class="row g-3 mb-4 align-items-center justify-content-between">
	    <div class="col-auto">
	        <h1 class="app-page-title mb-0"> <?= $courseworktitle; ?>  </h1>
	        <h6> <?= $coursename; ?> </h6>
	    </div>
	    <div class="col-auto">
	    	<div class="card-header-action">
		        <a href="coursework_list.php" class="btn app-btn-secondary text-decoration-none"> Go Back </a>
	        </div>
	    </div>
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

	<div class="row gy-4">
	    <div class="col-4">
	        <div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
	            <div class="app-card-header p-3 border-bottom-0">
	                <div class="row align-items-center gx-3">
	                    <div class="col-auto">
	                        <div class="app-icon-holder">
	                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-lg" viewBox="0 0 16 16">
								  	<path d="m9.708 6.075-3.024.379-.108.502.595.108c.387.093.464.232.38.619l-.975 4.577c-.255 1.183.14 1.74 1.067 1.74.72 0 1.554-.332 1.933-.789l.116-.549c-.263.232-.65.325-.905.325-.363 0-.494-.255-.402-.704l1.323-6.208Zm.091-2.755a1.32 1.32 0 1 1-2.64 0 1.32 1.32 0 0 1 2.64 0Z"/>
								</svg>
	                        </div>
	                        <!--//icon-holder-->
	                    </div>
	                    <!--//col-->
	                    <div class="col-auto">
	                        <h4 class="app-card-title">Info</h4>
	                    </div>
	                    <!--//col-->
	                </div>
	                <!--//row-->
	            </div>
	            <!--//app-card-header-->
	            <div class="app-card-body px-4 w-100">
	            	<div class="item border-bottom py-3">
					    <div class="row justify-content-between align-items-center">
						    <div class="col-auto">
							    <div class="item-label"><strong>Title</strong></div>
						        <div class="item-data"> <?= $courseworktitle; ?> </div>
						    </div>
					    </div><!--//row-->
				    </div>

				    <div class="item border-bottom py-3">
					    <div class="row justify-content-between align-items-center">
						    <div class="col-auto">
							    <div class="item-label"><strong>Semester</strong></div>
						        <div class="item-data"> <?= $semester; ?> </div>
						    </div>
					    </div><!--//row-->
				    </div>

	            	<div class="item border-bottom py-3">
					    <div class="row justify-content-between align-items-center">
						    <div class="col-auto">
							    <div class="item-label"><strong>Course Name</strong></div>
						        <div class="item-data"> <?= $coursename; ?> ( <?= $coursecodeno; ?> ) </div>
						    </div>
					    </div><!--//row-->
				    </div>
	                <div class="item border-bottom py-3">
					    <div class="row justify-content-between align-items-center">
						    <div class="col-auto">
							    <div class="item-label"><strong>Batches</strong></div>
						        <div class="item-data">
						        	<?php foreach($batches_coursework as $bc): ?>
							        	<span class="badge bg-secondary"><?= $bc['bname']; ?></span>
							    	<?php endforeach ?>
						        </div>
						    </div><!--//col-->
					    </div><!--//row-->
				    </div>
				    <div class="item border-bottom py-3">
					    <div class="row justify-content-between align-items-center">
						    <div class="col-auto">
							    <div class="item-label"><strong>Created By</strong></div>
						        <div class="item-data">
							        <?= $staffname; ?>
						        </div>
						    </div><!--//col-->
					    </div><!--//row-->
				    </div>
	            </div>
	            <!--//app-card-body-->
	        </div>
	    </div>

	    <div class="col-8">
	        <div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
	            <div class="app-card-header p-3 border-bottom-0 col-12">
	                <div class="row justify-content-between align-items-center gx-3">
	                    <div class="col-auto">
	                        <div class="app-icon-holder">
	                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
								  	<path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
								  	<path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
								</svg>
	                        </div>
	                        <!--//icon-holder-->
	                    </div>
	                    <!--//col-->
	                    <div class="col-auto">
	                        <h4 class="app-card-title">Assignments</h4>
	                    </div>
	                    <!--//col-->
	                    <div class="col text-end">
	                        <a class="btn-sm app-btn-secondary" href="assignment_new.php?id=<?= $id; ?>"> Add New </a>
	                    </div>
	                </div>
	                <!--//row-->
	            </div>
	            <!--//app-card-header-->
	            <div class="app-card-body px-4 w-100">
	                <?php 
	            		
					    if($assignments){
	            	?>
	            	<div class="table-responsive">
		            	<table class="datatables table table-bordered table-striped">
		            		<thead class="bg-success">
					            <tr>
					                <th>#</th>
					                <th>Title</th>
					                <th>Description</th>
					                <th>End Date</th>
					                <th>Created By</th>
					                <th>Action</th>
					            </tr>
					        </thead>
					        <tbody>
					        	<?php $i=1; foreach($assignments as $assignment): ?>
					        	<tr>
					        		<td> <?= $i++; ?>. </td>
					        		<td> <?= $assignment['name']; ?> </td>
					        		<td> <?= $assignment['description']; ?> </td>
					        		<td> <?= date('d F Y',strtotime($assignment['enddate'])); ?> </td>
					        		<td>
					        			<?= $assignment['staffname']; ?>
					        		</td>
					        		
					        		<td>
					        			<a href="<?= $assignment['file'] ?>" target="_blank" class="btn btn-primary fw-normal" download>
						                	Download 
						                </a>

					        			<a href="assignment_edit.php?id=<?= $assignment['id']; ?>" class="btn btn-warning fw-normal">
                                        	Edit
                                        </a>

                                        <form class="d-inline-block" onsubmit="return confirm('Are you sure want to delete?')" action="assignment_delete.php" method="POST">

                                            <input type="hidden" name="id" value="<?= $assignment['id']; ?>">
                                            <input type="hidden" name="courseworkid" value="<?= $assignment['coursework_id']; ?>">
                                            
                                            <button class="btn btn-danger fw-normal">
                                                Delete
                                            </button>                                            
                                        </form>
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
	            <!--//app-card-body-->
	        </div>
	    </div>

	    <div class="col-12">
	        <div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
	        	<div class="app-card-body p-4 w-100">
		        	<?php foreach($batches_coursework as $key => $bc): ?>
		        		<div class="accordion" id="accordionExample">
						    <div class="accordion-item">
						        <h2 class="accordion-header" id="heading<?= $bc['bid']; ?>">
						            <button class="accordion-button <?php if($key !=0){ echo "collapsed"; } ?> " type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $bc['bid']; ?>" aria-expanded="<?php if($key ==0){ echo "true"; } else { echo "false"; } ?>" aria-controls="collapse<?= $bc['bid']; ?>">
						            	<?= $bc['bname']; ?>
						            </button>
						        </h2>
						        <div id="collapse<?= $bc['bid']; ?>" class="accordion-collapse collapse <?php if($key ==0){ echo "show"; } ?>" aria-labelledby="heading<?= $bc['bid']; ?>" data-bs-parent="#accordionExample">
						            <div class="accordion-body">
						            	<?php 
										    if($assignments){
						            	?>
						                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
						                	<?php foreach($assignments as $assignment){ ?>
										  	<li class="nav-item" role="presentation">
										    	<button class="nav-link" id="pills-<?= $assignment['id']; ?>-tab" data-bs-toggle="pill" data-bs-target="#pills-<?= $assignment['id']; ?>" type="button" role="tab" aria-controls="pills-<?= $assignment['id']; ?>" aria-selected="false">
										    		<?= $assignment['name']; ?>
										    	</button>
										  	</li>
											<?php } ?>
										</ul>
										<div class="tab-content" id="pills-tabContent">
						                	<?php foreach($assignments as $assignment){ ?>

											  	<div class="tab-pane fade" id="pills-<?= $assignment['id'] ?>" role="tabpanel" aria-labelledby="pills-<?= $assignment['id'] ?>-tab">
											  		<div class="row">
														<div class="col-12">
															<div class="table-responsive">
																<form action="grade_add.php" method="POST">
																	<input type="hidden" name="assignmentid" value="<?= $assignment['id']; ?>">
																	<input type="hidden" name="courseworkid" value="<?= $id; ?>">

																<table class="table align-middle">
																	<thead>
																		<tr>
																			<th> No </th>
																			<th> Name </th>
																			<th> File </th>
																			<th> Status </th>
																		</tr>
																	</thead>
																	<tbody>
																		<?php 
																			$sql = "SELECT students.*, enroll.paymentstatus as paymentstatus, enroll.registerdate as registerdate, enroll.status as studentstatus FROM students 
														            				INNER JOIN enroll ON students.id = enroll.student_id
																		    		WHERE enroll.batch_id = :value1
																		    		ORDER BY enroll.registerdate ASC";
																		    $statement = $conn->prepare($sql);
													    					$statement->bindParam(':value1', $bc['bid']);
																		    $statement->execute();

																		    $students = $statement->fetchAll();
																		    $i=1;
																		    if($students){
																		    foreach($students as $student){
																		    
																		?>
																		<tr class="<?php if($student['studentstatus'] == 0){ echo 'bg-danger'; } ?>" >
																			<input type="hidden" name="students[]" value="<?= $student['id']; ?>">
																			<td> <?= $i++; ?></td>
																			<td> <?= $student['name']; ?> </td>
																			<td> 
																				<?php 
																                	$sql = "SELECT * FROM assignment_submission 
																						WHERE student_id =:value1 AND assignment_id=:value2";
																				    $statement = $conn->prepare($sql);
																				    $statement->bindParam(':value1', $student['id']);
																				    $statement->bindParam(':value2', $assignment['id']);
																				    $statement->execute();
																				    $assignment_submission = $statement->fetch(PDO::FETCH_ASSOC);
																				    if($assignment_submission){
																                ?>
																                	<a href="<?= $assignment_submission['file']; ?>" target="_blank" download class="btn-sm app-btn-secondary" > Download </a>
																                <?php
																				    echo "<span class='small d-block mt-2'> <small class='text-muted'>  Uploaded: </small> ".date('d F Y',strtotime($assignment_submission['uploaddate']))."</span>";
																				    }
																                ?>
																				<input type="hidden" name="assignment_submission_ids[]" value="<?= $assignment_submission['id']; ?>">

																			</td>
																			<td>
																				<?php 
																					if($assignment_submission){ 

																                	$sql = "SELECT * FROM assignment_grading 
																						WHERE student_id =:value1 AND assignment_id=:value2 AND assignment_submission_id=:value3";
																				    $statement = $conn->prepare($sql);
																				    $statement->bindParam(':value1', $student['id']);
																				    $statement->bindParam(':value2', $assignment['id']);
																				    $statement->bindParam(':value3', $assignment_submission['id']);

																				    $statement->execute();
																				    $assignment_grading = $statement->fetch(PDO::FETCH_ASSOC);
																				?>
																				<div class="input-group mb-3">
																				  	<span class="input-group-text" id="basic-addon1">
																				  		<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
																						  	<path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
																						</svg>
																				  	</span>
																				  	<input type="text" class="form-control" placeholder="Marks" name="marks[]" value="<?php if($assignment_grading){ echo $assignment_grading['mark']; } ?>">
																				</div>

																				<div class="input-group mb-3">
																				  	<span class="input-group-text" id="basic-addon1">
																				  		<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tag-fill" viewBox="0 0 16 16">
																						  	<path d="M2 1a1 1 0 0 0-1 1v4.586a1 1 0 0 0 .293.707l7 7a1 1 0 0 0 1.414 0l4.586-4.586a1 1 0 0 0 0-1.414l-7-7A1 1 0 0 0 6.586 1H2zm4 3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
																						</svg>
																				  	</span>
																				  	<input type="text" class="form-control" placeholder="Notes" name="notes[]" value="<?php if($assignment_grading){ echo $assignment_grading['note']; } ?>">
																				</div>
																				<?php } ?>
																			</td>
																		</tr>
																		<?php } } ?>
																	</tbody>
																	<tfoot>
																		<tr>
																			<td colspan="5" class="justify-content-end text-end"> 
																				
																				<button type="submit" class="btn btn-success" > Save </button>
																			</td>
																		</tr>
																	</tfoot>
																</table>
															</form>
														</div>
														</div>
													</div>
											  	</div>
											<?php } ?>

										</div>
										<?php } ?>
						            </div>
						        </div>
						    </div>
						</div>
					<?php endforeach ?>
				</div>
	        </div>
	    </div>

	</div>

<?php 
	require 'backend_footer.php';
?>