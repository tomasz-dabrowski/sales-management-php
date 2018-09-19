<?php
require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());
$categoriesId = $_POST['categoriesId'];

if ($categoriesId) {

    $sql = "UPDATE categories SET categories_status = 2 WHERE categories_id = {$categoriesId}";

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
