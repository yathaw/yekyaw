<?php 
	require 'dbconnect.php';

	$keyword = $_POST['keyword'];

	// $select = "SELECT * FROM products WHERE codeno='$keyword' OR name='$keyword' ";

	$select = "SELECT * FROM products WHERE (`codeno` LIKE '%".$keyword."%') OR (`name` LIKE '%".$keyword."%')";

    $query = mysqli_query($conn, $select);
    $count = mysqli_num_rows($query);

    if($count > 0){

        for($i=0; $i < $count; $i++){
            $data = mysqli_fetch_array($query);

            $id = $data['id'];
            $name = $data['name'];
            $photo = $data['photo'];
            $codeno = $data['codeno'];
            $price = $data['price'];

        ?>

    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6 mb-3">
        <div class="card stockcart" data-toggle="modal" data-target="#exampleModal">
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