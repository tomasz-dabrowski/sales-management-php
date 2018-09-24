<?php 

require_once 'core.php';

if ($_POST) {
    $startDate = date('Y-m-d', strtotime($_POST['startDate']));
    $endDate = date('Y-m-d', strtotime($_POST['endDate']));

	$sql = "SELECT * FROM orders WHERE order_date >= '$startDate' AND order_date <= '$endDate' and order_status = 1 ORDER BY order_date";
	$query = $connect->query($sql);

	$table = '
	<table border="1" cellspacing="0" cellpadding="0" style="width:100%;">
		<tr>
			<th>Order Date</th>
			<th>Client Name</th>
			<th>Contact</th>
			<th>Grand Total</th>
		</tr>

		<tr>';
		$totalAmount = 0;
		while ($result = $query->fetch_assoc()) {
			$table .= '<tr>
				<td>'.$result['order_date'].'</td>
				<td>'.$result['customer_id'].'</td>
				<td>'.$result['sub_total'].'</td>
				<td>'.$result['total_amount'].'</td>
			</tr>';	
			$totalAmount += (float)$result['total_amount'];
		}
		$table .= '
		</tr>

		<tr>
			<td colspan="3">Total Amount</td>
			<td>'.$totalAmount.'</td>
		</tr>
	</table>
	';	

	echo $table;
}
