<?php 
	require "header.php";
    require 'dbconnect.php';

?>
	<!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> Stock </h1>
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
                    <div class="card-header border-bottom scrollmenu">
                        <ul class="nav nav-tabs card-header-tabs" id="dashboardNav" role="tablist">
                            <?php 

                                $category_select = "SELECT * FROM categories";
                                $category_query = mysqli_query($conn, $category_select);

                                $category_count = mysqli_num_rows($category_query);
                                if($category_count > 0){

                                for($i=0; $i < $category_count; $i++){
                                    $data = mysqli_fetch_array($category_query);

                                    $cid = $data['id'];
                                    $cname = $data['name'];
                            ?>

                            <li class="nav-item me-1">
                                <a class="nav-link <?php if($i == 0){ ?> active <?php } ?>" id="category-<?= $cid; ?>-pill" href="#category-<?= $cid; ?>" data-toggle="tab" role="tab" aria-controls="category-<?= $cid; ?>" aria-selected="<?php if($i == 0){ ?> true <?php } else { ?> false <?php } ?> "><?= $cname; ?> </a>
                            </li>

                            <?php }
                                }
                            ?>
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Search by Code / Name" id="searchInput">
                        </div>
                        <div class="tab-content" id="dashboardNavContent">
                            <div class="row bg-light" id="searchResult"></div>
                            <?php 

                                $category2_select = "SELECT * FROM categories";
                                $category2_query = mysqli_query($conn, $category2_select);

                                $category2_count = mysqli_num_rows($category2_query);
                                if($category2_count > 0){

                                for($c2i=0; $c2i < $category2_count; $c2i++){
                                    $data = mysqli_fetch_array($category2_query);

                                    $c2id = $data['id'];
                                    $c2name = $data['name'];

                                    $product_select = "SELECT * FROM products WHERE category_id = '$c2id'";
                                    $product_query = mysqli_query($conn, $product_select);

                                    $product_count = mysqli_num_rows($product_query);
                            ?>
                                <!-- Dashboard Tab Pane 1-->
                                <div class=" tab-pane fade <?php if($c2i == 0){ ?> show active <?php } ?> " id="category-<?= $c2id ?>" role="tabpanel" aria-labelledby="category-<?= $c2id ?>-pill">
                                    <div class="row">
                                        <?php 
                                            if($product_count > 0){
                                            for($pi=0; $pi < $product_count; $pi++){
                                                $data = mysqli_fetch_array($product_query);

                                                $id = $data['id'];
                                                $name = $data['name'];
                                                $photo = $data['photo'];
                                                $codeno = $data['codeno'];
                                                $price = $data['price'];
                                        ?>

                                        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6 mb-3">
                                            <div class="card stockcart" data-id="<?= $id ?>" data-name="<?= $name ?>" data-codeno="<?= $codeno ?>">
                                                <img src="<?= $photo ?>" class="card-img-top" alt="...">
                                                <div class="card-img-overlay">
                                                    <span class="badge badge-warning">1 Stock</span>
                                                </div>
                                                <div class="card-body">
                                                    <h6 class="card-title text-capitalize text-dark font-weight-bold mb-0"> <?= $name ?> </h6>
                                                    <p> <?= $codeno ?> </p>
                                                    <span class="badge badge-dark"> <?= number_format($price) ?> Ks</span>
                                                </div>
                                            </div>
                                        </div>

                                        <?php 
                                                }
                                            }
                                        ?>

                                    </div>
                                </div>
                            <?php }
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Add Stock </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="stock_add.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" id="idInput" name="id">

                    <div class="row">
                        <div class="col-xl-3 form-group">
                            <label for="codenoInput">Codeno</label>
                            <input type="text" class="form-control" id="codenoInput" disabled>
                        </div>
                        <div class="col-xl-9 form-group">
                            <label for="nameInput">Product</label>
                            <input type="text" class="form-control" id="nameInput" disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="stockdateInput">Stock Date</label>
                        <input type="date" class="form-control" id="stockdateInput" name="date">
                    </div>

                    <div class="form-group">
                        <label for="stockInput">Stock Count</label>
                        <input type="number" class="form-control" id="stockInput" name="count">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
                </div>
            </form>

        </div>
    </div>
</div>
<?php 
	require "footer.php";
?>

<script type="text/javascript">
    
    $(document).ready(function() {
        $('#searchInput').keyup(function(event) {
            var searchField = $('#searchInput').val();
            console.log(searchField);

            var url = 'getSearchdata.php';

            $.ajax({
                type: 'POST',
                url: url,
                data: {keyword: searchField},

            }).done(function(data){
                console.log(data);
                $('#searchResult').html(data);
            })
        });

        $('.stockcart').click(function(){
            var id = $(this).data('id');
            var name = $(this).data('name');
            var codeno = $(this).data('codeno');

            $('#exampleModal').modal('show');

            $('#idInput').val(id);
            $('#codenoInput').val(codeno);
            $('#nameInput').val(name);


        });

    });

</script>




