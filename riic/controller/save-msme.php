<?php
session_start();

include("../../config/config.php");

if(!empty($_POST)) {
	if(isset($_POST['personnel_id'])) {
		$personnel_id = $conn->real_escape_string($_POST['personnel_id']);
		$industry = $conn->real_escape_string($_POST['industry']);
		$sectors = $conn->real_escape_string($_POST['sectors']);
		$institution_type = $conn->real_escape_string($_POST['institution_type']);
		$company_name = $conn->real_escape_string($_POST['company_name']);
		$years_op = $conn->real_escape_string($_POST['years_op']);
		$address = $conn->real_escape_string($_POST['company_address']);
	
		$check_msme = "SELECT * FROM tbl_cat_msme WHERE msme_company = '$company_name' AND personnel_id = '$personnel_id'";
		$qry_msme = $conn->query($check_msme);
		$ctr_msme = $qry_msme->num_rows;

		if($ctr_msme == 0) {
			$str_insert = "INSERT INTO tbl_cat_msme (industry, sector, type, msme_company, years_op, address, personnel_id) VALUES ('$industry', '$sectors', '$institution_type', '$company_name', '$years_op', '$address', '$personnel_id')";
			$qry_insert = $conn->query($str_insert);
			
			if($qry_insert == true) {
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
	if(isset($_POST['msme_id'])) {
		$msme_id = $conn->real_escape_string($_POST['msme_id']);
		$product_name = $conn->real_escape_string($_POST['product_name']);
		$product_desc = $conn->real_escape_string($_POST['product_desc']);
	
		$check_facility = "SELECT * FROM tbl_cat_msme_products WHERE msme_products = '$product_name' AND msme_id = '$msme_id'";
		$qry_facility = $conn->query($check_facility);
		$ctr_facility = $qry_facility->num_rows;

		if($ctr_facility == 0) {
			$str_insert = "INSERT INTO tbl_cat_msme_products (msme_products, msme_description, msme_id) VALUES ('$product_name', '$product_desc', '$msme_id')";
			$qry_insert = $conn->query($str_insert);
			
			if($qry_insert == true) {

				$check_prod = "SELECT * FROM tbl_msme_products WHERE product_name = '$product_name'";
				$res = $conn->query($check_prod);
				$ctr = $res->num_rows;

				if($ctr == 0) {
					$prod_insert = "INSERT INTO tbl_msme_products (product_name) VALUES ('$product_name')";
					$qry = $conn->query($prod_insert);
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