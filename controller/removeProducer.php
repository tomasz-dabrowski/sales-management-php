<?php
require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());
$producerId = $_POST['producerId'];

if ($producerId) {

    $sql = "UPDATE producers SET producer_status = 2 WHERE producer_id = {$producerId}";

    if ($connect->query($sql) === true) {
        $valid['success'] = true;
        $valid['messages'] = "Successfully Removed";
    } else {
        $valid['success'] = false;
        $valid['messages'] = "Error while remove producer";
    }

    $connect->close();

    echo json_encode($valid);
}
