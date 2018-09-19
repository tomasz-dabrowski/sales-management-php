<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if ($_POST) {
    $productName = $_POST['editProductName'];
    $producerName = $_POST['editProducerName'];
    $categoryName = $_POST['editCategoryName'];
    $quantity = $_POST['editQuantity'];
    $price = $_POST['editPrice'];
    $productStatus = $_POST['editProductStatus'];
    $productId = $_POST['productId'];

				
	$sql = "UPDATE product SET product_name = '$productName', 
producer_id = '$producerName', 
categories_id = '$categoryName', 
quantity = '$quantity', 
price = '$price', 
active = '$productStatus', 
status = 1 
WHERE product_id = $productId ";

	if($connect->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Update";	
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while updating product info";
	}

} // /$_POST
	 
$connect->close();

echo json_encode($valid);
 
