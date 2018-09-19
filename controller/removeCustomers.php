<?php
require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());
$customersId = $_POST['customersId'];

if ($customersId) {

    $sql = "DELETE FROM customers WHERE customer_id = {$customersId}";

    if($connect->query($sql) === true) {
        $valid['success'] = true;
        $valid['messages'] = "Successfully Removed";
    } else {
        $valid['success'] = false;
        $valid['messages'] = "Error while remove category";
    }

    $connect->close();

    echo json_encode($valid);
}
