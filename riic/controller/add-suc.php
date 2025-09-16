
<?php
include("../../config/config.php");

if(isset($_POST['institution_name'])) {
	$institution_name = $conn->real_escape_string(ucwords($_POST['institution_name']));

	$checkstr = "SELECT * FROM tbl_institutions WHERE institution_name = '$institution_name'";
	$checkqry = $conn->query($checkstr);
	$counter = $checkqry->num_rows;

	if($counter == 0) {
		$str = "INSERT INTO tbl_institutions (institution_name) VALUES ('$institution_name')";
		$qry = $conn->query($str);

		if($qry == true) {
			echo "1";
		} else {
			echo "0";
		}

	} else {
		echo "2";
	}
}

if(isset($_POST['campus_name'])) {
	$suc_id = $conn->real_escape_string($_POST['suc_id']);
	$campus_name = $conn->real_escape_string(ucwords($_POST['campus_name']));

	$checkstr = "SELECT * FROM tbl_institutions_campuses WHERE campus_name = '$campus_name' AND institution_id = '$suc_id'";
	$checkqry = $conn->query($checkstr);
	$counter = $checkqry->num_rows;

	if($counter == 0) {
		$str = "INSERT INTO tbl_institutions_campuses (campus_name, institution_id) VALUES ('$campus_name', '$suc_id')";
		$qry = $conn->query($str);

		if($qry == true) {
			echo "1";
		} else {
			echo "0";
		}

	} else {
		echo "2";
	}
}

?>