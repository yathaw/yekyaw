<?php 
	require 'backend_header.php';
	require 'connection.php';

	$id = $_GET['id'];

	$sql = "SELECT * FROM students 
    		WHERE id = :value1";
    $statement = $conn->prepare($sql);
    $statement->bindParam(':value1', $id);
    $statement->execute();
    $student = $statement->fetch(PDO::FETCH_ASSOC);

    $sql = "SELECT courses.id as cid, courses.title, courses.codeno, batches.name, batches.id as bid 
    		FROM courses
    		INNER JOIN batches ON courses.id = batches.course_id
    		INNER JOIN enroll ON batches.id = enroll.batch_id
    		WHERE enroll.student_id =:value2";
   	$statement = $conn->prepare($sql);
    $statement->bindParam(':value2', $id);
    $statement->execute();
    $courses = $statement->fetchAll();

?>
	<div class="row g-3 mb-4 align-items-center justify-content-between">
	    <div class="col-auto">
	        <h1 class="app-page-title mb-0"> <?= $student['name']; ?> Detail </h1>
	    </div>
	    <div class="col-auto">
	    	<div class="card-header-action">
		        <a href="student_list.php" class="btn app-btn-secondary text-decoration-none"> Go Back </a>
	        </div>
	    </div>
	</div>

	<div class="row gy-4">
	    <div class="col-12">
	        <div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
	            <div class="app-card-header p-3 border-bottom-0">
	                <div class="row align-items-center gx-3">
	                    <div class="col-auto">
	                        <div class="app-icon-holder">
	                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
	                                <path fill-rule="evenodd" d="M10 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
	                            </svg>
	                        </div>
	                        <!--//icon-holder-->
	                    </div>
	                    <!--//col-->
	                    <div class="col-auto">
	                        <h4 class="app-card-title">Profile</h4>
	                    </div>
	                    <!--//col-->
	                </div>
	                <!--//row-->
	            </div>
	            <!--//app-card-header-->
	            <div class="app-card-body px-4 w-100">
	                <div class="item border-bottom py-3">
	                    <div class="row justify-content-between align-items-center">
	                        <div class="col-4">
	                            <div class="item-label mb-2"><strong>Photo</strong></div>
	                            <div class="item-data">
	                            	<img class="profile-image" src="<?= $student['profile']; ?>" alt="">
	                            </div>
	                        </div>
	                        <div class="col-8">
	                        	<div class="mb-3">
	                        		<div class="item-label">
	                        			<strong>Name:</strong>
	                        			<?= $student['name']; ?>
	                        		</div>
	                        	</div>
	                        	<div class="mb-3">
	                        		<div class="item-label">
	                        			<strong>Email</strong>
	                        			<?= $student['email']; ?>
	                        		</div>
	                        	</div>
	                        	<div class="mb-3">
	                        		<div class="item-label">
	                        			<strong>Phone</strong>
	                        			<?= $student['phone']; ?>
	                        		</div>
	                        	</div>
	                        	<div class="mb-3">
	                        		<div class="item-label">
	                        			<strong>Location</strong>
		                                <?= $student['address']; ?>
	                        		</div>
	                        	</div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	            <!--//app-card-body-->
	        </div>
	    </div>
	    <div class="col-12">
	        <div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
	            <div class="app-card-header p-3 border-bottom-0">
	                <div class="row align-items-center gx-3">
	                    <div class="col-auto">
	                        <div class="app-icon-holder">
	                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-sliders" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
	                                <path fill-rule="evenodd" d="M11.5 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM9.05 3a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0V3h9.05zM4.5 7a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM2.05 8a2.5 2.5 0 0 1 4.9 0H16v1H6.95a2.5 2.5 0 0 1-4.9 0H0V8h2.05zm9.45 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm-2.45 1a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0v-1h9.05z"/>
	                            </svg>
	                        </div>
	                    </div>
	                    <div class="col-auto">
	                        <h4 class="app-card-title"> Attend Courses </h4>

	                        

	                    </div>
	                </div>
	            </div>
	            <div class="app-card-body px-4 w-100">
	            	<div class="accordion pb-3" id="accordionExample">
                    	<?php 
                    		foreach($courses as $key => $course){ 
                    			$cid = $course['cid'];
                    			$batchid = $course['bid'];
                    	?>
						<div class="accordion-item">
						    <h2 class="accordion-header" id="heading<?= $cid; ?>">
						      	<button class="accordion-button <?php if($key !=0){ echo 'collapsed'; } ?> " type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $cid; ?>" aria-expanded="<?php if($key == 0){ echo 'true'; }else{ echo 'false'; } ?>" aria-controls="collapse<?= $cid; ?>">
						        	<div class="row">
							            <div class="col-auto">
						            		<div class="title mb-1 "> <?= $course['title']; ?> </div>
						            		<div class="small">
								            	<small> <?= $course['codeno']; ?> </small> |
								            	<small> <?= $course['name'] ?> </small>
								            </div>
						        		</div>
							            <div class="col-auto">
							            	
							            </div>
						        	</div>
						      	</button>
						    </h2>
						    <div id="collapse<?= $cid; ?>" class="accordion-collapse collapse <?php if($key ==0){ echo 'show'; } ?>" aria-labelledby="heading<?= $cid; ?>" data-bs-parent="#accordionExample">
						      	<div class="accordion-body">
						        	<nav>
									  	<div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
									    	<button class="nav-link active" id="nav-payment-tab" data-bs-toggle="tab" data-bs-target="#nav-payment" type="button" role="tab" aria-controls="nav-payment" aria-selected="true"> Payment </button>
									    	<button class="nav-link" id="nav-attendance-tab" data-bs-toggle="tab" data-bs-target="#nav-attendance" type="button" role="tab" aria-controls="nav-attendance" aria-selected="false"> Attendance </button>
									    	<button class="nav-link" id="nav-result-tab" data-bs-toggle="tab" data-bs-target="#nav-result" type="button" role="tab" aria-controls="nav-result" aria-selected="false">Results</button>
									  	</div>
									</nav>
									<div class="tab-content" id="nav-tabContent">
									  	<div class="tab-pane fade show active" id="nav-payment" role="tabpanel" aria-labelledby="nav-payment-tab">
									  		<ul class="list-group">
								        		<?php 
								        			    $sql = "SELECT payment.*, staff.name as staff 
													    		FROM payment 
													    		INNER JOIN staff ON payment.created_by = staff.id
													    		WHERE payment.student_id=:value1 AND payment.batch_id=:value2  ORDER BY payment.date DESC";
													    $statement = $conn->prepare($sql);
													    $statement->bindParam(':value1', $id);
													    $statement->bindParam(':value2', $batchid);
													    $statement->execute();
													    $payments = $statement->fetchAll();

								        			foreach($payments as $payment){ 
								        		?>
								        			<?php if($payment['type'] == 0 ): ?>
								        				<li class="list-group-item">
								        			<?php else: ?>
								        				<a href="#" class="list-group-item list-group-item-action">
								        			<?php endif ?>

								        				<div class="d-flex w-100 justify-content-between">
													      	<h5 class="mb-1"> 
													      		$ <?= $payment['amount']; ?>
													      		
													      	</h5>
													      	<small class="text-muted"> <?= date('d F Y',strtotime($payment['date'])); ?> </small>
													    </div>
													    <p class="mb-1">
													    	Paid 
													    	<?php 
													      		if($payment['type'] == 0 ){ 
													      			echo "Cash"; 
													      		}else{
													      			echo "Online";
													      		}
												      		?>
													    </p>
													    <small class="text-muted"> Created By : <?= $payment['staff']; ?> </small>
													<?php if($payment['type'] == 0 ): ?>
								        				</li>
									        		<?php else: ?>
									        			</a>
									        		<?php endif ?>
								        		<?php } ?>
								        	</ul>
									  	</div>
									  	<div class="tab-pane fade" id="nav-attendance" role="tabpanel" aria-labelledby="nav-attendance-tab">...</div>
									  	<div class="tab-pane fade" id="nav-result" role="tabpanel" aria-labelledby="nav-result-tab">...</div>
									</div>
						      	</div>
						    </div>
						</div>
						<?php } ?>
					</div>

	            </div>
	        </div>
	    </div>
	</div>
	<!--//row-->
<?php 
	require 'backend_footer.php';
?>