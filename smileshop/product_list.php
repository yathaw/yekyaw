<?php 
	require "header.php";
    require 'dbconnect.php';

?>
	<!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> Product </h1>
        <a href="product_new.php" class="d-none d-sm-inline-block btn btn-sm btn-dark shadow-sm">
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
                                    <th>Price</th>
                                    <th>Cateogry</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $select = "SELECT products.*, 
                                                categories.id as cid, 
                                                categories.name as cname 
                                                FROM products 
                                                INNER JOIN categories 
                                                ON products.category_id = categories.id
                                            ";
                                    $query = mysqli_query($conn, $select);

                                    $count = mysqli_num_rows($query);

                                    if($count > 0){

                                    $no = 1;
                                    for($i=0; $i < $count; $i++){
                                        $data = mysqli_fetch_array($query);

                                        $id = $data['id'];
                                        $name = $data['name'];
                                        $photo = $data['photo'];
                                        $codeno = $data['codeno'];
                                        $price = $data['price'];

                                        $categoryid = $data['cid'];
                                        $categoryname = $data['cname'];


                                ?>
                                <tr>
                                    <td> <?= $no++ ?>. </td>
                                    <td> 
                                        <div class="d-flex no-block align-items-center">
                                            <img src="<?= $photo ?>" alt="<?= $codeno ?>" class="rounded-circle" width="50" height="45" />
                                            <div class="">
                                                <h5 class="text-dark mb-0 font-16 font-weight-medium"> <?= $codeno; ?> </h5>
                                                <span class="text-muted font-14">
                                                    <?= $name; ?>
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td> <?= number_format($price) ?> Ks </td>
                                    <td> <?= $categoryname; ?> </td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm">
                                            <i class="fas fa-info"></i> View
                                        </button>
                                        <a href="product_edit.php?id=<?php echo $id ?>" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i> Delete
                                        </button>

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

