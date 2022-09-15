<?php 
	require "header.php";
?>
	<!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> Stock </h1>
    </div>

        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header border-bottom scrollmenu">
                        <ul class="nav nav-tabs card-header-tabs" id="dashboardNav" role="tablist">
                            <li class="nav-item me-1"><a class="nav-link active" id="category-1-pill" href="#category-1" data-toggle="tab" role="tab" aria-controls="category-1" aria-selected="true">Bread</a></li>
                            <li class="nav-item"><a class="nav-link" id="category-2-pill" href="#category-2" data-toggle="tab" role="tab" aria-controls="category-2" aria-selected="false">Breakfast</a></li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Search by Code / Name">
                        </div>
                        <div class="tab-content" id="dashboardNavContent">
                            <!-- Dashboard Tab Pane 1-->
                            <div class=" tab-pane fade show active" id="category-1" role="tabpanel" aria-labelledby="category-1-pill">
                                <div class="row">
                                    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6 mb-3">
                                        <div class="card stockcart" data-toggle="modal" data-target="#exampleModal">
                                            <img src="img/product/p1.png" class="card-img-top" alt="...">
                                            <div class="card-img-overlay">
                                                <span class="badge badge-warning">1 Stock</span>
                                            </div>
                                            <div class="card-body">
                                                <h6 class="card-title text-capitalize text-dark font-weight-bold mb-0">pita beef beard</h6>
                                                <p> 987654321 </p>
                                                <span class="badge badge-dark">3,000 Ks</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6 mb-3">
                                        <div class="card stockcart">
                                            <img src="img/product/p2.png" class="card-img-top" alt="...">
                                            <div class="card-img-overlay">
                                                <span class="badge badge-danger">0 Stock</span>
                                            </div>
                                            <div class="card-body">
                                                <h6 class="card-title text-capitalize text-dark font-weight-bold mb-0">Croissant</h6>
                                                <p> 987654321 </p>
                                                <span class="badge badge-dark">3,000 Ks</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6 mb-3">
                                        <div class="card stockcart">
                                            <img src="img/product/p3.png" class="card-img-top" alt="...">
                                            <div class="card-img-overlay">
                                                <span class="badge badge-primary">2 Stocks</span>
                                            </div>
                                            <div class="card-body">
                                                <h6 class="card-title text-capitalize text-dark font-weight-bold mb-0">challah bread</h6>
                                                <p > 987654321 </p>
                                                <span class="badge badge-dark">3,000 Ks</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6 mb-3">
                                        <div class="card stockcart">
                                            <img src="img/product/p4.png" class="card-img-top" alt="...">
                                            <div class="card-img-overlay">
                                                <span class="badge badge-primary">3 Stocks</span>
                                            </div>
                                            <div class="card-body">
                                                <h6 class="card-title text-capitalize text-dark font-weight-bold mb-0">Croissant Bread</h6>
                                                <p class="text-muted"> 987654321 </p>
                                                <span class="badge badge-dark">3,000 Ks</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- Dashboard Tab Pane 2-->
                            <div class="tab-pane fade" id="category-2" role="tabpanel" aria-labelledby="category-2-pill">
                                
                            </div>
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
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="stockInput">Stock Count</label>
                        <input type="number" class="form-control" id="stockInput">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-sm">Save changes</button>
            </div>
        </div>
    </div>
</div>
<?php 
	require "footer.php";
?>

