<?php 	

require_once 'core.php';

$sql = "SELECT categories_id, categories_name, categories_active, categories_status FROM categories WHERE categories_status = 1";
$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $activeCategories = ""; 

 while($row = $result->fetch_array()) {
 	$categoriesId = $row[0];
 	// active 
 	if($row[2] == 1) {
 		// activate member
 		$activeCategories = "<div class='text-success'>Active</div>";
 	} else {
 		// deactivate member
 		$activeCategories = "<div class='text-danger'>Not Active</div>";
 	}

 	$button = '
    <a class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#editCategoriesModal" onclick="editCategories('.$categoriesId.')"> Edit</a>
    <a class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#removeCategoriesModal" onclick="removeCategories('.$categoriesId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a>     
';

 	$output['data'][] = array( 		
 		$row[1], 		
 		$activeCategories,
 		$button 		
 		); 	
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);