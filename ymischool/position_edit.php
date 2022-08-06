<?php 
	require 'backend_header.php';
	require 'connection.php';

	$id = $_GET['id'];

    $sql = "SELECT * FROM position WHERE id=:value1";
    $statement = $conn->prepare($sql);
    $statement->bindParam(':value1', $id);
    $statement->execute();

    $position = $statement->fetch(PDO::FETCH_ASSOC);
?>
	

	<div class="app-card app-card-orders-table shadow-sm mb-5">
		<div class="app-card-header p-3">
	        <div class="row justify-content-between align-items-center">
		        <div class="col-auto">
	                <h1 class="app-page-title mb-0"> Edit position </h1>
		        </div>
		        <div class="col-auto">
			        <div class="card-header-action">
				        <a href="position_list.php" class="btn app-btn-secondary text-decoration-none"> Go Back </a>
			        </div>
		        </div>
	        </div>
        </div>
	    <div class="app-card-body p-3">

	    	<form class="forms-sample" action="position_update.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?=$position['id']?>">

                <div class="row mb-3">
				    <label for="inputposition" class="col-sm-2 col-form-label">Position:</label>
				    <div class="col-sm-10">
				      	<input type="text" class="form-control" id="inputposition" name="name" value="<?=$position['name']?>" required>
				    </div>
				</div>

                <button type="submit" class="offset-2 btn app-btn-primary me-2">Save</button>
            </form>
	    </div>
	</div>

<?php 
	require 'backend_footer.php';
?>