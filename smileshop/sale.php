<?php 
	require "header.php";
    require 'dbconnect.php';

?>
	<!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> Sale </h1>
    </div>

    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
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

                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                        <div class="card addtocart" data-id="<?= $id ?>" data-name="<?= $name ?>" data-codeno="<?= $codeno ?>" data-price="<?= $price; ?>">
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

        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive" id="voucherDiv">
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
                            </tbody>
                            <tfoot >
                                <tr>
                                    <td colspan="2" class="pt-5">Total</td>
                                    <td colspan="3" class="pt-5">
                                        <span class="h3" id="totalAmount"> </span>
                                    </td>

                                </tr>
                                <tr>
                                    <td colspan="2">Paid Money</td>
                                    <td colspan="3">
                                        <input type="number" class="form-control" id="inputPaidmoney" value="0">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">Charges</td>
                                    <td colspan="3">
                                        <input type="number" class="form-control" id="inputCharges" value="0" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <button type="button" class="btn btn-outline-danger btn-sm btn-block" id="resetBtn">
                                            Reset
                                        </button>
                                    </td>
                                    <td colspan="3">
                                        <button type="button" class="btn btn-dark btn-sm btn-block " id="checkoutBtn">
                                            Pay Now
                                        </button>
                                    </td>
                                </tr>

                            </tfoot>
                        </table>
                    </div>
                    <div class="row justify-content-center" id="emptyvoucherDiv">
                        <div class="col-8 py-5">
                            <h3 class="text-center"> No product in this cart. </h3>
                            <img src="img/nocart.webp" class="img-fluid">
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

    </div>


<?php 
	require "footer.php";
?>

<script type="text/javascript">
    
    $(document).ready(function(){
        showTable();

        $('#searchInput').keyup(function(event){
            var searchField = $('#searchInput').val();
            var filetype = "sale";

            console.log(searchField);

            var url = 'getSearchdata.php';

            $.ajax({
                type: 'POST',
                url: url,
                data: {keyword: searchField, filetype:filetype},

            }).done(function(data){
                console.log(data);
                $('#searchResult').html(data);
            })
        });


        $('.addtocart').click(function(){
            var id = $(this).data('id');
            var name = $(this).data('name');
            var codeno = $(this).data('codeno');
            var price = $(this).data('price');

            var item = {
                id:id,
                name:name,
                codeno:codeno,
                price:price,
                qty:1
            };

            var itemString = localStorage.getItem("itemlist");  // localstorage ကို ယူတာ
            var itemArray;

            if(itemString == null){
                itemArray = Array();
            }else{
                itemArray = JSON.parse(itemString); // string to array 
            }

            var status = false; // item တူတာ localStorage ထဲမှာမရှိဘူး

            $.each(itemArray, function(i,v){
                if(id == v.id){
                    status = true; // item တူတာ localStorage ထဲမှာရှိတယ်
                    v.qty++;
                }
            })

            if(!status){
                itemArray.push(item);
            }

            var itemData = JSON.stringify(itemArray);  // array to string

            localStorage.setItem("itemlist", itemData);

            showTable();

        });


        function showTable(){
            var itemString = localStorage.getItem("itemlist");

            if(itemString){
                var itemArray = JSON.parse(itemString);

                if(itemArray != 0){ // localStorage မှာ data ရှိတယ်
                    $('#voucherDiv').show();
                    $('#emptyvoucherDiv').hide();

                    var tbodyData = ''; var total = 0;

                    $.each(itemArray,function(i, v){
                        var name = v.name;
                        var price = v.price;
                        var codeno = v.codeno;
                        var qty = v.qty;
                        var subtotal = price*qty;

                        total += subtotal;

                        tbodyData +=`<tr>
                                        <td>
                                            <p class="h6 text-capitalize text-dark font-weight-bold mb-0">${name}</p>
                                                <p> ${codeno} </p>
                                        </td>
                                        <td> ${price} Ks </td>
                                        <td> 
                                            <div class="input-group input-group-sm mb-3">
                                                <div class="input-group-prepend">
                                                    <button class="btn btn-dark minusBtn" type="button" data-id="${i}">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                </div>
                                                <input type="text" class="form-control" style="width: 25px" value="${qty}" readonly>
                                                
                                                <div class="input-group-append">
                                                    <button class="btn btn-dark plusBtn" type="button" data-id="${i}">
                                                        <i class="fas fa-plus"></i>
                                                    </button> 
                                                </div>
                                            </div>
                                        </td>
                                        <td> ${subtotal} Ks </td>
                                        <td>
                                            <button class="btn btn-outline-danger btn-sm removeBtn" type="button" data-id="${i}"> 
                                                <i class="fas fa-times"></i>
                                            </button> 
                                        </td>
                                    </tr>
                        `;
                    });

                    $("tbody").html(tbodyData);
                    $('#totalAmount').html(total);

                }else{
                    $('#voucherDiv').hide();
                    $('#emptyvoucherDiv').show();
                }

            }else{
                $('#voucherDiv').hide();
                $('#emptyvoucherDiv').show();
            }
        }

        $('tbody').on('click', '.plusBtn', function(){
            var id = $(this).data('id');
            var itemString = localStorage.getItem("itemlist");  // localstorage ကို ယူတာ
            var itemArray = JSON.parse(itemString); // string to array 

            $.each(itemArray, function(i,v){
                if(i == id){
                    v.qty++;
                }
            })
            var itemData = JSON.stringify(itemArray);  // array to string
            localStorage.setItem("itemlist", itemData);
            showTable();
        });

        $('tbody').on('click', '.minusBtn', function(){
            var id = $(this).data('id');
            var itemString = localStorage.getItem("itemlist");  // localstorage ကို ယူတာ
            var itemArray = JSON.parse(itemString); // string to array 

            $.each(itemArray, function(i,v){
                if(i == id){
                    v.qty--;
                    if(v.qty == 0){
                        itemArray.splice(id, 1);
                    }
                }
            })
            var itemData = JSON.stringify(itemArray);  // array to string
            localStorage.setItem("itemlist", itemData);
            showTable();
        });

        $('tbody').on('click', '.removeBtn', function(){
            var id = $(this).data('id');
            var itemString = localStorage.getItem("itemlist");  // localstorage ကို ယူတာ
            var itemArray = JSON.parse(itemString); // string to array 

            $.each(itemArray, function(i,v){
                if(i == id){
                    itemArray.splice(id, 1);
                }
            })
            var itemData = JSON.stringify(itemArray);  // array to string
            localStorage.setItem("itemlist", itemData);
            showTable();
        });

        $('tfoot').on('focus', '#inputCharges', function(){
        
            var paidmoney = $('#inputPaidmoney').val();
            var total = $('#totalAmount').text();

            var chargesmoney = paidmoney - total;

            $('#inputCharges').val(chargesmoney);

        });

        $('#resetBtn').click(function(){
            localStorage.clear();
            showTable();
        });

        $('#checkoutBtn').click(function(){
            // Store Database

            var itemString = localStorage.getItem("itemlist");  // localstorage ကို ယူတာ
            var itemArray = JSON.parse(itemString); // string to array 
            var total = $('#totalAmount').text();

            var url = 'storeSaledata.php';

            $.ajax({
                type: 'POST',
                url: url,
                data: {cart: itemArray, total: total},

            }).done(function(data){
                localStorage.clear();
                showTable();
            })

        });
    });

</script>

