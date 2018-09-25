<?php 

require_once 'core.php';

if ($_POST) {
    $startDate = date('Y-m-d', strtotime($_POST['startDate']));
    $endDate = date('Y-m-d', strtotime($_POST['endDate']));

	$sql = "SELECT orders.order_date, orders.sub_total, orders.vat, orders.total_amount ,orders.payment_type, 
            customers.first_name, customers.last_name, customers.company, customers.phone, customers.email
            FROM orders 
            INNER JOIN customers ON orders.customer_id = customers.customer_id
            WHERE orders.order_date >= '$startDate' AND orders.order_date <= '$endDate' AND order_status = 1 
            ORDER BY order_date";
	$query = $connect->query($sql);

	$table = '
    <div style="text-align: center;">
        <h2>Orders Report</h2>
        <h4>from '. $startDate .' to '. $endDate .'</h4>
    </div>

	<table style="width:100%; font-size: 12px; font-weight: normal; padding: 0;" class="table">
		<tr style="background-color: #eee;">
			<th>Date</th>
			<th>Customer / Company</th>
			<th>Phone / Email</th>
			<th>Payment</th>
			<th>Total net</th>
			<th>Vat 23%</th>
			<th>Total</th>
		</tr>

		<tr>';
		while ($result = $query->fetch_assoc()) {
            if ($result['payment_type'] == 1) {
                $paymentType = "Cash";
            } else if( $result['payment_type'] == 2) {
                $paymentType = "Credit Card";
            } else {
                $paymentType = "Online";
            }

            $sumSubTotal = 0;
            $sumVat = 0;
            $sumTotalAmount = 0;

			$table .= '<tr>
				<td>'.$result['order_date'].'</td>
				<td>'.$result['first_name'].' '.$result['last_name'].', '.$result['company'].'</td>
				<td>'.$result['phone'].', '.$result['email'].'</td>
				<td>'.$paymentType.'</td>
				<td>'.$result['sub_total'].'</td>
				<td>'.$result['vat'].'</td>
				<td>'.$result['total_amount'].'</td>
			</tr>';
			$sumSubTotal += (float)$result['sub_total'];
			$sumVat += (float)$result['vat'];
			$sumTotalAmount += (float)$result['total_amount'];
		}
		$table .= '
		</tr>
		<tr><td style="border: 0;"> </td></tr>
        <tr>
            <th colspan="4" style="border: 0; text-align: right; padding-right: 10px;">Sum: </th>
            <th>'.$sumSubTotal.'</th>
            <th>'.$sumVat.'</th>
            <th>'.$sumTotalAmount.'</th>
        </tr>
	</table>
	';	

	echo $table;
}
