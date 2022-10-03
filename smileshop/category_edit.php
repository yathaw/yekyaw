<?php 
	require "header.php";
    require "dbconnect.php";

    $id = $_GET['id'];
    $sql = "SELECT * FROM categories WHERE id='$id' ";
    $query = mysqli_query($conn, $sql);

    $data = mysqli_fetch_array($query);
    $name = $data['name'];
?>
	<!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> Edit Existing Data </h1>
        <a href="category_list.php" class="d-none d-sm-inline-block btn btn-sm btn-outline-secondary shadow-sm">
        	<i class="fas fa-backward fa-sm "></i> Go Back
        </a>
    </div>

    <div class="row">
        <?php if(isset($_SESSION['err_msg'])){ ?>
        <div class="col-12">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $_SESSION['err_msg']; ?>
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
                    <form class="row g-3" action="category_update.php" method="POST">
                        <input type="hidden" name="id" value="<?= $id ?>">
                        
                        <div class="col-12 mb-3">
                            <label for="inputName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="inputName" name="name" value="<?= $name ?>">
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

