<?php 
	require "header.php";
    require "dbconnect.php";
?>
	<!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> Category </h1>
        <a href="category_new.php" class="d-none d-sm-inline-block btn btn-sm btn-dark shadow-sm">
        	<i class="fas fa-plus fa-sm text-white-50"></i> Add New 
        </a>
    </div>

    <div class="row">
        <?php if(isset($_SESSION['success_msg'])){ ?>
        <div class="col-12">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $_SESSION['success_msg']; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        <?php } 
            unset($_SESSION['success_msg']);
        ?>

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
                                <?php 
                                    $select = "SELECT * FROM categories";
                                    $query = mysqli_query($conn, $select);

                                    $count = mysqli_num_rows($query);

                                    if($count > 0){

                                    $no = 1;
                                    for($i=0; $i < $count; $i++){
                                        $data = mysqli_fetch_array($query);

                                        $id = $data['id'];
                                        $name = $data['name'];
                                ?>
                                <tr>
                                    <td> <?= $no++; ?>. </td>
                                    <td> <?= $name; ?> </td>
                                    <td>
                                        <a href="category_edit.php?id=<?php echo $id ?>" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        
                                        <a href="category_delete.php?id=<?php echo $id ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure want to delete? ')">
                                            <i class="fas fa-trash-alt"></i> Delete
                                        </a>

                                    </td>
                                </tr>
                                <?php
                                    }
                                    }
                                ?>
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

