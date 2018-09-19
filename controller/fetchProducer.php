<?php

require_once 'core.php';

$sql = "SELECT producer_id, producer_name, producer_active, producer_status FROM producers WHERE producer_status = 1";
$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) {

    // $row = $result->fetch_array();
    $activeProducers = "";

    while($row = $result->fetch_array()) {
        $producerId = $row[0];
        // active
        if($row[2] == 1) {
            // activate member
            $activeProducers = "<div class='text-success'>Active</div>";
        } else {
            // deactivate member
            $activeProducers = "<div class='text-danger'>Not Active</div>";
        }

        $button = '<!-- Single button -->
	    <a class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#editProducerModal" onclick="editProducers('.$producerId.')"> Edit</a>
	    <a class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#removeProducerModal" onclick="removeProducers('.$producerId.')">Remove</a>     
';

        $output['data'][] = array(
            $row[1],
            $activeProducers,
            $button
        );
    }

}

$connect->close();

echo json_encode($output);