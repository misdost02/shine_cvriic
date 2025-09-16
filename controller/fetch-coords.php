<?php
header('Content-Type: application/json');
session_start();
include("../config/config.php");

// HEI RESEARCHERS


	$query = "SELECT * FROM tbl_coords";
	$result = $conn->query($query);
	$ctr = $result->num_rows;

	if ($ctr > 0) {
	    $resulta = array();
	    while ($row = $result->fetch_array()) {
	      $data = ['name' => $row['name'], 'lat' => $row['lat'], 'long' => $row['long']];
	      $resulta[] = $data;
	    }

	}  else {
	  $resulta = array();
	}

	echo json_encode($resulta);
?>
