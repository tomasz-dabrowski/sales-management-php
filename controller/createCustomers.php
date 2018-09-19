<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {
    $customersFirstName = $_POST['customersFirstName'];
    $customersLastName = $_POST['customersLastName'];
    $customersCompany = $_POST['customersCompany'];
    $customersEmail = $_POST['customersEmail'];
    $customersPhone = $_POST['customersPhone'];
    $customersAddressStreet = $_POST['customersAddressStreet'];
    $customersAddressNumber = $_POST['customersAddressNumber'];
    $customersAddressPost = $_POST['customersAddressPost'];
    $customersAddressCity = $_POST['customersAddressCity'];


	$sql = "INSERT INTO customers (first_name, last_name, company, email, phone, 
                      address_street, address_number, address_post, address_city) 
	        VALUES ('$customersFirstName', '$customersLastName', '$customersCompany', '$customersEmail', '$customersPhone',
	                '$customersAddressStreet','$customersAddressNumber','$customersAddressPost','$customersAddressCity')";

	if($connect->query($sql) === true) {
	    $valid['success'] = true;
		$valid['messages'] = "Customer Successfully Added";
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding customer";
	}

	$connect->close();

	echo json_encode($valid);
}
