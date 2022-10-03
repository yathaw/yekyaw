<?php 
    require "header.php";
    require 'dbconnect.php';

    $select = "SELECT * FROM categories";
    $query = mysqli_query($conn, $select);
    $count = mysqli_num_rows($query);
?>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> Create New </h1>
        <a href="product_list.php" class="d-none d-sm-inline-block btn btn-sm btn-outline-secondary shadow-sm">
            <i class="fas fa-backward fa-sm "></i> Go Back
        </a>
    </div>

    <div class="row">

        <?php if(isset($_SESSION['err_msg'])){ ?>
        <div class="col-12">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php
                    $errors = $_SESSION['err_msg'];
                ?>
                <ul>
                    <?php foreach($errors as $error){ ?>
                    <li> <?= $error ?> </li>
                    <?php } ?>
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        <?php } 
            unset($_SESSION['err_msg']);
        ?>

        <div class="col-12">
            <div class="card shadow border-0 mb-4">
                <div class="card-body">
                    <form class="row" action="product_add.php" method="POST" enctype="multipart/form-data">
                        <div class="col-12 mb-3">
                            <label class="form-label d-block">Photo</label>
                            <input type="file" name="photo">
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mb-3">
                            <label for="inputCodeno" class="form-label">Codeno</label>
                            <input type="text" class="form-control" id="inputCodeno" name="codeno">
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-3">
                            <label for="inputName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="inputName" name="name">
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mb-3 mb-3">
                            <label for="inputCategory" class="form-label">Category</label>
                            <select id="inputCategory" class="form-control" name="categoryid">
                                <option selected>Choose...</option>
                                <?php 
                                    for($i=0; $i < $count; $i++){
                                        $data = mysqli_fetch_array($query);
                                        $id = $data['id'];
                                        $name = $data['name'];
                                ?>
                                <option value="<?= $id ?>"> <?= $name; ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                        
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-3">
                            <label for="inputPrice" class="form-label">Price</label>
                            <input type="text" class="form-control" id="inputPrice" name="price">
                        </div>
                        
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                            <label for="inputStockdate" class="form-label"> Stock Date </label>
                            <input type="date" class="form-control" id="inputStockdate" name="stockdate">
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                            <label for="inputStockcount" class="form-label">Stock Count</label>
                            <input type="number" class="form-control" id="inputStockcount" name="stockcount">
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

