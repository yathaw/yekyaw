<?php 
	require 'backend_header.php';
	require 'connection.php';

	$sql = "SELECT courses.*, subcategories.name as sname 
    		FROM courses 
    		INNER JOIN subcategories ON courses.subcategory_id = subcategories.id
    		ORDER BY created_at DESC";
    $statement = $conn->prepare($sql);
    $statement->execute();

    $courses = $statement->fetchAll();
?>
	<div class="row g-3 mb-4 align-items-center justify-content-between">
	    <div class="col-auto">
	        <h1 class="app-page-title mb-0"> Classes </h1>
	    </div>
	    <div class="col-auto">
	    	<div class="card-header-action">
		        <a href="class_new.php" class="btn app-btn-secondary text-decoration-none"> Create New </a>
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
		            	<table class="datatables table table-bordered table-striped">
		            		<thead class="bg-success">
					            <tr>
					                <th>#</th>
					                <th>Name</th>
					                <th>Date</th>
					                <th>Time</th>
					                <th>Teacher</th>
					                <th>Action</th>
					            </tr>
					        </thead>
					        <tbody>
					        	<?php $i=1; foreach($batches as $batch): ?>
					        	<tr>
					        		<td> <?= $i++; ?>. </td>
					        		<td> <?= $batch['name']; ?> </td>
					        		<td>
					        			<p> Start: <?= date('d F Y',strtotime($batch['startdate'])); ?> </p>
					        			<p> End: <?= date('d F Y',strtotime($batch['enddate'])); ?> </p>
					        		</td>
					        		<td>
					        			<p> Start: <?= date('H:i',strtotime($batch['starttime'])); ?> </p>
					        			<p> End: <?= date('H:i',strtotime($batch['endtime'])); ?> </p>
					        		</td>
					        		<td>
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
						            	<span class="badge rounded-pill bg-secondary"> <?= $teacher['name']; ?> </span> <br>

						            	<?php } } ?>
					        		</td>
					        		<td>
					        			<a href="class_edit.php?id=<?= $batch['id']; ?>" class="btn btn-warning fw-normal">
                                        	Edit
                                        </a>

                                        <form class="d-inline-block" onsubmit="return confirm('Are you sure want to delete?')" action="class_delete.php" method="POST">

                                            <input type="hidden" name="id" value="<?= $batch['id']; ?>">
                                            
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

		        		<p> There is no class added in this course. </p>

	                <?php } ?>
	            </div>
	        </div>
	    </div>
		<?php } ?>
	    
	</div>
<?php 
	require 'backend_footer.php';
?>