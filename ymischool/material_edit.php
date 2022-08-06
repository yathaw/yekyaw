<?php 
	require 'backend_header.php';
	require 'connection.php';

	$id = $_GET['id'];


    $sql = "SELECT materials.*, courses.codeno as codeno, courses.title as ctitle
    		FROM materials 
    		INNER JOIN courses ON materials.course_id = courses.id
    		WHERE courses.id=:value1";
    $statement = $conn->prepare($sql);
    $statement->bindParam(':value1', $id);
    $statement->execute();

    $material = $statement->fetch(PDO::FETCH_ASSOC);

    $file = $material['file']; 
	$type_str = $material['type'];
	$type_arr = explode("/",$type_str);
	$type = strtolower(end($type_arr));

	$video_filetype = ["mov", "mp4","3gp", "ogg", "avi", "mpeg", "mpg"];
	$image_filetype = ["jpg","jpeg","png","gif"];
	$zip_filetype = ["zip"];
?>
	

	<div class="app-card app-card-orders-table shadow-sm mb-5">
		<div class="app-card-header p-3">
	        <div class="row justify-content-between align-items-center">
		        <div class="col-auto">
	                <h1 class="app-page-title mb-0"> Edit Existing Materials For <?= $material['codeno']; ?> </h1>
	                <p> <?= $material['ctitle']; ?> </p>
		        </div>
		        <div class="col-auto">
			        <div class="card-header-action">
				        <a href="course_detail.php?id=<?= $id; ?>" class="btn app-btn-secondary text-decoration-none"> Go Back </a>
			        </div>
		        </div>
	        </div>
        </div>
	    <div class="app-card-body p-3">

	    	<form class="forms-sample" action="material_update.php" method="POST" enctype="multipart/form-data">
	    		<input type="hidden" name="id" value="<?= $id; ?>">
	    		<input type="hidden" name="oldfile" value="<?= $file; ?>">
	    		<input type="hidden" name="oldfiletype" value="<?= $material['type']; ?>">
	    		<input type="hidden" name="oldfilesize" value="<?= $material['size']; ?>">
	    		<input type="hidden" name="courseid" value="<?= $material['course_id']; ?>">


	    		<div class="row mb-3">
				    <label for="inputTitle" class="col-sm-2 col-form-label">Title:</label>
				    <div class="col-sm-10">
				      	<input type="text" class="form-control" id="inputTitle" name="title" value="<?= $material['title']; ?>" required>
				    </div>
				</div>

				<div class="row mb-3">
				    <label for="inputFile1" class="col-sm-2 col-form-label"> File:</label>
				    <div class="col-sm-10">
				    	<ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
						  	<li class="nav-item" role="presentation">
						    	<button class="nav-link active" id="oldprofile-tab" data-bs-toggle="tab" data-bs-target="#oldprofile" type="button" role="tab" aria-controls="oldprofile" aria-selected="true">Old File</button>
						  	</li>
						  	<li class="nav-item" role="presentation">
						    	<button class="nav-link" id="newprofile-tab" data-bs-toggle="tab" data-bs-target="#newprofile" type="button" role="tab" aria-controls="newprofile" aria-selected="false">New File</button>
						  	</li>
						</ul>
						<div class="tab-content" id="myTabContent">
						  	<div class="tab-pane fade show active" id="oldprofile" role="tabpanel" aria-labelledby="oldprofile-tab">
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
						  	<div class="tab-pane fade" id="newprofile" role="tabpanel" aria-labelledby="newprofile-tab">
				      			<input type="file" id="inputPhoto" name="file">
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