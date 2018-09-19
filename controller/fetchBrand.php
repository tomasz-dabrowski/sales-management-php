<?php 	

require_once 'core.php';

$sql = "SELECT producer_id, producer_name, producer_active, producer_status FROM producers WHERE producer_status = 1";
$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $activeBrands = "";

 while($row = $result->fetch_array()) {
 	$brandId = $row[0];
 	// active 
 	if($row[2] == 1) {
 		// activate member
 		$activeBrands = "<span class='label label-success'>Available</span>";
 	} else {
 		// deactivate member
 		$activeBrands = "<span class='label label-danger'>Not Available</span>";
 	}

 	$button = '<!-- Single button -->
	<div class="btn-group" role="group">
	  <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="btnGroupDrop1" >
      Action
    </button> 
	  <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
	    <a class="dropdown-item" data-toggle="modal" data-target="#editBrandModel" onclick="editBrands('.$brandId.')"> Edit</a>
	    <a class="dropdown-item" data-toggle="modal" data-target="#removeMemberModal" onclick="removeBrands('.$brandId.')">Remove</a>     
	  </div>
	</div>';

 	$output['data'][] = array( 		
 		$row[1], 		
 		$activeBrands,
 		$button
 		); 	
 }

}

$connect->close();

echo json_encode($output);