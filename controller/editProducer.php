<?php

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {

    $producerName = $_POST['editProducerName'];
    $producerStatus = $_POST['editProducerStatus'];
    $producerId = $_POST['producerId'];

    $sql = "UPDATE producers SET producer_name = '$producerName', producer_active = '$producerStatus' WHERE producer_id = '$producerId'";

    if($connect->query($sql) === TRUE) {
        $valid['success'] = true;
        $valid['messages'] = "Successfully Updated";
    } else {
        $valid['success'] = false;
        $valid['messages'] = "Error while adding the producer";
    }

    $connect->close();

    echo json_encode($valid);

} // /if $_POST