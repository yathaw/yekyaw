<?php 
	require 'backend_header.php';
	require 'connection.php';

	$id = $_GET['id'];

    $sql = "SELECT * FROM categories WHERE id=:value1";
    $statement = $conn->prepare($sql);
    $statement->bindParam(':value1', $id);
    $statement->execute();

    $category = $statement->fetch(PDO::FETCH_ASSOC);
?>
	

	<div class="app-card app-card-orders-table shadow-sm mb-5">
		<div class="app-card-header p-3">
	        <div class="row justify-content-between align-items-center">
		        <div class="col-auto">
	                <h1 class="app-page-title mb-0"> Edit Category </h1>
		        </div>
		        <div class="col-auto">
			        <div class="card-header-action">
				        <a href="category_list.php" class="btn app-btn-secondary text-decoration-none"> Go Back </a>
			        </div>
		        </div>
	        </div>
        </div>
	    <div class="app-card-body p-3">

	    	<form class="forms-sample" action="category_update.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?=$category['id']?>">

                <div class="row mb-3">
				    <label for="inputCategory" class="col-sm-2 col-form-label">Category:</label>
				    <div class="col-sm-10">
				      	<input type="text" class="form-control" id="inputCategory" name="name" value="<?=$category['name']?>" required>
				    </div>
				</div>

                <button type="submit" class="offset-2 btn app-btn-primary me-2">Save</button>
            </form>
	    </div>
	</div>

<?php 
	require 'backend_footer.php';
?>