<?php 	

require_once 'core.php';

$customersId = $_POST['customersId'];

$sql = "SELECT customer_id, first_name, last_name, company, email, phone, address_street, address_number, 
          address_post, address_city FROM customers WHERE customer_id = $customersId";
$result = $connect->query($sql);

if ($result->num_rows > 0) {
 $row = $result->fetch_array();
}

$connect->close();

echo json_encode($row);