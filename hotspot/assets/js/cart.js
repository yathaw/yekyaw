$(document).ready(function(){

	$('#voucherDiv').hide();
	showTable(); // function ခေါ်နည်း

	$('.addtocart').click(function(){
		var id = $(this).data('id');
		var name = $(this).data('name');
		var price = $(this).data('price');

		var menu = {
			id:id,
			name:name,
			price:price,
			qty:1
		};

		var menuString = localStorage.getItem("menulist");  // localstorage ကို ယူတာ
		var menuArray;

		if(menuString == null){
			menuArray = Array();
		}else{
			menuArray = JSON.parse(menuString); // string to array 
		}

		var status = false; // item တူတာ localStorage ထဲမှာမရှိဘူး

		$.each(menuArray, function(i,v){
			if(id == v.id){
				status = true; // item တူတာ localStorage ထဲမှာရှိတယ်
				v.qty++;
			}
		})

		if(!status){
			menuArray.push(menu);
		}

		var menuData = JSON.stringify(menuArray);  // array to string

		localStorage.setItem("menulist", menuData);

		showTable();
		// console.log(menuString);

	});

	function showTable(){
		var menuString = localStorage.getItem("menulist");

		if(menuString){
			var menuArray = JSON.parse(menuString);

			if(menuArray != 0){ // localStorage မှာ data ရှိတယ်
				$('#voucherDiv').show();

				var tbodyData = ''; var total = 0;

				$.each(menuArray,function(i, v){
					var name = v.name;
					var price = v.price;
					var qty = v.qty;
					var subtotal = price*qty;

					total += subtotal;

					tbodyData +=`<tr>
									<td>
										<div class="btn-group-vertical">
											<button type="button" class="btn btn-sm btn-dark plusBtn" data-id="${i}"> + </button>
  											<button type="button" class="btn btn-sm btn-dark minusBtn" data-id="${i}"> - </button>
										</div>
										<span class="ps-3 fs-3"> ${qty} </span>
									</td>
									<td>
										<h6> ${name}</h6>
										<small> ${price}</small>
									</td>
									<td>
										${subtotal}
										<i class="fa-solid fa-circle-xmark float-end fa-lg text-danger removeBtn" data-id="${i}"></i>
									</td>
								</tr>
					`;
				});

				$("tbody").html(tbodyData);
				$('#totalAmount').html(total);

			}else{
				$('#voucherDiv').hide();
			}

		}else{
			$('#voucherDiv').hide();
		}
	}

	$('tbody').on('click', '.plusBtn', function(){
		var id = $(this).data('id');
		var menuString = localStorage.getItem("menulist");  // localstorage ကို ယူတာ
		var menuArray = JSON.parse(menuString); // string to array 

		$.each(menuArray, function(i,v){
			if(i == id){
				v.qty++;
			}
		})
		var menuData = JSON.stringify(menuArray);  // array to string
		localStorage.setItem("menulist", menuData);
		showTable();
	});

	$('tbody').on('click', '.minusBtn', function(){
		var id = $(this).data('id');
		var menuString = localStorage.getItem("menulist");  // localstorage ကို ယူတာ
		var menuArray = JSON.parse(menuString); // string to array 

		$.each(menuArray, function(i,v){
			if(i == id){
				v.qty--;
				if(v.qty == 0){
					menuArray.splice(id, 1);
				}
			}
		})
		var menuData = JSON.stringify(menuArray);  // array to string
		localStorage.setItem("menulist", menuData);
		showTable();
	});

	$('tbody').on('click', '.removeBtn', function(){
		var id = $(this).data('id');
		var menuString = localStorage.getItem("menulist");  // localstorage ကို ယူတာ
		var menuArray = JSON.parse(menuString); // string to array 

		$.each(menuArray, function(i,v){
			if(i == id){
				menuArray.splice(id, 1);
			}
		})
		var menuData = JSON.stringify(menuArray);  // array to string
		localStorage.setItem("menulist", menuData);
		showTable();
	});


	$('tfoot').on('focus', '#inputCharges', function(){
		
		var paidmoney = $('#inputPaidmoney').val();
		var total = $('#totalAmount').text();

		var chargesmoney = paidmoney - total;

		$('#inputCharges').val(chargesmoney);

	});


	$('#checkoutBtn').click(function(){
		localStorage.clear();
		showTable();
	});















});