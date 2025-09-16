<?php
session_start();

include("../../config/config.php");

if(!empty($_POST)) {
	if(isset($_POST['personnel_id'])) {
		$personnel_id = $conn->real_escape_string($_POST['personnel_id']);
		$industry = $conn->real_escape_string($_POST['industry']);
		$sectors = $conn->real_escape_string($_POST['sectors']);
		$institution_type = $conn->real_escape_string($_POST['institution_type']);
		$rnd_facility = $conn->real_escape_string($_POST['rnd_facility']);
		$years_op = $conn->real_escape_string($_POST['years_op']);
	
		$check_facility = "SELECT * FROM tbl_cat_rnd WHERE rnd_facility_lab = '$rnd_facility' AND personnel_id = '$personnel_id'";
		$qry_facility = $conn->query($check_facility);
		$ctr_facility = $qry_facility->num_rows;

		if($ctr_facility == 0) {
			$str_insert = "INSERT INTO tbl_cat_rnd (industry, sector, institution_type, rnd_facility_lab, years_op, personnel_id) VALUES ('$industry', '$sectors', '$institution_type', '$rnd_facility', '$years_op', '$personnel_id')";
			$qry_insert = $conn->query($str_insert);
			
			if($qry_insert == true) {

				$check_unit = "SELECT * FROM tbl_rnd_facilities WHERE facility_name = '$rnd_facility'";
				$res = $conn->query($check_unit);
				$ctr = $res->num_rows;

				if($ctr == 0) {
					$unit_insert = "INSERT INTO tbl_rnd_facilities (facility_name) VALUES ('$rnd_facility')";
					$qry = $conn->query($unit_insert);
				}

				echo "1";
			} else {
				echo "2";
			}
		} else {
			echo "101";
		}
	}
}


if(!empty($_POST)) {
	if(isset($_POST['lab_id'])) {
		$rnd_id = $conn->real_escape_string($_POST['lab_id']);
		$unit_name = $conn->real_escape_string($_POST['unit_name']);
		$service_name = $conn->real_escape_string($_POST['service_name']);
	
		$check_facility = "SELECT * FROM tbl_cat_rnd_units WHERE facility_unit_name = '$unit_name' AND rnd_id = '$rnd_id'";
		$qry_facility = $conn->query($check_facility);
		$ctr_facility = $qry_facility->num_rows;

		if($ctr_facility == 0) {
			$str_insert = "INSERT INTO tbl_cat_rnd_units(facility_unit_name, facility_service_desc, rnd_id) VALUES ('$unit_name', '$service_name', '$rnd_id')";
			$qry_insert = $conn->query($str_insert);
			
			if($qry_insert == true) {

				$check_unit = "SELECT * FROM tbl_rnd_units WHERE unit_name = '$unit_name'";
				$res = $conn->query($check_unit);
				$ctr = $res->num_rows;

				if($ctr == 0) {
					$unit_insert = "INSERT INTO tbl_rnd_units (unit_name) VALUES ('$unit_name')";
					$qry = $conn->query($unit_insert);
				}
				
				echo "1";
			} else {
				echo "2";
			}
		} else {
			echo "101";
		}
	}
}

// ADD PHOTO
if(isset($_POST["member_image"])) {
	$data = $_POST["member_image"];
	$clientid = $_POST["clientid"];

	$image_array_1 = explode(";", $data);
	$image_array_2 = explode(",", $image_array_1[1]);
	$data = base64_decode($image_array_2[1]);
	$imageName = time().'.png';
	file_put_contents("../../images/personnels/".$imageName, $data);
	// $file_content = addslashes(file_get_contents("../photos/".$imageName, $data));

	$check_photo = "SELECT * FROM tbl_client_photo WHERE personnel_id = '$clientid'";
	$qry_photo = $conn->query($check_photo);
	$count_photo = $qry_photo->num_rows;

	if($count_photo == 0) {
		$insert_photo = "INSERT INTO tbl_client_photo (photo_name, personnel_id) VALUES ('$imageName', '$clientid')";
	} else {
		$insert_photo = "UPDATE tbl_client_photo SET photo_name = '$imageName' WHERE personnel_id = '$clientid'";
	}
	
	$qry = $conn->query($insert_photo);

	if($qry == true) {
		echo 1;
	} else {
		echo 0;
	}
}

?>