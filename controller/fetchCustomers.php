<?php

require_once 'core.php';

$sql = "SELECT customer_id, first_name, last_name, company, email, phone, address_street, address_number, address_post, address_city FROM customers";
$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) {

    // $row = $result->fetch_array();

    while($row = $result->fetch_array()) {
        $customerId = $row['customer_id'];
        $name = $row['first_name'] . ' ' . $row['last_name'];
            if ($row['company'] !== '') $name .= '<br />' . $row['company'];
        $contact = '<a href="mailto:' . $row['email'] . '">' . $row['email'] . '</a><br />' . $row['phone'];
        $address = $row['address_street'] . ' ' . $row['address_number'] . '<br />' . $row['address_post'] . ' ' . $row['address_city'];
        //$address .= $row['address_post'] . ' ' . $row['address_city'];

        $button = '<span class="align-middle">
                    <a class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#editCustomersModal" onclick="editCustomers('.$customerId.')"> Edit</a>
                    <a class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#removeCustomersModal" onclick="removeCustomers('.$customerId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a>     
                   </span>';
        $output['data'][] = array(
            $name,
            $contact,
            $address,
            $button
        );
    } // /while

}// if num_rows

$connect->close();
echo json_encode($output);
