<?php 
	require 'backend_header.php';
	require 'connection.php';

	$studentid = $_GET['id'];
	$batchid = $_GET['batchid'];

	$sql = "SELECT courses.id as cid, courses.price, courses.title, courses.codeno, batches.name FROM batches 
			INNER JOIN courses ON batches.course_id = courses.id
			WHERE batches.id = :value1";
    $statement = $conn->prepare($sql);
    $statement->bindParam(':value1', $batchid);
    $statement->execute();
    $course = $statement->fetch(PDO::FETCH_ASSOC);

    $sql = "SELECT * FROM students 
			WHERE id = :value1";
    $statement = $conn->prepare($sql);
    $statement->bindParam(':value1', $studentid);
    $statement->execute();
    $student = $statement->fetch(PDO::FETCH_ASSOC);


    $sql = "SELECT payment.*, staff.name as staff 
    		FROM payment 
    		INNER JOIN staff ON payment.created_by = staff.id
    		WHERE payment.student_id=:value1 AND payment.batch_id=:value2  ORDER BY payment.date DESC";
    $statement = $conn->prepare($sql);
    $statement->bindParam(':value1', $studentid);
    $statement->bindParam(':value2', $batchid);
    $statement->execute();

    $payments = $statement->fetchAll();

    $price = $course['price'];
    $coursename = $course['title'];
    $coursecodeno = $course['codeno'];
    $batchname = $course['name'];

    $paidamount =0;
    foreach($payments as $payment){
    	$paidamount += $payment['amount'];
    }

    $balance = $price - $paidamount;
	
?>
	
	<div class="app-card app-card-orders-table shadow-sm mb-5">
		<div class="app-card-header p-3">
	        <div class="row justify-content-between align-items-center">
		        <div class="col-auto">
	                <h1 class="app-page-title mb-0"> Add Payment Installment </h1>
		        </div>
		        <div class="col-auto">
			        <div class="card-header-action">
				        <a href="student_list.php" class="btn app-btn-secondary text-decoration-none"> Go Back </a>
			        </div>
		        </div>
	        </div>
        </div>
	    <div class="app-card-body p-3">

	    	<form class="forms-sample" action="payment_add.php" method="POST" enctype="multipart/form-data">
	    		<input type="hidden" name="studentid" value="<?= $studentid; ?>">
	    		<input type="hidden" name="batchid" value="<?= $batchid; ?>">
	    		<input type="hidden" name="fullprice" value="<?= $price; ?>">
	    		<input type="hidden" name="balance" value="<?= $balance; ?>">
	    		<input type="hidden" name="paidprice" value="<?= $paidamount; ?>">
	    		<input type="hidden" name="courseid" value="<?= $course['id']; ?>">



	    		
	    		<div class="row mb-3">
	    			<div class="col-6">
	    				<div class="mb-2"> 
	    					<span class="fw-bold"> Student : </span> 
	    					<span class="text-dark fw-bolder"> <?= $student['name']; ?> </span>
	    				</div>
	    				<div class="mb-2"> 
	    					<span class="fw-bold"> Course : </span> 
	    					<small class="fw-lighter"> <?= $coursename; ?> 
		    					( <?= $coursecodeno; ?> ) 
		    				</small>
	    				</div>
	    				<div class="mb-2"> 
	    					<span class="fw-bold"> Batch : </span> 
	    					<small class="fw-lighter"> <?= $batchname; ?> </small>
	    				</div>

	    			</div>
	    			<div class="col-6">
	    				<div class="accordion-item">
						    <h2 class="accordion-header" id="headingTwo">
						      	<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
						        	Payment History
						      	</button>
						    </h2>
						    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
						      	<div class="accordion-body">
						        	<ul class="list-group">
						        		<?php foreach($payments as $payment){ ?>
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
						    </div>
						</div>
	    			</div>
	    		</div>

				<div class="row mb-3">
				    <label for="inputFee" class="col-sm-2 col-form-label">Course Fee:</label>
				    <div class="col-sm-10">
				    	<p id="inputFee"> $<?= $price; ?> </p>
				    </div>
				</div>

				<div class="row mb-3">
				    <label for="inputBalance" class="col-sm-2 col-form-label"> Balance :</label>
				    <div class="col-sm-10">
				    	<p id="inputBalance"> $<?= $balance; ?> </p>
				    </div>
				</div>

				<div class="row mb-3">
				    <label for="inputPassword" class="col-sm-2 col-form-label">Type:</label>
				    <div class="col-sm-10">
				      	<div class="form-check form-check-inline">
						  	<input class="form-check-input" type="radio" name="type" id="inputCash" value="0">
						  	<label class="form-check-label" for="inputCash"> Cash </label>
						</div>
						<div class="form-check form-check-inline">
						  	<input class="form-check-input" type="radio" name="type" id="inputOnline" value="1">
						  	<label class="form-check-label" for="inputOnline"> Online </label>
						</div>
				    </div>
				</div>

				<div class="row mb-3">
				    <label for="inputPrice" class="col-sm-2 col-form-label">Pay Installment:</label>
				    <div class="col-sm-10">
				    	<div class="input-group mb-3">
					      	<span class="input-group-text">
					      		<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-currency-dollar" viewBox="0 0 16 16">
								  	<path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z"/>
								</svg>
					      	</span>
	  						<input type="number" class="form-control" id="inputPrice" name="price">
	  					</div>
				    </div>
				</div>

				<div class="row mb-3" id="onlinetransactionDiv">
				    <label for="inputTransaction" class="col-sm-2 col-form-label"> Transaction :</label>
				    <div class="col-sm-10">
				    	<label for="inputInvoiceno"> Transaction Invoice No </label>
				      	<input type="text" class="form-control" id="inputInvoiceno" name="transaction" placeholder="Invoice No">

				    	<label for="inputFile" class="d-block mt-3"> Transaction Approve File </label>
				      	<input type="file" name="file" id="inputFile">
				    </div>
				</div>

                <button type="submit" class="offset-2 btn app-btn-primary me-2">Save</button>
            </form>
	    </div>
	</div>

<?php 
	require 'backend_footer.php';
?>
<script type="text/javascript">
	$('#onlinetransactionDiv').hide();

    $('#inputCash').click(function() {
	  	if($('#inputCash').is(':checked')) 
	  	{ 
	    	$('#onlinetransactionDiv').hide();
	  	}else{
	    	$('#onlinetransactionDiv').show();
	  	}                      
	});

	$('#inputOnline').click(function() {
	  	if($('#inputOnline').is(':checked')) 
	  	{ 
	    	$('#onlinetransactionDiv').show();
	  	}else{
	    	$('#onlinetransactionDiv').hide();
	  	}                      
	});


</script>