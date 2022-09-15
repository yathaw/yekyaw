<?php 
	require "header.php";
?>
	<!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> Product </h1>
        <a href="product_new.php" class="d-none d-sm-inline-block btn btn-sm btn-dark shadow-sm">
        	<i class="fas fa-plus fa-sm text-white-50"></i> Add New 
        </a>
    </div>

        <div class="row">
        <div class="col-12">

            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td> 1. </td>
                                    <td> Bread </td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm">
                                            <i class="fas fa-info"></i> View
                                        </button>
                                        <button type="button" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i> Delete
                                        </button>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

<?php 
	require "footer.php";
?>

