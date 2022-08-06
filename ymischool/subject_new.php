<?php 
	require 'backend_header.php';
	require 'connection.php';

    $sql = "SELECT * FROM categories ORDER BY name ASC";
    $statement = $conn->prepare($sql);
    $statement->execute();

    $categories = $statement->fetchAll();
	
?>
	

	<div class="app-card app-card-orders-table shadow-sm mb-5">
		<div class="app-card-header p-3">
	        <div class="row justify-content-between align-items-center">
		        <div class="col-auto">
	                <h1 class="app-page-title mb-0"> Create New </h1>
		        </div>
		        <div class="col-auto">
			        <div class="card-header-action">
				        <a href="subject_list.php" class="btn app-btn-secondary text-decoration-none"> Go Back </a>
			        </div>
		        </div>
	        </div>
        </div>
	    <div class="app-card-body p-3">

	    	<form class="forms-sample" action="subject_add.php" method="POST" enctype="multipart/form-data">
                <div class="row mb-3">
				    <label for="inputCategory" class="col-sm-2 col-form-label">Subject:</label>
				    <div class="col-sm-10">
				      	<input type="text" class="form-control" id="inputCategory" name="name" required>
				    </div>
				</div>

				<div class="row mb-3">
				    <label for="inputCategory" class="col-sm-2 col-form-label">Select Category:</label>
				    <div class="col-sm-10">
				      	<select class="form-control" name="category" required>
                            <option selected disabled> Choose One Category </option>

				      		<?php foreach($categories as $category){ ?>
				      		<option value="<?= $category['id']; ?>"> <?= $category['name']; ?> </option>
				      		<?php } ?>

				      	</select>
				    </div>
				</div>

                <button type="submit" class="offset-2 btn app-btn-primary me-2">Save</button>
            </form>
	    </div>
	</div>

<?php 
	require 'backend_footer.php';
?>