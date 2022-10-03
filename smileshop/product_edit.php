<?php 
    require "header.php";
    require 'dbconnect.php';

    $id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE id='$id' ";
    $query = mysqli_query($conn, $sql);

    $data = mysqli_fetch_array($query);

    $codeno = $data['codeno'];
    $name = $data['name'];
    $photo = $data['photo'];
    $price = $data['price'];
    $category_id = $data['category_id'];


    $select = "SELECT * FROM categories";
    $query = mysqli_query($conn, $select);
    $count = mysqli_num_rows($query);
?>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> Edit Existing Data </h1>
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
                    <form class="row" action="product_update.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="oldphoto" value="<?= $photo ?>">
                        <input type="hidden" name="id" value="<?= $id ?>">

                        <div class="col-12 mb-3">
                            <label class="form-label d-block">Photo</label>

                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="oldphoto-tab" data-toggle="tab" data-target="#oldphoto" type="button" role="tab" aria-controls="oldphoto" aria-selected="true">Old Photo </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="newphoto-tab" data-toggle="tab" data-target="#newphoto" type="button" role="tab" aria-controls="newphoto" aria-selected="false">New Photo </button>
                                </li>
                            </ul>
                            <div class="tab-content mt-3" id="myTabContent">
                                <div class="tab-pane fade show active" id="oldphoto" role="tabpanel" aria-labelledby="oldphoto-tab">
                                  <img src="<?= $photo ?>" class="img-fluid img-thumbnail w-25">
                                </div>
                                <div class="tab-pane fade" id="newphoto" role="tabpanel" aria-labelledby="newphoto-tab">
                                    <input type="file" name="photo">
                                </div>
                            </div>

                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-3">
                            <label for="inputCodeno" class="form-label">Codeno</label>
                            <input type="text" class="form-control" id="inputCodeno" name="codeno" value="<?= $codeno ?>">
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-3">
                            <label for="inputName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="inputName" name="name" value="<?= $name ?>">
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-3 mb-3">
                            <label for="inputCategory" class="form-label">Category</label>
                            <select id="inputCategory" class="form-control" name="categoryid">
                                <option>Choose...</option>
                                <?php 
                                    for($i=0; $i < $count; $i++){
                                        $data = mysqli_fetch_array($query);
                                        $id = $data['id'];
                                        $name = $data['name'];
                                ?>
                                <option value="<?= $id ?>" <?php if($id == $category_id){ echo "selected"; } ?> > <?= $name; ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                        
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-3">
                            <label for="inputPrice" class="form-label">Price</label>
                            <input type="text" class="form-control" id="inputPrice" name="price" value="<?= $price ?>">
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

