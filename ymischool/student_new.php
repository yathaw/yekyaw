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
	                <h1 class="app-page-title mb-0"> Create New Student</h1>
		        </div>
		        <div class="col-auto">
			        <div class="card-header-action">
				        <a href="student_list.php" class="btn app-btn-secondary text-decoration-none"> Go Back </a>
			        </div>
		        </div>
	        </div>
        </div>
	    <div class="app-card-body p-3">

	    	<form class="forms-sample" action="student_add.php" method="POST" enctype="multipart/form-data">
	    		<input type="hidden" name="fullprice" id="inputFullprice">
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
					      				<option value="<?= $batch['id']; ?>" data-fee="<?= $course['price']; ?>"> <?= $batch['name']; ?> </option>
					      			<?php } ?>
					      		</optgroup>
				      		<?php } ?>

				      	</select>
				    </div>
				</div>

                <div class="row mb-3">
				    <label for="inputTitle" class="col-sm-2 col-form-label">Name:</label>
				    <div class="col-sm-10">
				      	<input type="text" class="form-control" id="inputTitle" name="name">
				    </div>
				</div>

				<div class="row mb-3">
				    <label for="inputDob" class="col-sm-2 col-form-label">Date of Birth:</label>
				    <div class="col-sm-10">
				      	<input type="date" class="form-control" id="inputDob" name="dob" required>
				    </div>
				</div>

				<div class="row mb-3">
				    <label for="inputEmail" class="col-sm-2 col-form-label">Email:</label>
				    <div class="col-sm-10">
				      	<input type="email" class="form-control" id="inputEmail" name="email" required>
				    </div>
				</div>

				<div class="row mb-3">
				    <label for="inputPassword" class="col-sm-2 col-form-label">Password:</label>
				    <div class="col-sm-10">
				      	<input type="password" class="form-control" id="inputPassword" name="password" required>
				    </div>
				</div>
				<div class="row mb-3">
				    <label for="inputPhone" class="col-sm-2 col-form-label">Phone:</label>
				    <div class="col-sm-10">
				      	<input type="text" class="form-control" id="inputPhone" name="phone">
				    </div>
				</div>

				<div class="row mb-3">
				    <label for="inputDescription" class="col-sm-2 col-form-label">Address:</label>
				    <div class="col-sm-10">
				      	<textarea class="form-control" name="address" style="height:150px"></textarea>
				    </div>
				</div>

				<div class="row mb-3">
				    <label for="inputFee" class="col-sm-2 col-form-label">Course Fee:</label>
				    <div class="col-sm-10">
				    	<p id="inputFee"></p>
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
	    	$('#onlinetransactionDiv').hide();

	$(".select2").select2({
	    width: '100%', // need to override the changed default,
	    style: 'bootstrap4',
	    placeholder: 'Choose One Option'
	});

	$('#inputBatch').change(function (e) {
        var fee = $("#inputBatch").select2().find(":selected").data("fee");
        console.log($(this));
        console.log(fee);

        $('#inputFee').html('$ '+fee);
        $('#inputFullprice').val(fee);
    });

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