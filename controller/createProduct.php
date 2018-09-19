<?php
require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if ($_POST) {
    $productName = $_POST['productName'];
    // $productImage = $_POST['productImage'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $producerName = $_POST['producerName'];
    $categoryName = $_POST['categoryName'];
    $productStatus = $_POST['productStatus'];

	$type = explode('.', $_FILES['productImage']['name']);
	$type = $type[count($type)-1];		
	$url = '../scripts/images/stock/'.uniqid(rand()).'.'.$type;
	if(in_array($type, array('gif', 'jpg', 'jpeg', 'png', 'JPG', 'GIF', 'JPEG', 'PNG'))) {
		if(is_uploaded_file($_FILES['productImage']['tmp_name'])) {			
			if(move_uploaded_file($_FILES['productImage']['tmp_name'], $url)) {
				
				$sql = "INSERT INTO product (product_name, product_image, producer_id, categories_id, quantity, price, active, status) 
				VALUES ('$productName', '$url', '$producerName', '$categoryName', '$quantity', '$price', '$productStatus', 1)";

				if($connect->query($sql) === true) {
					$valid['success'] = true;
					$valid['messages'] = "Product Successfully Added";
				} else {
					$valid['success'] = false;
					$valid['messages'] = "Error while adding product";
				}

			} else {
				return false;
			}	// /else	
		} // if
	} // if in_array

    $connect->close();

	echo json_encode($valid);
}
