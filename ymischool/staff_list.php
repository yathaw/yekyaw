<?php 
	require 'backend_header.php';
	require 'connection.php';

    $sql = "SELECT staff.*, position.name as pname 
    		FROM staff 
    		INNER JOIN staff_position ON staff_position.staff_id = staff.id
    		INNER JOIN position ON staff_position.position_id = position.id
    		ORDER BY position.id ASC";
    $statement = $conn->prepare($sql);
    $statement->execute();

    $staffLists = $statement->fetchAll();
?>
<div class="row g-3 mb-4 align-items-center justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0"> Staff </h1>
    </div>
    <div class="col-auto">
    	<div class="card-header-action">
	        <a href="staff_new.php" class="btn app-btn-secondary text-decoration-none"> Create New </a>
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

<div class="row g-3">
	<?php 
		foreach($staffLists as $staffList){ 
		$id = $staffList['id'];
		$name = $staffList['name'];
		$pname = $staffList['pname'];
		$dob = $staffList['dob'];
		$address = $staffList['address'];
		$profile = $staffList['profile'];
		$created_at = $staffList['created_at'];

	?>
	
	<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
		<div class="app-card app-card-notification shadow-sm mb-4">
		    <div class="app-card-header px-4 py-3">
		        <div class="row g-3 align-items-center">
			        <div class="col-12 col-lg-auto text-center text-lg-start">						        
		                <img class="profile-image" src="<?= $profile; ?>" alt="">
			        </div><!--//col-->
			        <div class="col-12 col-lg-auto text-center text-lg-start">
				        <div class="notification-type mb-2"><span class="badge bg-secondary"><?= $pname; ?></span></div>
				        <h4 class="notification-title mb-1"><?= $name; ?></h4>
				        
				        <ul class="notification-meta list-inline mb-0">
					        <li class="list-inline-item">Created</li>
					        <li class="list-inline-item">|</li>
					        <li class="list-inline-item"> <?= date("d M, Y", strtotime($created_at)); ?> </li>
				        </ul>
				   
			        </div><!--//col-->
		        </div><!--//row-->
		    </div><!--//app-card-header-->
		    <div class="app-card-footer px-4 py-3">
			    <a href="staff_edit.php?id=<?= $id ?>" class="btn btn-warning fw-normal">
                	Edit
                </a>

                <form class="d-inline-block" onsubmit="return confirm('Are you sure want to delete?')" action="staff_delete.php" method="POST">

                    <input type="hidden" name="id" value="<?= $id ?>">
                    
                    <button class="btn btn-danger fw-normal">
                        Delete
                    </button>                                            
                </form>
		    </div><!--//app-card-footer-->
		</div><!--//app-card-->
	</div>
	<?php } ?>
</div>

	

<?php 
	require 'backend_footer.php';
?>