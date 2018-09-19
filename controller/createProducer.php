<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {

    $producerName = $_POST['producerName'];
    $producerStatus = $_POST['producerStatus'];

	$sql = "INSERT INTO producers (producer_name, producer_active, producer_status) VALUES ('$producerName', '$producerStatus', 1)";

	if($connect->query($sql) === true) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Added";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the producer";
	}

	$connect->close();

    //header('Location: ../producer.php');
	echo json_encode($valid);
 
} // /if $_POST