<?php 
	require 'backend_header.php';
	require 'connection.php';

	$login_user_type =$_SESSION['login_user_type'];
    $login_user_id =$_SESSION['login_user']['id'];

	$id = $_GET['id'];


    $sql = "SELECT courses.*, subcategories.name as sname 
    		FROM courses 
    		INNER JOIN subcategories ON courses.subcategory_id = subcategories.id
    		WHERE courses.id = :value1";
    $statement = $conn->prepare($sql);
    $statement->bindParam(':value1', $id);
    $statement->execute();

    $course = $statement->fetch(PDO::FETCH_ASSOC);

    $id = $course['id'];
	$codeno = $course['codeno'];
	$title = $course['title'];
	$image = $course['image'];
	$sname = $course['sname'];
	$price = $course['price'];
	$createdat = $course['created_at'];
	$video = $course['video'];

	$duration = $course['duration'];
	$studylevel = $course['studylevel'];
	$totalclass = $course['totalclass'];
	$totalcoursework = $course['totalcoursework'];
	$totalstudent = $course['totalstudent'];
	$description = $course['description'];

	$sql = "SELECT materials.*, staff.name as uname 
    		FROM materials 
    		INNER JOIN staff ON materials.created_by = staff.id
    		WHERE materials.course_id = :value1";
    $statement = $conn->prepare($sql);
    $statement->bindParam(':value1', $id);
    $statement->execute();

    $materials = $statement->fetchAll();

    function formatBytes($bytes, $precision = 2) { 
	    $units = array('B', 'KB', 'MB', 'GB', 'TB'); 

	    $bytes = max($bytes, 0); 
	    $pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
	    $pow = min($pow, count($units) - 1); 

	    // Uncomment one of the following alternatives
	    // $bytes /= pow(1024, $pow);
	    // $bytes /= (1 << (10 * $pow)); 

	    return round($bytes, $precision) . ' ' . $units[$pow]; 
	} 
?>
<link rel="stylesheet" type="text/css" href="assets/plugins/pdfViewer/style.css">

<style type="text/css">
	.video-js{
		width: 100% !important;
	}

	.bg-color{
		background: #edfdf6;
		color: #15a362;
	}
</style>

	<div class="row g-3 mb-4 align-items-center justify-content-between">
	    <div class="col-auto">
	        <h1 class="app-page-title mb-0"> <?= $codeno; ?> </h1>
	    </div>
	    <div class="col-auto">
	    	<div class="card-header-action">
		        <a href="course_list.php" class="btn app-btn-secondary text-decoration-none"> Go Back </a>
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

    <div class="row">

    	<div class="col-12 col-md-4 col-xl-4 col-xxl-4">
		    <div class="card border-0  shadow-sm bg-body rounded">
	    	  	<video
				    id="my-video"
				    class="video-js"
				    controls
				    preload="auto"
				    width="640"
				    height="264"
				    poster="<?=  $image; ?> "
				    data-setup="{}"
				  >
				    <source src="<?= $video; ?>" type="video/mp4" />
				    <source src="<?= $video; ?>" type="video/webm" />
				    <p class="vjs-no-js">
				      To view this video please enable JavaScript, and consider upgrading to a
				      web browser that
				      <a href="https://videojs.com/html5-video-support/" target="_blank"
				        >supports HTML5 video</a
				      >
				    </p>
				</video>
			  	<div class="card-body">
			    	<h5 class="card-title"> <?= $title; ?> </h5>
			  	</div>
			</div>

			<div class="app-card app-card-orders-table mt-3 shadow-sm ">
				<div class="app-card-header p-3">
			        <div class="row justify-content-between align-items-center">
				        <div class="col-auto">
			                <h6 class="card-title mb-0"> About Courses </h6>
				        </div>
			        </div>
		        </div>
			    <div class="app-card-body p-3">
			    	<ul class="list-group">
					  	<li class="list-group-item d-flex justify-content-between align-items-center">
					    	Codeno :
					    	<span class=""> <?= $codeno; ?> </span>
					  	</li>

					  	<li class="list-group-item d-flex justify-content-between align-items-center">
					    	Subject :
					    	<span class=""> <?= $sname; ?> </span>
					  	</li>

					  	<li class="list-group-item d-flex justify-content-between align-items-center">
					    	Duration :
					    	<span class=""> <?= $duration; ?> </span>
					  	</li>

					  	<li class="list-group-item d-flex justify-content-between align-items-center">
					    	Study Level :
					    	<span class=""> <?= $studylevel; ?> </span>
					  	</li>

					  	<li class="list-group-item d-flex justify-content-between align-items-center">
					    	Class :
					    	<span class=""> <?= $totalclass; ?> </span>
					  	</li>

					  	<li class="list-group-item d-flex justify-content-between align-items-center">
					    	Coursework :
					    	<span class=""> <?= $totalcoursework; ?> </span>
					  	</li>

					  	<li class="list-group-item d-flex justify-content-between align-items-center">
					    	Students :
					    	<span class=""> <?= $totalstudent; ?> </span>
					  	</li>
					  	
					</ul>
			    </div>
		    </div>

		</div>

    	<div class="col-12 col-md-8 col-xl-8 col-xxl-8">
    		<div class="app-card app-card-orders-table shadow-sm ">
				<div class="app-card-header p-3">
			        <div class="row justify-content-between align-items-center">
				        <div class="col-auto">
			                <h6 class="card-title mb-0"> Description </h6>
				        </div>
			        </div>
		        </div>
			    <div class="app-card-body p-3">
			    	<p>
			    		<?= $description; ?>
			    	</p>
			    </div>
		    </div>

    		<div class="app-card app-card-progress-list shadow-sm mt-3">
				<div class="app-card-header p-3">
			        <div class="row justify-content-between align-items-center">
				        <div class="col-auto">
			                <h6 class="card-title mb-0"> Materials </h6>
				        </div>
	    				<?php if($login_user_type == "Staff"): ?>

				        <div class="col-auto">
					        <div class="card-header-action">
						        <a href="material_new.php?id=<?= $id ?>" class="btn app-btn-secondary text-decoration-none"> Add New </a>
					        </div>
				        </div>
						<?php endif ?>

			        </div>
		        </div>
			    <div class="app-card-body">
			    	<?php 
			    		foreach($materials as $material){

			    		$file = $material['file']; 

			    		$type_str = $material['type'];
			    		$type_arr = explode("/",$type_str);
			    		$type = strtolower(end($type_arr));

			    		$video_filetype = ["mov", "mp4","3gp", "ogg", "avi", "mpeg", "mpg"];
			    		$image_filetype = ["jpg","jpeg","png","gif"];
			    		$zip_filetype = ["zip"];


			    		if (in_array($type, $video_filetype)){
			    			$icon = '<svg xmlns="http://www.w3.org/2000/svg" width="1792" height="1792" viewBox="0 0 1792 1792"><path d="M1596 380q28 28 48 76t20 88v1152q0 40-28 68t-68 28h-1344q-40 0-68-28t-28-68v-1600q0-40 28-68t68-28h896q40 0 88 20t76 48zm-444-244v376h376q-10-29-22-41l-313-313q-12-12-41-22zm384 1528v-1024h-416q-40 0-68-28t-28-68v-416h-768v1536h1280zm-640-896q52 0 90 38t38 90v384q0 52-38 90t-90 38h-384q-52 0-90-38t-38-90v-384q0-52 38-90t90-38h384zm492 2q20 8 20 30v576q0 22-20 30-8 2-12 2-14 0-23-9l-265-266v-90l265-266q9-9 23-9 4 0 12 2z"/></svg>';
			    		}elseif (in_array($type, $image_filetype)){
			    			$icon = '<svg xmlns="http://www.w3.org/2000/svg" width="1792" height="1792" viewBox="0 0 1792 1792"><path d="M1596 380q28 28 48 76t20 88v1152q0 40-28 68t-68 28h-1344q-40 0-68-28t-28-68v-1600q0-40 28-68t68-28h896q40 0 88 20t76 48zm-444-244v376h376q-10-29-22-41l-313-313q-12-12-41-22zm384 1528v-1024h-416q-40 0-68-28t-28-68v-416h-768v1536h1280zm-128-448v320h-1024v-192l192-192 128 128 384-384zm-832-192q-80 0-136-56t-56-136 56-136 136-56 136 56 56 136-56 136-136 56z"/></svg>';
			    		}elseif (in_array($type, $zip_filetype)){
			    			$icon = '<svg xmlns="http://www.w3.org/2000/svg" width="1792" height="1792" viewBox="0 0 1792 1792"><path d="M768 384v-128h-128v128h128zm128 128v-128h-128v128h128zm-128 128v-128h-128v128h128zm128 128v-128h-128v128h128zm700-388q28 28 48 76t20 88v1152q0 40-28 68t-68 28h-1344q-40 0-68-28t-28-68v-1600q0-40 28-68t68-28h896q40 0 88 20t76 48zm-444-244v376h376q-10-29-22-41l-313-313q-12-12-41-22zm384 1528v-1024h-416q-40 0-68-28t-28-68v-416h-128v128h-128v-128h-512v1536h1280zm-627-721l107 349q8 27 8 52 0 83-72.5 137.5t-183.5 54.5-183.5-54.5-72.5-137.5q0-25 8-52 21-63 120-396v-128h128v128h79q22 0 39 13t23 34zm-141 465q53 0 90.5-19t37.5-45-37.5-45-90.5-19-90.5 19-37.5 45 37.5 45 90.5 19z"/></svg>';
			    		}else{
			    			$icon = '<svg xmlns="http://www.w3.org/2000/svg" width="1792" height="1792" viewBox="0 0 1792 1792"><path d="M1596 380q28 28 48 76t20 88v1152q0 40-28 68t-68 28h-1344q-40 0-68-28t-28-68v-1600q0-40 28-68t68-28h896q40 0 88 20t76 48zm-444-244v376h376q-10-29-22-41l-313-313q-12-12-41-22zm384 1528v-1024h-416q-40 0-68-28t-28-68v-416h-768v1536h1280z"/></svg>';
			    		}
			    	?>

			    	<div class="accordion accordion-flush" id="accordionFlushExample">
					    <div class="accordion-item">
					        <h2 class="accordion-header" id="flush-heading<?= $material['id']; ?>">
					            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?= $material['id']; ?>" aria-expanded="false" aria-controls="flush-collapse<?= $material['id']; ?>">
						        	<div class="row">
						            	<div class="col-auto">
						        			<div class="app-icon-holder">
						        				<?= $icon; ?>
						        			</div>
						        		</div>
						        		<div class="col-auto">
						            		<div class="title mb-1 "> <?= $material['title']; ?> </div>
						            		<div class="small">
								            	<small> Created By: <?= $material['uname']; ?> </small> | 
								                <small> Added: <?= $material['created_at']; ?> </small>
								            </div>
						        		</div>
						        	</div>
					            </button>
					        </h2>
					        <div id="flush-collapse<?= $material['id']; ?>" class="accordion-collapse collapse" aria-labelledby="flush-heading<?= $material['id']; ?>" data-bs-parent="#accordionFlushExample">
	    						<?php if($login_user_type == "Staff"): ?>

						        	<div class="d-grid gap-2 d-md-block m-3">

						        		<a href="material_edit.php?id=<?= $material['id'] ?>" class="btn btn-warning fw-normal">
						                	Edit
						                </a>

						                <form class="d-inline-block" onsubmit="return confirm('Are you sure want to delete?')" action="material_delete.php" method="POST">

						                    <input type="hidden" name="id" value="<?= $material['id'] ?>">
						                    
						                    <button class="btn btn-danger fw-normal">
						                        Delete
						                    </button>                                            
						                </form>

						        	</div>
								<?php endif ?>


					        	<?php if (in_array($type, $video_filetype)){ ?>
					            <video
								    id="my-video"
								    class="video-js"
								    controls
								    preload="auto"
								    width="640"
								    height="264"
								    data-setup="{}"
								>
								    <source src="<?= $file; ?>" type="video/mp4" />
								    <source src="<?= $file; ?>" type="video/webm" />
								    <p class="vjs-no-js">
								      To view this video please enable JavaScript, and consider upgrading to a
								      web browser that
								      <a href="https://videojs.com/html5-video-support/" target="_blank"
								        >supports HTML5 video</a
								      >
								    </p>
								</video>
								<?php } elseif (in_array($type, $image_filetype)){ ?>
									<img src="<?= $file; ?>" class="img-fluid">

								<?php }else{ ?>
									<a href="<?= $file ?>" target="_blank"> Download </a>
								<?php } ?>
					        </div>
					    </div>
					</div>

					<?php } ?>
					
					
				</div><!--//app-card-body-->
		    </div>
    	</div>
    </div>
	
<?php 
	require 'backend_footer.php';
?>


