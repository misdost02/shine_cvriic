<?php
session_start();

include("../../config/config.php");

if(!empty($_POST)) {
	if(isset($_POST['msme_agri_id'])) {
		$msme_agri_id = $conn->real_escape_string($_POST['msme_agri_id']);
		$company = $conn->real_escape_string(ucwords($_POST['industry_name']));
		$farm_area = $conn->real_escape_string($_POST['farm_area']);
		$years_op = $conn->real_escape_string($_POST['years_orchard']);
		$address = $conn->real_escape_string(ucwords($_POST['orchard_address']));
		$latitude = $conn->real_escape_string($_POST['latitude']);
		$longitude = $conn->real_escape_string($_POST['longitude']);
	
		$check_industry = "SELECT * FROM tbl_cat_msme_agrictulture WHERE company = '$company' AND msme_id = '$msme_agri_id'";
		$qry_industry = $conn->query($check_industry);
		$ctr_industry = $qry_industry->num_rows;

		if($ctr_industry == 0) {
			$str_insert = "INSERT INTO tbl_cat_msme_agrictulture (company, farm_area, years_op, address, latitude, longitude, msme_id) VALUES ('$company','$farm_area', '$years_op', '$address', '$latitude', '$longitude', '$msme_agri_id')";
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
	if(isset($_POST['msme_agri_prod_id'])) {
		$msme_agri_id = $conn->real_escape_string($_POST['msme_agri_prod_id']);
		$cultivars = $conn->real_escape_string($_POST['cultivars']);
		$yield = $conn->real_escape_string($_POST['yield']);
		$prunning = $conn->real_escape_string($_POST['prunning']);
		$seeding = $conn->real_escape_string($_POST['seeding']);
	
		$check_str = "SELECT * FROM tbl_cat_msme_agrictulture_prod WHERE farm_cultivars = '$cultivars' AND msme_agri_id = '$msme_agri_id'";
		$qry_str = $conn->query($check_str);
		$ctr_str = $qry_str->num_rows;

		if($ctr_str == 0) {
			$str_insert = "INSERT INTO tbl_cat_msme_agrictulture_prod (farm_cultivars, farm_yield, farn_pruning, farm_produce_seed, msme_agri_id) VALUES ('$cultivars', '$yield', '$prunning', '$seeding', '$msme_agri_id')";
			$qry_insert = $conn->query($str_insert);
			
			if($qry_insert == true) {

				$check_prod = "SELECT * FROM tbl_industry_agri_products WHERE product_name = '$cultivars'";
				$res = $conn->query($check_prod);
				$ctr = $res->num_rows;

				if($ctr == 0) {
					$prod_insert = "INSERT INTO tbl_industry_agri_products (product_name) VALUES ('$cultivars')";
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

// AGRI PRODUCT NUTRIENT MANAGEMENT

if(!empty($_POST)) {
	if(isset($_POST['msme_agri_nut_id'])) {
		$msme_agri_prod_id = $conn->real_escape_string($_POST['msme_agri_nut_id']);
		$nut_management = $conn->real_escape_string($_POST['nut_management']);
		$timing_application = $conn->real_escape_string($_POST['timing_application']);
		$rate_application = $conn->real_escape_string($_POST['rate_application']);
	
		$check_str = "SELECT * FROM tbl_agri_nut_management WHERE farm_nutrients = '$nut_management' AND msme_agri_prod_id = '$msme_agri_prod_id'";
		$qry_str = $conn->query($check_str);
		$ctr_str = $qry_str->num_rows;

		if($ctr_str == 0) {
			$str_insert = "INSERT INTO tbl_agri_nut_management (farm_nutrients, farm_timing_app, farm_rate_app, msme_agri_prod_id) VALUES ('$nut_management', '$timing_application', '$rate_application', '$msme_agri_prod_id')";
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

// AGRI PRODUCT PEST MANAGEMENT

if(!empty($_POST)) {
	if(isset($_POST['msme_agri_pest_id'])) {
		$agri_nut_id = $conn->real_escape_string($_POST['msme_agri_pest_id']);
		$pest_management = $conn->real_escape_string($_POST['pest_management']);
		$pest_timing_application = $conn->real_escape_string($_POST['pest_timing_application']);
		$pest_rate_application = $conn->real_escape_string($_POST['pest_rate_application']);
		$pest_insect = $conn->real_escape_string($_POST['pest_insect']);
		$pest_growth_stage1 = $conn->real_escape_string($_POST['pest_growth_stage1']);
		$pest_diseases = $conn->real_escape_string($_POST['pest_diseases']);
		$pest_growth_stage2 = $conn->real_escape_string($_POST['pest_growth_stage2']);
		$pest_drainage = $conn->real_escape_string($_POST['pest_drainage']);
		$pest_water = $conn->real_escape_string($_POST['pest_water']);
		$pest_irrigation = $conn->real_escape_string($_POST['pest_irrigation']);
	
		$check_str = "SELECT * FROM tbl_agri_pest_management WHERE farm_pest_disease = '$pest_management' AND agri_nut_id = '$agri_nut_id'";
		$qry_str = $conn->query($check_str);
		$ctr_str = $qry_str->num_rows;

		if($ctr_str == 0) {
			$str_insert = "INSERT INTO tbl_agri_pest_management (farm_pest_disease, farm_pest_timing, farm_rate_app, farm_insect_pest, farm_growth1, farm_diseases, farm_growth2, farm_drainage, farm_water_mgnt, farm_fre_irrig, agri_nut_id) VALUES ('$pest_management', '$pest_timing_application', '$pest_rate_application', '$pest_insect', '$pest_growth_stage1', '$pest_diseases', '$pest_growth_stage2', '$pest_drainage', '$pest_water', '$pest_irrigation', '$agri_nut_id')";
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