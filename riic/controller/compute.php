<?php

function getRNDFacilities($rnd_id, $conn) {
	$check = "SELECT * FROM tbl_cat_rnd_units WHERE rnd_id = '$rnd_id'";
	$qry = $conn->query($check);
	$count = $qry->num_rows;

	return $count;
}

function getMSMEProducts($sector, $msme_id, $conn) {

	$count;
	
	if($sector == "Agriculture") {
		$check = "SELECT * FROM tbl_cat_msme_agrictulture WHERE msme_id = '$msme_id'";
		$qry = $conn->query($check);
		$count = $qry->num_rows;
	}
	

	return $count;
}

function getAgriMSME($msme_id, $conn) {
	$check = "SELECT * FROM tbl_cat_msme_agrictulture WHERE msme_id = '$msme_id'";
	$qry = $conn->query($check);
	$count = $qry->num_rows;

	return $count;
}

?>