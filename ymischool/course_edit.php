<?php 
	require 'backend_header.php';
	require 'connection.php';

	$id = $_GET['id'];

	$sql = "SELECT * FROM courses WHERE id = :value1";
    $statement = $conn->prepare($sql);
    $statement->bindParam(':value1', $id);
    $statement->execute();

    $course = $statement->fetch(PDO::FETCH_ASSOC);


	$sql = "SELECT * FROM subcategories 
    		ORDER BY name ASC";
    $statement = $conn->prepare($sql);
    $statement->execute();

    $subcategories = $statement->fetchAll();

    $id = $course['id'];
	$codeno = $course['codeno'];
	$title = $course['title'];
	$description = $course['description'];
	$image = $course['image'];
	$video = $course['video'];
	$price = $course['price'];
	$duration = $course['duration'];
	$subcategory_id = $course['subcategory_id'];
	$studylevel = $course['studylevel'];
	$totalclass = $course['totalclass'];
	$totalcoursework = $course['totalcoursework'];
	$totalstudent = $course['totalstudent'];

?>
	

	<div class="app-card app-card-orders-table shadow-sm mb-5">
		<div class="app-card-header p-3">
	        <div class="row justify-content-between align-items-center">
		        <div class="col-auto">
	                <h1 class="app-page-title mb-0"> Edit Course </h1>
		        </div>
		        <div class="col-auto">
			        <div class="card-header-action">
				        <a href="course_list.php" class="btn app-btn-secondary text-decoration-none"> Go Back </a>
			        </div>
		        </div>
	        </div>
        </div>
	    <div class="app-card-body p-3">

	    	<form class="forms-sample" action="course_update.php" method="POST" enctype="multipart/form-data">
	    		<input type="hidden" name="id" value="<?= $id ?>">
	    		<input type="hidden" name="oldphoto" value="<?= $image ?>">
	    		<input type="hidden" name="oldvideo" value="<?= $video ?>">


	    		<div class="row mb-3">
				    <label for="inputPhoto" class="col-sm-2 col-form-label">Cover Photo:</label>
				    <div class="col-sm-10">
				    	<ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
						  	<li class="nav-item" role="presentation">
						    	<button class="nav-link active" id="oldprofile-tab" data-bs-toggle="tab" data-bs-target="#oldprofile" type="button" role="tab" aria-controls="oldprofile" aria-selected="true">Old Photo</button>
						  	</li>
						  	<li class="nav-item" role="presentation">
						    	<button class="nav-link" id="newprofile-tab" data-bs-toggle="tab" data-bs-target="#newprofile" type="button" role="tab" aria-controls="newprofile" aria-selected="false">New Photo</button>
						  	</li>
						</ul>
						<div class="tab-content" id="myTabContent">
						  	<div class="tab-pane fade show active" id="oldprofile" role="tabpanel" aria-labelledby="oldprofile-tab">
						  		<img src="<?= $image; ?> " class="w-25 h-25 img-thumbnail ">
						  	</div>
						  	<div class="tab-pane fade" id="newprofile" role="tabpanel" aria-labelledby="newprofile-tab">
				      			<input type="file" id="inputPhoto" name="photo">
						  	</div>
						</div>
				    </div>
				</div>

				<div class="row mb-3">
				    <label for="inputVideo" class="col-sm-2 col-form-label"> AD Video:</label>
				    <div class="col-sm-10">
				    	<ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
						  	<li class="nav-item" role="presentation">
						    	<button class="nav-link active" id="oldvideo-tab" data-bs-toggle="tab" data-bs-target="#oldvideo" type="button" role="tab" aria-controls="oldvideo" aria-selected="true">Old Video</button>
						  	</li>
						  	<li class="nav-item" role="presentation">
						    	<button class="nav-link" id="newvideo-tab" data-bs-toggle="tab" data-bs-target="#newvideo" type="button" role="tab" aria-controls="newvideo" aria-selected="false">New Video</button>
						  	</li>
						</ul>
						<div class="tab-content" id="myTabContent">
						  	<div class="tab-pane fade show active" id="oldvideo" role="tabpanel" aria-labelledby="oldvideo-tab">
						  		<video
								    id="my-video"
								    class="video-js"
								    controls
								    preload="auto"
								    width="640"
								    height="264"
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
						  	</div>
						  	<div class="tab-pane fade" id="newvideo" role="tabpanel" aria-labelledby="newvideo-tab">
				      			<input type="file" id="inputVideo" name="video">
						  	</div>
						</div>
				    </div>
				</div>

				<div class="row mb-3">
				    <label for="inputCodeno" class="col-sm-2 col-form-label">Codeno:</label>
				    <div class="col-sm-10">
				      	<input type="text" class="form-control" id="inputCodeno" name="codeno" value="<?= $codeno; ?>">
				    </div>
				</div>

				<div class="row mb-3">
				    <label for="inputSubject" class="col-sm-2 col-form-label">Select Subject:</label>
				    <div class="col-sm-10">
				      	<select class="form-control" id="inputSubject" name="subcategory">
                            <option selected disabled> Choose One Subject </option>

				      		<?php foreach($subcategories as $subcategory){ ?>
				      		<option value="<?= $subcategory['id']; ?>" <?php if($subcategory_id == $subcategory['id']){ echo "selected"; } ?> > <?= $subcategory['name']; ?> </option>
				      		<?php } ?>

				      	</select>
				    </div>
				</div>

                <div class="row mb-3">
				    <label for="inputTitle" class="col-sm-2 col-form-label">Title:</label>
				    <div class="col-sm-10">
				      	<input type="text" class="form-control" id="inputTitle" name="title" value="<?= $title ?>">
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
	  						<input type="number" class="form-control" id="inputPrice" name="price" value="<?= $price ?>">
	  					</div>
				    </div>
				</div>

				<div class="row mb-3">
				    <label for="inputStudylevel" class="col-sm-2 col-form-label">Study Level:</label>
				    <div class="col-sm-10">
				      	<input type="text" class="form-control" id="inputStudylevel" name="studylevel" value="<?= $studylevel ?>">
				    </div>
				</div>
				
				<div class="row mb-3">
				    <label for="inputDuration" class="col-sm-2 col-form-label">Duration:</label>
				    <div class="col-sm-10">
				      	<input type="text" class="form-control" id="inputDuration" name="duration" placeholder="e.g: 3 Years/ 60 Hours / 3 Months" value="<?= $duration ?>">
				    </div>
				</div>

				<div class="row mb-3">
				    <label for="inputDescription" class="col-sm-2 col-form-label">Description:</label>
				    <div class="col-sm-10">
				      	<textarea class="form-control" name="description" style="height:150px"><?= $description; ?></textarea>
				    </div>
				</div>

				<div class="row mb-3">
				    <label for="inputStudylevel" class="col-sm-2 col-form-label"> Total Number Of:</label>
				    <div class="col-sm-10">
				    	<div class="row g-3">
				    		<div class="col-4">
						      	<input type="number" class="form-control" id="input" name="totalclass" placeholder="Total Class" value="<?= $totalclass ?>">
						      	<small> Total Class </small>
						    </div>
				    		<div class="col-4">
						      	<input type="number" class="form-control" id="inputCoursework" name="totalcoursework" placeholder="Total Coursework" value="<?= $totalcoursework ?>">
						      	<small> Total Coursework </small>

						    </div>
						    <div class="col-4">
						      	<input type="number" class="form-control" id="input" name="totalstudent" placeholder="Total Students in Each Classes" value="<?= $totalstudent ?>">
						      	<small> Total Student </small>

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