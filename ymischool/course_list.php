<?php 
	require 'backend_header.php';
	require 'connection.php';

    $login_user_type =$_SESSION['login_user_type'];
    $login_user_id =$_SESSION['login_user']['id'];


	if($login_user_type == "Staff"){
	    $sql = "SELECT courses.*, subcategories.name as sname 
	    		FROM courses 
	    		INNER JOIN subcategories ON courses.subcategory_id = subcategories.id
	    		ORDER BY created_at DESC";
	    $statement = $conn->prepare($sql);
	    $statement->execute();

	    $courses = $statement->fetchAll();
	}
	else{
		$sql = "SELECT courses.*, subcategories.name as sname, batches.name as bname
				FROM courses
				INNER JOIN subcategories ON courses.subcategory_id = subcategories.id 
				INNER JOIN batches ON courses.id = batches.course_id
				INNER JOIN enroll ON batches.id = enroll.batch_id
				WHERE enroll.student_id = $login_user_id
				ORDER BY enroll.registerdate DESC
		";
		$statement = $conn->prepare($sql);
	    $statement->execute();

	    $courses = $statement->fetchAll();
	}

?>
	<div class="row g-3 mb-4 align-items-center justify-content-between">
	    <div class="col-auto">
	        <h1 class="app-page-title mb-0"> Courses </h1>
	    </div>
	    <?php if($login_user_type == "Staff"): ?>
	    <div class="col-auto">
	    	<div class="card-header-action">
		        <a href="course_new.php" class="btn app-btn-secondary text-decoration-none"> Create New </a>
	        </div>
	    </div>
		<?php endif ?>
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

    <div class="row">
            	<?php 
            		foreach($courses as $course){
            			$id = $course['id'];
            			$codeno = $course['codeno'];
            			$image = $course['image'];
            			$sname = $course['sname'];
            			$price = $course['price'];
            			$createdat = $course['created_at'];


            	?>
            	<div class="col-6 col-md-4 col-xl-4 col-xxl-3">
				    <div class="app-card app-card-doc shadow-sm  h-100">
				        <div class="app-card-thumb-holder p-3">
				            <div class="app-card-thumb">
				                <img class="thumb-image" src="<?= $image; ?>" alt="">
				            </div>
				            <a class="app-card-link-mask" href="course_detail.php?id=<?= $id ?>"></a>
				        </div>
				        <div class="app-card-body p-3 has-card-actions">
				            <h4 class="app-doc-title  mb-0 d-block">
				            	<a href="course_detail.php?id=<?= $id ?>" class="d-flex justify-content-between">  
				            		<span> <?= $codeno; ?> </span> 
				            	<?php if($login_user_type == "Student"): ?>
				            		<span class="text-end"><?= $course['bname']; ?> </span>
				            	<?php endif; ?>	
				            </a>
				            </h4>
				            <div class="app-doc-meta mt-3">
				                <ul class="list-unstyled mb-0">
				                    <li><span class="text-muted">Subject:</span> <?= $sname; ?> </li>
				                    <li><span class="text-muted">Price:</span> $<?= $price; ?> </li>
				                    <li><span class="text-muted">Created At:</span> <?= date('d F Y',strtotime($createdat)); ?> </li>
				                </ul>
				            </div>
				            <!--//app-doc-meta-->
				            <?php if($login_user_type == "Staff"): ?>
				            <div class="app-card-actions">
				                <div class="dropdown">
				                    <div class="dropdown-toggle no-toggle-arrow" data-bs-toggle="dropdown" aria-expanded="false">
				                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-three-dots-vertical" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
				                            <path fill-rule="evenodd" d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
				                        </svg>
				                    </div>
				                    <!--//dropdown-toggle-->
				                    <ul class="dropdown-menu">
				                        <li>
				                            <a class="dropdown-item" href="course_detail.php?id=<?= $id ?>">
				                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye me-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
				                                    <path fill-rule="evenodd" d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.134 13.134 0 0 0 1.66 2.043C4.12 11.332 5.88 12.5 8 12.5c2.12 0 3.879-1.168 5.168-2.457A13.134 13.134 0 0 0 14.828 8a13.133 13.133 0 0 0-1.66-2.043C11.879 4.668 10.119 3.5 8 3.5c-2.12 0-3.879 1.168-5.168 2.457A13.133 13.133 0 0 0 1.172 8z"/>
				                                    <path fill-rule="evenodd" d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
				                                </svg>
				                                View
				                            </a>
				                        </li>
				                        <li>
				                            <a class="dropdown-item" href="course_edit.php?id=<?= $id ?>">
				                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil me-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
				                                    <path fill-rule="evenodd" d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
				                                </svg>
				                                Edit
				                            </a>
				                        </li>
				                        <li>
				                            <hr class="dropdown-divider">
				                        </li>
				                        <li>
				                            <a class="dropdown-item" href="course_delete.php?id=<?= $id ?>">
				                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash me-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
				                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
				                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
				                                </svg>
				                                Delete
				                            </a>
				                        </li>
				                    </ul>
				                </div>
				                <!--//dropdown-->
				            </div>
				        	<?php endif; ?>
				            <!--//app-card-actions-->
				        </div>
				        <!--//app-card-body-->
				    </div>
				    <!--//app-card-->
				</div>
				<!--//col-->

				<?php } ?>

            </div>

<?php 
	require 'backend_footer.php';
?>