<?php 
	require 'backend_header.php';
	require 'connection.php';

    $login_user_type =$_SESSION['login_user_type'];
	$login_user_id = $_SESSION['login_user']['id'];

	if($login_user_type == "Student"){
		$sql = "SELECT * FROM students 
	    		WHERE id = :value1";
	    $statement = $conn->prepare($sql);
	    $statement->bindParam(':value1', $login_user_id);
	    $statement->execute();
	    $user = $statement->fetch(PDO::FETCH_ASSOC);

	    $sql = "SELECT courses.id as cid, courses.title, courses.codeno, batches.name, batches.id as bid 
	    		FROM courses
	    		INNER JOIN batches ON courses.id = batches.course_id
	    		INNER JOIN enroll ON batches.id = enroll.batch_id
	    		WHERE enroll.student_id =:value2";
	   	$statement = $conn->prepare($sql);
	    $statement->bindParam(':value2', $login_user_id);
	    $statement->execute();
	    $courses = $statement->fetchAll();
	}else{
		$sql = "SELECT * FROM staff 
	    		WHERE id = :value1";
	    $statement = $conn->prepare($sql);
	    $statement->bindParam(':value1', $login_user_id);
	    $statement->execute();
	    $user = $statement->fetch(PDO::FETCH_ASSOC);
	}

?>
	<div class="row g-3 mb-4 align-items-center justify-content-between">
	    <div class="col-auto">
	        <h1 class="app-page-title mb-0"> Account </h1>
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

		<div class="col-12">
		<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
		  	<li class="nav-item" role="presentation">
		    	<button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Profile </button>
		  	</li>
		  	<li class="nav-item" role="presentation">
		    	<button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Edit Profile</button>
		  	</li>
		  	<li class="nav-item" role="presentation">
		    	<button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Change Password</button>
		  	</li>
		</ul>
		<div class="tab-content" id="pills-tabContent">
		  	<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
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
		                            	<img class="profile-image" src="<?= $user['profile']; ?>" alt="">
		                            </div>
		                        </div>
		                        <div class="col-8">
		                        	<div class="mb-3">
		                        		<div class="item-label">
		                        			<strong>Name:</strong>
		                        			<?= $user['name']; ?>
		                        		</div>
		                        	</div>
		                        	<div class="mb-3">
		                        		<div class="item-label">
		                        			<strong>Email</strong>
		                        			<?= $user['email']; ?>
		                        		</div>
		                        	</div>
		                        	<div class="mb-3">
		                        		<div class="item-label">
		                        			<strong>Phone</strong>
		                        			<?= $user['phone']; ?>
		                        		</div>
		                        	</div>
		                        	<div class="mb-3">
		                        		<div class="item-label">
		                        			<strong>Location</strong>
			                                <?= $user['address']; ?>
		                        		</div>
		                        	</div>
		                        </div>
		                    </div>
		                </div>
		            </div>
		            <!--//app-card-body-->
		        </div>
		  	</div>
		  	<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
		  		<div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
		            <div class="app-card-header p-3 border-bottom-0">
		                <div class="row align-items-center gx-3">
		                    <div class="col-auto">
		                        <div class="app-icon-holder">
		                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
									  	<path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
									  	<path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
									</svg>
		                        </div>
		                        <!--//icon-holder-->
		                    </div>
		                    <!--//col-->
		                    <div class="col-auto">
		                        <h4 class="app-card-title">Edit Profile</h4>
		                    </div>
		                    
		                    <!--//col-->
		                </div>
		                <!--//row-->
		            </div>
		            <!--//app-card-header-->
		            <div class="app-card-body px-4 w-100 py-3">
		                <form class="forms-sample" action="profile_update.php" method="POST" enctype="multipart/form-data">
				    		<input type="hidden" name="id" value="<?= $user['id']; ?>">
				    		<input type="hidden" name="oldphoto" value="<?= $user['profile'] ?>">

				    		<div class="row mb-3">
							    <label for="inputPhoto" class="col-sm-2 col-form-label">Profile:</label>
							    <div class="col-sm-10">
							    	<ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
									  	<li class="nav-item" role="presentation">
									    	<button class="nav-link active" id="oldprofile-tab" data-bs-toggle="tab" data-bs-target="#oldprofile" type="button" role="tab" aria-controls="oldprofile" aria-selected="true">Old Profile</button>
									  	</li>
									  	<li class="nav-item" role="presentation">
									    	<button class="nav-link" id="newprofile-tab" data-bs-toggle="tab" data-bs-target="#newprofile" type="button" role="tab" aria-controls="newprofile" aria-selected="false">New Profile</button>
									  	</li>
									</ul>
									<div class="tab-content" id="myTabContent">
									  	<div class="tab-pane fade show active" id="oldprofile" role="tabpanel" aria-labelledby="oldprofile-tab">
									  		<img src="<?= $user['profile']; ?> " class="w-25 h-25 img-thumbnail ">
									  	</div>
									  	<div class="tab-pane fade" id="newprofile" role="tabpanel" aria-labelledby="newprofile-tab">
							      			<input type="file" id="inputPhoto" name="newphoto">
									  	</div>
									</div>
							    </div>
							</div>

			                <div class="row mb-3">
							    <label for="inputTitle" class="col-sm-2 col-form-label">Name:</label>
							    <div class="col-sm-10">
							      	<input type="text" class="form-control" id="inputTitle" name="name" value="<?= $user['name']; ?>" required>
							    </div>
							</div>

							<div class="row mb-3">
							    <label for="inputDob" class="col-sm-2 col-form-label">Date of Birth:</label>
							    <div class="col-sm-10">
							      	<input type="date" class="form-control" id="inputDob" name="dob" value="<?= $user['dob']; ?>" required>
							    </div>
							</div>

							<div class="row mb-3">
							    <label for="inputEmail" class="col-sm-2 col-form-label">Email:</label>
							    <div class="col-sm-10">
							      	<input type="email" class="form-control" id="inputEmail" name="email" value="<?= $user['email']; ?>" required>
							    </div>
							</div>
							

							<div class="row mb-3">
							    <label for="inputDescription" class="col-sm-2 col-form-label">Address:</label>
							    <div class="col-sm-10">
							      	<textarea class="form-control" name="address" style="height:150px"><?= $user['address']; ?></textarea>
							    </div>
							</div>

			                <button type="submit" class="offset-2 btn app-btn-primary me-2">Save</button>
			            </form>
		            </div>
		            <!--//app-card-body-->
		        </div>
		  	</div>
		  	<div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
		  		<div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
		            <div class="app-card-header p-3 border-bottom-0">
		                <div class="row align-items-center gx-3">
		                    <div class="col-auto">
		                        <div class="app-icon-holder">
		                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-key" viewBox="0 0 16 16">
									  	<path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z"/>
									  	<path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
									</svg>
		                        </div>
		                        <!--//icon-holder-->
		                    </div>
		                    <!--//col-->
		                    <div class="col-auto">
		                        <h4 class="app-card-title">Change Password </h4>
		                    </div>
		                    
		                    <!--//col-->
		                </div>
		                <!--//row-->
		            </div>
		            <!--//app-card-header-->
		            <div class="app-card-body px-4 w-100 py-3">
		                <form class="forms-sample" action="profile_password.php" method="POST" enctype="multipart/form-data">
				    		<input type="hidden" name="id" value="<?= $user['id']; ?>">

			                <div class="row mb-3">
							    <label for="inputPassword" class="col-sm-2 col-form-label">New Password:</label>
							    <div class="col-sm-10">
							      	<input type="password" class="form-control" id="inputPassword" name="password" required>
							    </div>
							</div>

			                <button type="submit" class="offset-2 btn app-btn-primary me-2">Save</button>
			            </form>
		            </div>
		            <!--//app-card-body-->
		        </div>
		  	</div>
		</div>

	    
	        
	    </div>
	<?php 
		if($login_user_type == "Student"):
	?>
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
													    $statement->bindParam(':value1', $login_user_id);
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
									  	<div class="tab-pane fade" id="nav-attendance" role="tabpanel" aria-labelledby="nav-attendance-tab">
									  		<?php 
									  			$attendstatus = 1;
												$sql = "SELECT count(*)*100 as result FROM attendance 
										    		WHERE student_id = :value1 AND batch_id = :value2 AND status = :value3";
											    $statement = $conn->prepare($sql);
						    					$statement->bindParam(':value1', $login_user_id);
						    					$statement->bindParam(':value2', $course['bid']);
						    					$statement->bindParam(':value3', $attendstatus);
											    $statement->execute();

											    $attend = $statement->fetch(PDO::FETCH_ASSOC);
											    $attend = $attend['result'];


											    $absencestatus = 0;
												$sql = "SELECT count(*)*100 as result FROM attendance 
										    		WHERE student_id = :value1 AND batch_id = :value2 AND status = :value3";
											    $statement = $conn->prepare($sql);
						    					$statement->bindParam(':value1', $login_user_id);
						    					$statement->bindParam(':value2', $course['bid']);
						    					$statement->bindParam(':value3', $absencestatus);
											    $statement->execute();

											    $absence = $statement->fetch(PDO::FETCH_ASSOC);
											    $absence = $absence['result'];

											?>

											<div class="row">
												<div class="my-3">
													<p> Total Attending </p>
													<div class="progress col-12">
													  	<div class="progress-bar bg-success" role="progressbar" style="width: <?= $attend.'%'; ?>;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?= $attend; ?>% </div>
													</div>
												</div>
												
												<div class="my-3">
													<p> Total Absence </p>
													<div class="progress  col-12">
													  	<div class="progress-bar bg-danger" role="progressbar" style="width: <?= $absence.'%'; ?>;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?= $absence; ?>%</div>
													</div>
												</div>

											</div>
									  	</div>
									  	<div class="tab-pane fade" id="nav-result" role="tabpanel" aria-labelledby="nav-result-tab">
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
						    </div>
						</div>
						<?php } ?>
					</div>

	            </div>
	        </div>
	    </div>
	</div>
	<?php endif ?>
	<!--//row-->
<?php 
	require 'backend_footer.php';
?>