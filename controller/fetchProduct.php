<?php
require_once 'core.php';

$sql = "SELECT product.product_id, product.product_name, product.product_image, product.producer_id,
 		product.categories_id, product.quantity, product.price, product.active, product.status, 
 		producers.producer_name, categories.categories_name FROM product 
		INNER JOIN producers ON product.producer_id = producers.producer_id 
		INNER JOIN categories ON product.categories_id = categories.categories_id  
		WHERE product.status = 1";

$result = $connect->query($sql);
$output = array('data' => array());

if ($result->num_rows > 0) {
    $active = "";

    while ($row = $result->fetch_array()) {
    $productId = $row[0];

    if ($row[7] == 1) {
        // activate member
        $active = "<label class='text-success'>Active</label>";
    } else {
        // deactivate member
        $active = "<label class='text-danger'>Not Active</label>";
    }

 	$button = '
        <a class="btn btn-outline-secondary btn-sm" data-toggle="modal" id="#editProductModalBtn" data-target="#editProductModal" onclick="editProduct('.$productId.')"> Edit</a>
        <a class="btn btn-outline-danger btn-sm" data-toggle="modal" id="#removeProductModalBtn" data-target="#removeProductModal" onclick="removeProduct('.$productId.')"> Remove</a>     
';
    $productName = $row[1];
    $image = $row[2];
    $quantity = $row[5];
    $price = $row[6];
    $producer = $row[9];
    $category = $row[10];
    $imageUrl = substr($image, 3);
    $productImage = "<a href='".$imageUrl."' data-lightbox='".$productName."' data-title='".$productName."'>
        <img class='img-round' src='".$imageUrl."' title='".$productName."' style='height:25px; width:40px;' /></a>";

    $output['data'][] = array(
        $productImage,
        $productName,
        $price,
        $quantity,
        $producer,
        $category,
        $active,
        $button
        );
    }
}

$connect->close();

echo json_encode($output);
