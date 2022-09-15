<?php 
    require "header.php";
?>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> Create New </h1>
        <a href="product_list.php" class="d-none d-sm-inline-block btn btn-sm btn-outline-secondary shadow-sm">
            <i class="fas fa-backward fa-sm "></i> Go Back
        </a>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow border-0 mb-4">
                <div class="card-body">
                    <form class="row">
                        <div class="col-12 mb-3">
                            <label class="form-label d-block">Photo</label>
                            <input type="file">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="inputCodeno" class="form-label">Codeno</label>
                            <input type="text" class="form-control" id="inputCodeno">
                        </div>

                        <div class="col-6 mb-3">
                            <label for="inputName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="inputName">
                        </div>

                        <div class="col-6 mb-3">
                            <label for="inputPrice" class="form-label">Price</label>
                            <input type="text" class="form-control" id="inputPrice">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="inputState" class="form-label">Category</label>
                            <select id="inputState" class="form-control">
                                <option selected>Choose...</option>
                                <option>...</option>
                            </select>
                        </div>

                        <div class="col-2 mb-3">
                            <label for="inputName" class="form-label">Stock Count</label>
                            <input type="number" class="form-control" id="inputName">
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

