<?php 	

require_once 'core.php';

$orderId = $_POST['orderId'];

$sql = "SELECT orders.order_date, orders.customer_id, orders.sub_total, orders.vat, orders.total_amount, orders.payment_type,
        customers.first_name, customers.last_name, customers.company, customers.email, customers.phone, 
        customers.address_street, customers.address_number, customers.address_post, customers.address_city
        FROM orders 
        INNER JOIN customers ON orders.customer_id = customers.customer_id
        WHERE order_id = $orderId";

$orderResult = $connect->query($sql);
$orderData = $orderResult->fetch_array();

$orderDate = $orderData[0];
$customerId = $orderData[1];
$orderSubTotal = $orderData[2];
$orderVat = $orderData[3];
$orderTotalAmount = $orderData[4];
$orderPaymentType = $orderData[5];
$customerFirstName = $orderData[6];
$customerLastName = $orderData[7];
$customerCompany = $orderData[8];
$customerEmail = $orderData[9];
$customerPhone = $orderData[10];
$customerAddressStreet = $orderData[11];
$customerAddressNumber = $orderData[12];
$customerAddressPost = $orderData[13];
$customerAddressCity = $orderData[14];
$invoiceNumber = $orderId . '/' . date('m') . '/' . substr( date('Y'), -2);

if ($orderPaymentType == 1) {
    $paymentType = "Cash";
} else if( $orderPaymentType == 2) {
    $paymentType = "Credit Card";
} else {
    $paymentType = "Online";
}


$orderItemSql = "SELECT order_item.product_id, product.product_name, product.price, order_item.quantity, order_item.total
                 FROM order_item 
                 INNER JOIN product ON order_item.product_id = product.product_id 
                 WHERE order_item.order_id = $orderId";

$orderItemResult = $connect->query($orderItemSql);

$printInvoice = '
<div style="text-align: right;">
    <h3>Order Invoice no. '.$invoiceNumber. '</h3>
    <p>Date of issue: '. date('Y-m-d').'<br>
    Sale date: '. $orderDate .'</p>
    <h4>ORIGINAL / COPY</h4>
    <hr>
</div>

<table style="width:100%; padding: 10px 0; font-size: 13px;">
<tr>
    <td style="width:50%;">
    <strong>Seller:</strong><br>
    John Kowalski, Company Name<br>
    Street 123, 131-42 City Name<br>
    Phone +48 12 123 123<br>
    E-mail: john@kowalski.com
    </td>
    
    <td style="width:50%;">
    <strong>Buyer:</strong><br>
    '.$customerFirstName.' '. $customerLastName .', '. $customerCompany .' <br>
    '.$customerAddressStreet.' '. $customerAddressNumber .', '. $customerAddressPost .' '. $customerAddressCity .'<br>
    Phone '. $customerPhone .'<br>
    E-mail: '. $customerEmail .'
    </td>
</tr>
</table>

<hr>
<br>

<table style="width:100%; font-size: 12px; font-weight: normal; padding: 0;" class="table">
    <tr style="background-color: #eee;">
        <th style="width: 10%">No.</th>
        <th style="width: 20%">Product Name</th>
        <th style="width: 15%">Price</th>
        <th style="width: 10%">Qty.</th>
        <th style="width: 15%">Total</th>
        <th style="width: 15%">Vat 23%</th>
        <th style="width: 15%">Total<br>(incl. Vat)</th>
    </tr>';

    $x = 1;
    while($row = $orderItemResult->fetch_array()) {

        $printInvoice .= '<tr>
            <td>'.$x.'</td>
            <td>'.$row[1].'</td>
            <td>'.$row[2].'</td>
            <td>'.$row[3].'</td>
            <td>'.$row[4].'</td>
            <td>'. round(0.23 * $row[4], 2) . '</td>
            <td>'. round(1.23 * $row[4], 2) . '</td>
        </tr>
        ';
    $x++;
    }

    $printInvoice .= '
    <tr><td style="border: 0;"> </td></tr>
    <tr>
        <th colspan="4" style="border: 0; text-align: right; padding-right: 10px;">Sum: </th>
        <th>'.$orderSubTotal.'</th>
        <th>'.$orderVat.'</th>
        <th>'.$orderTotalAmount.'</th>
    </tr>
    </table>

    <div style="width:100%; font-size: 13px;">
    <p><br /></p>
    <p style="font-size: 13px;">Total (net): '.$orderSubTotal.' pln <br />
    VAT 23%: '.$orderVat.' pln</p>			

    <h3>Total amount: '.$orderTotalAmount.' <br />
    Payment type: '.$paymentType.' <br />
    </h3>	
    
    <table style="width:100%; font-size: 12px; padding-top: 100px;">
    <tr>
        <td style="text-align: center;">
        ........................................................<br /><br />
        Authorized person<br />to issue an invoice	
        </td>
        
        <td  style="text-align: center;">
        ........................................................<br /><br />
        Authorized person<br />for receipt of an invoice	
        </td>
    </tr>
    </table>
     
 ';

$connect->close();
echo $printInvoice;
