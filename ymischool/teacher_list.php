<?php 
	require 'backend_header.php';
	require 'connection.php';

	$id = 3;
    $sql = "SELECT staff.*, position.name as pname 
    		FROM staff 
    		INNER JOIN staff_position ON staff_position.staff_id = staff.id
    		INNER JOIN position ON staff_position.position_id = position.id
    		WHERE position.id=:value1";
    $statement = $conn->prepare($sql);
    $statement->bindParam(':value1', $id);
    $statement->execute();

    $staffLists = $statement->fetchAll();
?>
<div class="row g-3 mb-4 align-items-center justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0"> Teacher </h1>
    </div>
</div>


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
			    <a class="action-link" href="teacher_detail.php?id=<?= $id ?>">
			    	View
			    	<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-right ms-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
					  <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
					</svg>
				</a>
			    
		    </div><!--//app-card-footer-->
		</div><!--//app-card-->
	</div>
	<?php } ?>
</div>

	

<?php 
	require 'backend_footer.php';
?>