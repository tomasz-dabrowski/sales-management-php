<?php 	

require_once 'core.php';

$producerId = $_POST['producerId'];

$sql = "SELECT producer_id, producer_name, producer_active, producer_status FROM producers WHERE producer_id = $producerId";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);