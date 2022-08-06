<?php 
	require 'backend_header.php';
	require 'connection.php';

    $login_user_type =$_SESSION['login_user_type'];
    $login_user_id =$_SESSION['login_user']['id'];

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
?>
	<div class="row g-3 mb-4 align-items-center justify-content-between">
	    <div class="col-auto">
	        <h1 class="app-page-title mb-0"> Grading </h1>
	    </div>
	</div>


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
							                <th>Grading</th>
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
							        			<?php 
							        				$sql = "SELECT * FROM assignment_grading 
														WHERE student_id =:value1 AND assignment_id=:value2 ";
												    $statement = $conn->prepare($sql);
												    $statement->bindParam(':value1', $login_user_id);
												    $statement->bindParam(':value2', $assignment['id']);

												    $statement->execute();
												    $assignment_grading = $statement->fetch(PDO::FETCH_ASSOC);
													if($assignment_grading):

							        			?>
							        			<p class="fs-5"> <strong> <?= $assignment_grading['mark']; ?> </strong> </p>

							        			<small>
							        				Notes: <?= $assignment_grading['note']; ?>
							        			</small>

							        			<?php endif; ?>

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


<?php 
	require 'backend_footer.php';
?>