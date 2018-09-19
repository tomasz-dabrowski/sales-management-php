<?php 	

require_once 'core.php';

$sql = "SELECT orders.order_id, orders.order_date, orders.customer_id, 
customers.first_name, customers.last_name, customers.company, orders.payment_type 
FROM orders 
INNER JOIN customers ON orders.customer_id = customers.customer_id
WHERE order_status = 1";
$result = $connect->query($sql);

$output = array('data' => array());

if ($result->num_rows > 0) {
 
    $paymentType = "";
    $x = 1;

    while($row = $result->fetch_array()) {
        $orderId = $row[0];
        $orderDate = $row[1];
        $customerName = $row[3] . ' ' . $row[4];

        $countOrderProductsSql = "SELECT count(quantity) FROM order_item WHERE order_id = $orderId";
        $countOrderProductsResult = $connect->query($countOrderProductsSql);
        $countOrderProductsRow = $countOrderProductsResult->fetch_row();

        $countOrderItemSql = "SELECT SUM(quantity) FROM order_item WHERE order_id = $orderId";
        $countOrderItemResult = $connect->query($countOrderItemSql);
        $countOrderItemRow = $countOrderItemResult->fetch_row();

        $orderItemSumSql = "SELECT total_amount FROM orders WHERE order_id = $orderId";
        $sumResult = $connect->query($orderItemSumSql);
        $sumResultRow = $sumResult->fetch_row();

        // active
        if($row[6] == 1) {
            $paymentType = "<label class='label label-success'>Cash</label>";
        } else if($row[6] == 2) {
            $paymentType = "<label class='label label-info'>Card</label>";
        } else {
            $paymentType = "<label class='label label-warning'>Online</label>";
        } // /else

        $buttons = '
        <a class="btn btn-outline-secondary btn-sm" href="orders.php?order=edit&id='.$orderId.'" id="editOrderModalBtn"> Edit</a>
        <a class="btn btn-outline-warning btn-sm" onclick="printOrder('.$orderId.')"> <i class="glyphicon glyphicon-print"></i> Print </a>
        <a class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#removeOrderModal" id="removeOrderModalBtn" onclick="removeOrder('.$orderId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a>
        <!-- <a class="btn btn-outline-secondary btn-sm" data-toggle="modal" id="paymentOrderModalBtn" data-target="#paymentOrderModal" onclick="paymentOrder('.$orderId.')"> <i class="glyphicon glyphicon-save"></i> Payment</a></li>
        -->
        ';

        $output['data'][] = array(
            $x,
            $orderId,
            $orderDate,
            $customerName,
            $countOrderProductsRow,
            $countOrderItemRow,
            $sumResultRow,
            $paymentType,
            $buttons
            );
        $x++;
    } // /while
}// if num_rows

$connect->close();

echo json_encode($output);
