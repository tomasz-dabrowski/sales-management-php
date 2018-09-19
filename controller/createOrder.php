<?php
require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array(), 'order_id' => '');

if ($_POST) {

    $orderDate = date('Y-m-d', strtotime($_POST['orderDate']));
    $customerId = $_POST['customerId'];
    $subTotalValue = $_POST['subTotalValue'];
    $vatValue =	$_POST['vatValue'];
    $totalAmountValue = $_POST['totalAmountValue'];
    $paymentType = $_POST['paymentType'];

	$sql = "INSERT INTO orders (order_date, customer_id, sub_total, vat, total_amount, payment_type, order_status)
            VALUES ('$orderDate', '$customerId', '$subTotalValue', '$vatValue', '$totalAmountValue', $paymentType, 1)";

	$order_id;
	$orderStatus = false;

	if ($connect->query($sql) === true) {
		$order_id = $connect->insert_id;
		$valid['order_id'] = $order_id;	

		$orderStatus = true;
	}

	$orderItemStatus = false;

	for ($x = 0; $x < count($_POST['productName']); $x++) {

		$updateProductQuantitySql = "SELECT product.quantity FROM product WHERE product.product_id = ".$_POST['productName'][$x]."";
		$updateProductQuantityData = $connect->query($updateProductQuantitySql);

		while ($updateProductQuantityResult = $updateProductQuantityData->fetch_row()) {

			$updateQuantity[$x] = $updateProductQuantityResult[0] - $_POST['quantity'][$x];							
				// update product table
				$updateProductTable = "UPDATE product SET quantity = '".$updateQuantity[$x]."' WHERE product_id = ".$_POST['productName'][$x]."";
				$connect->query($updateProductTable);

				// add into order_item
				$orderItemSql = "INSERT INTO order_item (order_id, product_id, quantity, total, order_item_status) 
				VALUES ('$order_id', '".$_POST['productName'][$x]."', '".$_POST['quantity'][$x]."', '".$_POST['totalValue'][$x]."', 1)";

				$connect->query($orderItemSql);		

				if($x == count($_POST['productName'])) {
					$orderItemStatus = true;
				}		
		} // while	
	} // /for quantity

	$valid['success'] = true;
	$valid['messages'] = "Successfully Added";		
	
	$connect->close();

	echo json_encode($valid);
 
}
