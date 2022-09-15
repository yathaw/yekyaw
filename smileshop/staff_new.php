<?php 
	require "header.php";
?>
	<!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> Create New </h1>
        <a href="staff_list.php" class="d-none d-sm-inline-block btn btn-sm btn-outline-secondary shadow-sm">
        	<i class="fas fa-backward fa-sm "></i> Go Back
        </a>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4 border-0">
                <div class="card-body">
                    <form class="row g-3">
                        <div class="col-12">
                            <label class="form-label d-block">Photo</label>
                            <input type="file">
                        </div>

                        <div class="col-6 ">
                            <label for="inputName" class="form-label">Username</label>
                            <input type="text" class="form-control" id="inputName">
                        </div>

                        <div class="col-md-6">
                            <label for="inputPhone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="inputPhone">
                        </div>

                        <div class="col-12">
                            <label for="inputPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="inputPassword">
                        </div>
                        
                        
                        <div class="col-12">
                            <button type="submit" class="btn btn-dark">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    

<?php 
	require "footer.php";
?>

