<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if ($_POST) {

    $customersFirstName = $_POST['editCustomersFirstName'];
    $customersLastName = $_POST['editCustomersLastName'];
    $customersCompany = $_POST['editCustomersCompany'];
    $customersEmail = $_POST['editCustomersEmail'];
    $customersPhone = $_POST['editCustomersPhone'];
    $customersAddressStreet = $_POST['editCustomersAddressStreet'];
    $customersAddressNumber = $_POST['editCustomersAddressNumber'];
    $customersAddressPost = $_POST['editCustomersAddressPost'];
    $customersAddressCity = $_POST['editCustomersAddressCity'];
    $customersId = $_POST['editCustomersId'];

	$sql = "UPDATE customers SET first_name = '$customersFirstName', last_name = '$customersLastName', company = '$customersCompany',
            email = '$customersEmail', phone = '$customersPhone', address_street = '$customersAddressStreet', address_number = '$customersAddressNumber',
            address_post = '$customersAddressPost', address_city = '$customersAddressCity' WHERE customer_id = '$customersId'";

	if ($connect->query($sql) === true) {
	 	$valid['success'] = true;
		$valid['messages'] = "Customer Updated";
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while updating customer";
	}
	 
	$connect->close();

	echo json_encode($valid);
}
