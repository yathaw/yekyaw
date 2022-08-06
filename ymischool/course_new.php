<?php 
	require 'backend_header.php';
	require 'connection.php';

	$sql = "SELECT * FROM subcategories 
    		ORDER BY name ASC";
    $statement = $conn->prepare($sql);
    $statement->execute();

    $subcategories = $statement->fetchAll();
?>
	

	<div class="app-card app-card-orders-table shadow-sm mb-5">
		<div class="app-card-header p-3">
	        <div class="row justify-content-between align-items-center">
		        <div class="col-auto">
	                <h1 class="app-page-title mb-0"> Create New </h1>
		        </div>
		        <div class="col-auto">
			        <div class="card-header-action">
				        <a href="course_list.php" class="btn app-btn-secondary text-decoration-none"> Go Back </a>
			        </div>
		        </div>
	        </div>
        </div>
	    <div class="app-card-body p-3">

	    	<form class="forms-sample" action="course_add.php" method="POST" enctype="multipart/form-data">
	    		<div class="row mb-3">
				    <label for="inputPhoto" class="col-sm-2 col-form-label">Cover Photo:</label>
				    <div class="col-sm-10">
				      	<input type="file" id="inputPhoto" name="photo" required>
				    </div>
				</div>

				<div class="row mb-3">
				    <label for="inputVideo" class="col-sm-2 col-form-label"> AD Video:</label>
				    <div class="col-sm-10">
				      	<input type="file" id="inputVideo" name="video" required>
				    </div>
				</div>

				<div class="row mb-3">
				    <label for="inputCodeno" class="col-sm-2 col-form-label">Codeno:</label>
				    <div class="col-sm-10">
				      	<input type="text" class="form-control" id="inputCodeno" name="codeno" required>
				    </div>
				</div>

				<div class="row mb-3">
				    <label for="inputSubject" class="col-sm-2 col-form-label">Select Subject:</label>
				    <div class="col-sm-10">
				      	<select class="form-control" id="inputSubject" name="subcategory" required>
                            <option selected disabled> Choose One Subject </option>

				      		<?php foreach($subcategories as $subcategory){ ?>
				      		<option value="<?= $subcategory['id']; ?>"> <?= $subcategory['name']; ?> </option>
				      		<?php } ?>

				      	</select>
				    </div>
				</div>

                <div class="row mb-3">
				    <label for="inputTitle" class="col-sm-2 col-form-label">Title:</label>
				    <div class="col-sm-10">
				      	<input type="text" class="form-control" id="inputTitle" name="title" required>
				    </div>
				</div>

				<div class="row mb-3">
				    <label for="inputPrice" class="col-sm-2 col-form-label">Price:</label>
				    <div class="col-sm-10">
				    	<div class="input-group mb-3">
					      	<span class="input-group-text">
					      		<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-currency-dollar" viewBox="0 0 16 16">
								  	<path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z"/>
								</svg>
					      	</span>
	  						<input type="number" class="form-control" id="inputPrice" name="price" required>
	  					</div>
				    </div>
				</div>

				<div class="row mb-3">
				    <label for="inputStudylevel" class="col-sm-2 col-form-label">Study Level:</label>
				    <div class="col-sm-10">
				      	<input type="text" class="form-control" id="inputStudylevel" name="studylevel" required>
				    </div>
				</div>
				
				<div class="row mb-3">
				    <label for="inputDuration" class="col-sm-2 col-form-label">Duration:</label>
				    <div class="col-sm-10">
				      	<input type="text" class="form-control" id="inputDuration" name="duration" placeholder="e.g: 3 Years/ 60 Hours / 3 Months" required>
				    </div>
				</div>

				<div class="row mb-3">
				    <label for="inputDescription" class="col-sm-2 col-form-label">Description:</label>
				    <div class="col-sm-10">
				      	<textarea class="form-control" name="description" style="height:150px" required></textarea>
				    </div>
				</div>

				<div class="row mb-3">
				    <label for="inputStudylevel" class="col-sm-2 col-form-label"> Total Number Of:</label>
				    <div class="col-sm-10">
				    	<div class="row g-3">
				    		<div class="col-4">
						      	<input type="number" class="form-control" id="input" name="totalclass" placeholder="Total Class" required>
						    </div>
				    		<div class="col-4">
						      	<input type="number" class="form-control" id="inputCoursework" name="totalcoursework" placeholder="Total Coursework" required>
						    </div>
						    <div class="col-4">
						      	<input type="number" class="form-control" id="input" name="totalstudent" placeholder="Total Students in Each Classes" required>
						    </div>
					    </div>

				    </div>
				</div>

                <button type="submit" class="offset-2 btn app-btn-primary me-2">Save</button>
            </form>
	    </div>
	</div>

<?php 
	require 'backend_footer.php';
?>