<?php 
	require "header.php";
?>
	<!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> Sale </h1>
    </div>

    <div class="row">
        <div class="col-6">
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
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                    <div class="card addtocart">
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
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                    <div class="card addtocart_disabled">
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
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                    <div class="card addtocart">
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
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                    <div class="card addtocart">
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

        <div class="col-6">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th> Product </th>
                                    <th> Price </th>
                                    <th style="width: 120px"> Qty </th>
                                    <th> Subtotal </th>
                                    <th>  </th>
                                </tr>
                            </thead>
                            <tbody class="pb-5">
                                <tr>
                                    <td>
                                        <p class="h6 text-capitalize text-dark font-weight-bold mb-0">pita beef beard</p>
                                            <p> 987654321 </p>
                                    </td>
                                    <td> 3,000 Ks </td>
                                    <td> 
                                        <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-dark" type="button">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                            <input type="text" class="form-control" style="width: 25px" value="1" readonly>
                                            
                                            <div class="input-group-append">
                                                <button class="btn btn-dark" type="button">
                                                    <i class="fas fa-plus"></i>
                                                </button> 
                                            </div>
                                        </div>
                                    </td>
                                    <td> 6,000 Ks </td>
                                    <td>
                                        <button class="btn btn-outline-danger btn-sm" type="button"> 
                                            <i class="fas fa-times"></i>
                                        </button> 
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="h6 text-capitalize text-dark font-weight-bold mb-0">pita beef beard</p>
                                            <p> 987654321 </p>
                                    </td>
                                    <td> 3,000 Ks </td>
                                    <td> 
                                        <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-dark" type="button">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                            <input type="text" class="form-control" style="width: 25px" value="1" readonly>
                                            
                                            <div class="input-group-append">
                                                <button class="btn btn-dark" type="button">
                                                    <i class="fas fa-plus"></i>
                                                </button> 
                                            </div>
                                        </div>
                                    </td>
                                    <td> 6,000 Ks </td>
                                    <td>
                                        <button class="btn btn-outline-danger btn-sm" type="button"> 
                                            <i class="fas fa-times"></i>
                                        </button> 
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot >
                                <tr>
                                    <td colspan="2" class="pt-5">Total</td>
                                    <td colspan="3" class="pt-5">
                                        <span class="h3"> 1,2000 Ks </span>
                                    </td>

                                </tr>
                                <tr>
                                    <td colspan="2">Paid Money</td>
                                    <td colspan="3">
                                        <input type="number" class="form-control" id="discount" value="0">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">Charges</td>
                                    <td colspan="3">
                                        <input type="number" class="form-control" id="discount" value="0" disabled>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <button type="button" class="btn btn-outline-danger btn-sm btn-block">
                                            Reset
                                        </button>
                                    </td>
                                    <td colspan="3">
                                        <button type="button" class="btn btn-dark btn-sm btn-block">
                                            Pay Now
                                        </button>
                                    </td>
                                </tr>

                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>


<?php 
	require "footer.php";
?>

