var manageOrderTable;

$(document).ready(function() {

    $('#navManageOrder').addClass('active');

	var divRequest = $(".div-request").text();

	if(divRequest == 'add')  {

		// create order form function
		$("#createOrderForm").unbind('submit').bind('submit', function() {
			var form = $(this);

			$('.form-group').removeClass('has-error').removeClass('has-success');
			$('.text-danger').remove();
				
			var orderDate = $("#orderDate").val();
			var customerId = $("#customerId").val();
			var paymentType = $("#paymentType").val();

            // form validation
			if(orderDate == "") {
				$("#orderDate").after('<p class="text-danger">Order Date is required</p>');
				$('#orderDate').closest('.form-group').addClass('has-error');
			} else {
				$('#orderDate').closest('.form-group').addClass('has-success');
			}

			if(customerId == "") {
				$("#customerId").after('<p class="text-danger">Client Name is required</p>');
				$('#customerId').closest('.form-group').addClass('has-error');
			} else {
				$('#customerId').closest('.form-group').addClass('has-success');
			}

			if(paymentType == "") {
				$("#paymentType").after('<p class="text-danger">Payment Type is required </p>');
				$('#paymentType').closest('.form-group').addClass('has-error');
			} else {
				$('#paymentType').closest('.form-group').addClass('has-success');
			}


			// array validation
			var productName = document.getElementsByName('productName[]');				
			var validateProduct;

			// insert products into array
			for (var x = 0; x < productName.length; x++) {       			
				var productNameId = productName[x].id;

		    if(productName[x].value == ''){	    		    	
		    	$("#"+productNameId+"").after('<p class="text-danger">Product Name is required</p>');
		    	$("#"+productNameId+"").closest('.form-group').addClass('has-error');	    		    	    	
          } else {
                $("#"+productNameId+"").closest('.form-group').addClass('has-success');
          }
	   	}

	   	// validate product in array
	   	for (var x = 0; x < productName.length; x++) {       						
		    if(productName[x].value){	    		    		    	
		    	validateProduct = true;
	      } else {      	
		    	validateProduct = false;
	      }          
	   	}
	   	
	   	var quantity = document.getElementsByName('quantity[]');		   	
	   	var validateQuantity;
	   	for (var x = 0; x < quantity.length; x++) {       
	 			var quantityId = quantity[x].id;
		    if(quantity[x].value == ''){	    	
		    	$("#"+quantityId+"").after('<p class="text-danger">Qty. is required</p>');
		    	$("#"+quantityId+"").closest('.form-group').addClass('has-error');	    		    		    	
	      } else {      	
		    	$("#"+quantityId+"").closest('.form-group').addClass('has-success');	    		    		    		    	
	      } 
	   	}  // for

	   	for (var x = 0; x < quantity.length; x++) {       						
		    if(quantity[x].value){	    		    		    	
		    	validateQuantity = true;
	      } else {      	
		    	validateQuantity = false;
	      }          
	   	} // for       	

			if (orderDate && customerId && paymentType) {
				if(validateProduct == true && validateQuantity == true) {
					// create order button
					// $("#createOrderBtn").button('loading');

					$.ajax({
						url : form.attr('action'),
						type: form.attr('method'),
						data: form.serialize(),					
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// reset button
							$("#createOrderBtn").button('reset');
							
							$(".text-danger").remove();
							$('.form-group').removeClass('has-error').removeClass('has-success');

							if(response.success == true) {
								
								// create order button
								$(".success-messages").html('<div class="alert alert-success">'+
	            	'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            	'<strong><i class="fas fa-check-circle"></i> </strong> '+ response.messages +
	            	' <br /> <br /> <a type="button" onclick="printOrder('+response.order_id+')" class="btn btn-light"> <i class="fas fa-print"></i> Print </a>'+
	            	'<a type="button" href="orders.php?order=add" class="btn btn-primary" style="margin-left:10px;"> <i class="fas fa-cart-plus"></i> Add New Order </a>'+
	            	
	   		       '</div>');
								
							$("html, body, div.row, div.panel-body").animate({scrollTop: '0px'}, 100);

							// disabled te modal footer button
							$(".submitButtonFooter").addClass('div-hide');
							// remove the product row
							$(".removeProductRowBtn").addClass('div-hide');
								
							} else {
								alert(response.messages);								
							}
						} // /response
					}); // /ajax
				} // if array validate is true
			} // /if field validate is true

			return false;
		}); // /create order form function	
	
	} else if(divRequest == 'manage') {
		// top nav child bar 
		$('#topNavManageOrder').addClass('active');

		manageOrderTable = $("#manageOrderTable").DataTable({
			'ajax': 'controller/fetchOrder.php',
			'order': []
		});		
					
	} else if(divRequest == 'edit') {

		// edit order form function
		$("#editOrderForm").unbind('submit').bind('submit', function() {
			var form = $(this);

			$('.form-group').removeClass('has-error').removeClass('has-success');
			$('.text-danger').remove();

            var orderDate = $("#orderDate").val();
            var customerId = $("#customerId").val();
            var paymentType = $("#paymentType").val();

            // form validation
            if(orderDate == "") {
                $("#orderDate").after('<p class="text-danger">Order Date is required</p>');
                $('#orderDate').closest('.form-group').addClass('has-error');
            } else {
                $('#orderDate').closest('.form-group').addClass('has-success');
            }

            if(customerId == "") {
                $("#customerId").after('<p class="text-danger">Client Name is required</p>');
                $('#customerId').closest('.form-group').addClass('has-error');
            } else {
                $('#customerId').closest('.form-group').addClass('has-success');
            }

            if(paymentType == "") {
                $("#paymentType").after('<p class="text-danger">Payment Type is required </p>');
                $('#paymentType').closest('.form-group').addClass('has-error');
            } else {
                $('#paymentType').closest('.form-group').addClass('has-success');
            }


            // array validation
            var productName = document.getElementsByName('productName[]');
            var validateProduct;

            // insert products into array
            for (var x = 0; x < productName.length; x++) {
                var productNameId = productName[x].id;

                if(productName[x].value == ''){
                    $("#"+productNameId+"").after('<p class="text-danger">Product Name is required</p>');
                    $("#"+productNameId+"").closest('.form-group').addClass('has-error');
                } else {
                    $("#"+productNameId+"").closest('.form-group').addClass('has-success');
                }
            }

            // validate product in array
            for (var x = 0; x < productName.length; x++) {
                if(productName[x].value){
                    validateProduct = true;
                } else {
                    validateProduct = false;
                }
            }

            var quantity = document.getElementsByName('quantity[]');
            var validateQuantity;
            for (var x = 0; x < quantity.length; x++) {
                var quantityId = quantity[x].id;
                if(quantity[x].value == ''){
                    $("#"+quantityId+"").after('<p class="text-danger">Qty. is required</p>');
                    $("#"+quantityId+"").closest('.form-group').addClass('has-error');
                } else {
                    $("#"+quantityId+"").closest('.form-group').addClass('has-success');
                }
            }  // for

            for (var x = 0; x < quantity.length; x++) {
                if(quantity[x].value){
                    validateQuantity = true;
                } else {
                    validateQuantity = false;
                }
            } // for


            if (orderDate && customerId && paymentType) {
                if(validateProduct == true && validateQuantity == true) {
					// create order button
					// $("#createOrderBtn").button('loading');

					$.ajax({
						url : form.attr('action'),
						type: form.attr('method'),
						data: form.serialize(),					
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// reset button
							$("#editOrderBtn").button('reset');
							
							$(".text-danger").remove();
							$('.form-group').removeClass('has-error').removeClass('has-success');

							if(response.success == true) {
								
								// create order button
								$(".success-messages").html('<div class="alert alert-success">'+
	            	'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            	'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +	            		            		            	
	   		       '</div>');
								
							$("html, body, div.panel, div.pane-body").animate({scrollTop: '0px'}, 100);

							// disabled te modal footer button
							$(".editButtonFooter").addClass('div-hide');
							// remove the product row
							$(".removeProductRowBtn").addClass('div-hide');
								
							} else {
								alert(response.messages);								
							}
						} // /response
					}); // /ajax
				} // if array validate is true
			} // /if field validate is true
			

			return false;
		}); // /edit order form function	
	} 	

}); // /documernt


// print order function
function printOrder(orderId = null) {
	if(orderId) {		
			
		$.ajax({
			url: 'controller/printOrder.php',
			type: 'post',
			data: {orderId: orderId},
			dataType: 'text',
			success:function(response) {

            var mywindow = window.open('', 'Sales Management System', 'height=400,width=600');

            mywindow.document.write('<html><head><title>Order Invoice</title>');
            mywindow.document.write('<style>\n' +
                'body {\n' +
                '    font-family: arial, sans-serif;\n' +
                '    width: 98%;\n' +
                '}\n' +
                '\n' +
                '.table td, .table th {\n' +
                '    border: 1px solid #cccccc;\n' +
                '    text-align: center;\n' +
                '    padding: 4px 0;\n' +
                '}\n' +
                '\n' +
                '</style>');
            mywindow.document.write('</head><body>');
            mywindow.document.write(response);
            mywindow.document.write('</body></html>');

            mywindow.document.close(); // necessary for IE >= 10
            mywindow.focus(); // necessary for IE >= 10

            mywindow.print();
            mywindow.close();
				
			}// /success function
		}); // /ajax function to fetch the printable order
	} // /if orderId
} // /print order function

function addRow() {
	$("#addRowBtn").button("loading");

	var tableLength = $("#productTable tbody tr").length;

	var tableRow;
	var arrayNumber;
	var count;

	if(tableLength > 0) {		
		tableRow = $("#productTable tbody tr:last").attr('id');
		arrayNumber = $("#productTable tbody tr:last").attr('class');
		count = tableRow.substring(3);	
		count = Number(count) + 1;
		arrayNumber = Number(arrayNumber) + 1;					
	} else {
		// no table row
		count = 1;
		arrayNumber = 0;
	}

	$.ajax({
		url: 'controller/fetchProductData.php',
		type: 'post',
		dataType: 'json',
		success:function(response) {
			$("#addRowBtn").button("reset");			

			var tr = '<tr id="row'+count+'" class="'+arrayNumber+'">'+			  				
				'<td>'+
					'<div class="form-group">'+
					'<select class="form-control" name="productName[]" id="productName'+count+'" onchange="getProductData('+count+')" >'+
						 '<option value="">- select -</option>';
						// console.log(response);
						$.each(response, function(index, value) {
							tr += '<option value="'+value[0]+'">'+value[1]+'</option>';							
						});
													
					tr += '</select>'+
					'</div>'+
				'</td>'+
				'<td>'+
					'<input type="text" name="price[]" id="price'+count+'" autocomplete="off" disabled="true" class="form-control" />'+
					'<input type="hidden" name="priceValue[]" id="priceValue'+count+'" autocomplete="off" class="form-control" />'+
				'</td>'+
				'<td>'+
					'<div class="form-group">'+
					'<input type="number" name="quantity[]" id="quantity'+count+'" onkeyup="getTotal('+count+')" autocomplete="off" class="form-control" min="1" />'+
					'</div>'+
				'</td>'+
				'<td>'+
					'<input type="text" name="total[]" id="total'+count+'" autocomplete="off" class="form-control" disabled="true" />'+
					'<input type="hidden" name="totalValue[]" id="totalValue'+count+'" autocomplete="off" class="form-control" />'+
				'</td>'+
				'<td>'+
					'<button class="btn btn-outline-primary removeProductRowBtn" type="button" onclick="removeProductRow('+count+')"><i class="fas fa-trash"></i></button>'+
				'</td>'+
			'</tr>';
			if(tableLength > 0) {							
				$("#productTable tbody tr:last").after(tr);
			} else {				
				$("#productTable tbody").append(tr);
			}		

		} // /success
	});	// get the product data

} // /add row

function removeProductRow(row = null) {
	if(row) {
		$("#row"+row).remove();
		subAmount();
	} else {
		alert('error! Refresh the page again');
	}
}

// select on product data
function getProductData(row = null) {
	if(row) {
		var productId = $("#productName"+row).val();		
		
		if(productId == "") {
			$("#price"+row).val("");

			$("#quantity"+row).val("");						
			$("#total"+row).val("");

		} else {
			$.ajax({
				url: 'controller/fetchSelectedProduct.php',
				type: 'post',
				data: {productId : productId},
				dataType: 'json',
				success:function(response) {
					// setting the price value into the price input field
					
					$("#price"+row).val(response.price);
					$("#priceValue"+row).val(response.price);

					$("#quantity"+row).val(1);

					var total = Number(response.price) * 1;
					total = total.toFixed(2);
					$("#total"+row).val(total);
					$("#totalValue"+row).val(total);

					subAmount();
				} // /success
			}); // /ajax function to fetch the product data	
		}
				
	} else {
		alert('no row! please refresh the page');
	}
} // /select on product data

// table total
function getTotal(row = null) {
	if(row) {
		var total = Number($("#price"+row).val()) * Number($("#quantity"+row).val());
		total = total.toFixed(2);
		$("#total"+row).val(total);
		$("#totalValue"+row).val(total);
		
		subAmount();

	} else {
		alert('no row !! please refresh the page');
	}
}

function subAmount() {
	var tableProductLength = $("#productTable tbody tr").length;
	var totalSubAmount = 0;
	for(x = 0; x < tableProductLength; x++) {
		var tr = $("#productTable tbody tr")[x];
		var count = $(tr).attr('id');
		count = count.substring(3);

		totalSubAmount = Number(totalSubAmount) + Number($("#total"+count).val());
	} // /for

	totalSubAmount = totalSubAmount.toFixed(2);

	// sub total
	$("#subTotal").val(totalSubAmount);
	$("#subTotalValue").val(totalSubAmount);

	// vat
	var vat = (Number($("#subTotal").val())/100) * 23;
	vat = vat.toFixed(2);
	$("#vat").val(vat);
	$("#vatValue").val(vat);

	// total amount
	var totalAmount = (Number($("#subTotal").val()) + Number($("#vat").val()));
	totalAmount = totalAmount.toFixed(2);
	$("#totalAmount").val(totalAmount);
	$("#totalAmountValue").val(totalAmount);

} // /sub total amount

function resetOrderForm() {
	// reset the input field
	$("#createOrderForm")[0].reset();
	// remove remove text danger
	$(".text-danger").remove();
	// remove form group error 
	$(".form-group").removeClass('has-success').removeClass('has-error');
} // /reset order form


// remove order from db
function removeOrder(orderId = null) {
	if(orderId) {
		$("#removeOrderBtn").unbind('click').bind('click', function() {
			$("#removeOrderBtn").button('loading');

			$.ajax({
				url: 'controller/removeOrder.php',
				type: 'post',
				data: {orderId : orderId},
				dataType: 'json',
				success:function(response) {
					$("#removeOrderBtn").button('reset');

					if(response.success == true) {

						manageOrderTable.ajax.reload(null, false);
						// hide modal
						$("#removeOrderModal").modal('hide');
						// success messages
						$("#success-messages").html('<div class="alert alert-success">'+
	            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+ response.messages +
	          '</div>');

                // remove the mesages
                $(".alert-success").delay(500).show(10, function() {
                        $(this).delay(3000).hide(10, function() {
                            $(this).remove();
                        });
                    }); // /.alert

                } else {
                    // error messages
                    $(".removeOrderMessages").html('<div class="alert alert-warning">'+
                '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
                '</div>');

						// remove the mesages
	          $(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert	          
					} // /else

				} // /success
			});  // /ajax function to remove the order

		}); // /remove order button clicked
		

	} else {
		alert('error! refresh the page again');
	}
}
