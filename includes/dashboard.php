<?php

// number of orders
$orderSql = "SELECT * FROM orders WHERE order_status = 1";
$orderQuery = $connect->query($orderSql);
$countOrder = $orderQuery->num_rows;

// sum of total sales
$totalSales = 0;
$totalSalesBrutto = 0;
while ($orderResult = $orderQuery->fetch_assoc()) {
    $totalSales += (float)$orderResult['sub_total'];
    $totalSalesBrutto += (float)$orderResult['total_amount'];
}
$totalSales = number_format($totalSales, 2, ',', ' ');
$totalSalesBrutto = number_format($totalSalesBrutto, 2, ',', ' ');

// number of active products
$sql = "SELECT * FROM product WHERE status = 1";
$query = $connect->query($sql);
$countProduct = $query->num_rows;

// number of categories
$sql = "SELECT * FROM categories WHERE categories_status = 1";
$query = $connect->query($sql);
$countCategories = $query->num_rows;

// sales chart in dashboard
$sql = "SELECT MAX(total_amount) AS maxOrder FROM orders";
$query = $connect->query($sql);
$row = mysqli_fetch_assoc($query);
$maxOrder = $row['maxOrder'];
$maxScale = round($maxOrder, -3) +1000;

$sql = "SELECT order_date, total_amount FROM orders";
$result = $connect->query($sql);

$labels = "";
$data = "";

if($result->num_rows > 0) {
    while($row = $result->fetch_array()) {
        $labels = $labels . ', "' . $row[0] . '"';
        $data = $data . ', ' . $row[1];
    }
}
$labels = ltrim($labels, ',');
$data = ltrim($data, ',');

$connect->close();
