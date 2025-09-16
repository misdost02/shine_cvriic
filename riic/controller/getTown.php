<?php
session_start();
include("../../config/config.php");

if(isset($_POST['depart'])) {
	$departid = $_POST['depart'];   // department id

	$sql = "SELECT * FROM tbl_citymun WHERE provCode = '$departid' ORDER BY citymunDesc ASC";

	$result = $conn->query($sql);

	$users_arr = array();

	while($row = $result->fetch_array()) {
	    $citymunCode = $row['citymunCode'];
	    $citymunDesc = $row['citymunDesc'];

	    $users_arr[] = array("citymunCode" => $citymunCode, "citymunDesc" => $citymunDesc);
	}

	// encoding array to json format
	echo json_encode($users_arr);
}

if(isset($_POST['townid'])) {
	$departid = $_POST['townid'];   // department id

	$sql = "SELECT * FROM tbl_barangay WHERE citymunCode = '$departid' ORDER BY brgyDesc ASC";

	$result = $conn->query($sql);

	$users_arr = array();

	while($row = $result->fetch_array()) {
	    $brgyCode = $row['brgyCode'];
    	$brgyDesc = $row['brgyDesc'];

    	$users_arr[] = array("brgyCode" => $brgyCode, "brgyDesc" => $brgyDesc);
	}

	// encoding array to json format
	echo json_encode($users_arr);
}

if(isset($_POST['schoolid'])) {
	$schoolid = $_POST['schoolid'];   // department id

	$sql = "SELECT * FROM tbl_institutions_campuses WHERE institution_id = '$schoolid' ORDER BY campus_name ASC";

	$result = $conn->query($sql);

	$campus = array();

	while($row = $result->fetch_array()) {
	    $campus_id = $row['campus_id'];
    	$campus_name = $row['campus_name'];

    	$campus[] = array("campus_id" => $campus_id, "campus_name" => $campus_name);
	}

	// encoding array to json format
	echo json_encode($campus);
}

?>