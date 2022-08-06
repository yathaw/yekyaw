<?php 
	require 'backend_header.php';
	require 'connection.php';

    $sql = "SELECT * FROM position ORDER BY name ASC";
    $statement = $conn->prepare($sql);
    $statement->execute();

    $position = $statement->fetchAll();
?>
	

	<div class="app-card app-card-orders-table shadow-sm mb-5">
		<div class="app-card-header p-3">
	        <div class="row justify-content-between align-items-center">
		        <div class="col-auto">
	                <h1 class="app-page-title mb-0"> Position </h1>
		        </div>
		        <div class="col-auto">
			        <div class="card-header-action">
				        <a href="position_new.php" class="btn app-btn-secondary text-decoration-none"> Create New </a>
			        </div>
		        </div>
	        </div>
        </div>
	    <div class="app-card-body p-3">

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

	        <div class="table-responsive">
	            <table class="table table-bordered app-table-hover mb-0 text-left datatables">
	                <thead class="table-success">
	                    <tr>
	                        <th class="cell">#</th>
	                        <th class="cell">Name</th>
	                        <th class="cell">Action</th>
	                    </tr>
	                </thead>
	                <tbody>
                            <?php 
                                $i = 1;
                                foreach ($position as $position) {
                                
                                $id = $position['id'];
                                $name = $position['name'];

                            ?>
                                <tr>
                                    <td> <?= $i++ ?>. </td>
                                    <td> <?= ucfirst($name); ?> </td>
                                    <td>
                                        <a href="position_edit.php?id=<?= $id ?>" class="btn btn-warning fw-normal">
                                        	Edit
                                        </a>

                                        <form class="d-inline-block" onsubmit="return confirm('Are you sure want to delete?')" action="position_delete.php" method="POST">

                                            <input type="hidden" name="id" value="<?= $id ?>">
                                            
                                            <button class="btn btn-danger fw-normal">
                                                Delete
                                            </button>                                            
                                        </form>

                                    </td>
                                </tr>
                            <?php } ?>
                            
                        </tbody>
	            </table>
	        </div>
	        <!--//table-responsive-->
	    </div>
	    <!--//app-card-body-->      
	</div>

<?php 
	require 'backend_footer.php';
?>