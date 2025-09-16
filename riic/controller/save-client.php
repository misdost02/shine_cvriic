<?php
session_start();
$adminid = $_SESSION['adminid'];
include("../../config/config.php");

if(!empty($_POST)) {
	if(isset($_POST['firstname']) && isset($_POST['lastname'])) {
		$firstname = $conn->real_escape_string(strtoupper($_POST['firstname']));
		$middlename = $conn->real_escape_string(strtoupper($_POST['middlename']));
		$lastname = $conn->real_escape_string(strtoupper($_POST['lastname']));
		$designation = $conn->real_escape_string($_POST['designation']);
		$division_unit = $conn->real_escape_string($_POST['division_unit']);
		$province = $conn->real_escape_string($_POST['province']);
		$town = $conn->real_escape_string($_POST['town']);
		$barangay = $conn->real_escape_string($_POST['barangay']);
		$landline = $conn->real_escape_string($_POST['landline']);
		$mobile = $conn->real_escape_string($_POST['mobile']);
		$email = $conn->real_escape_string($_POST['email']);
		$website = $conn->real_escape_string($_POST['website']);
		$clientid = $conn->real_escape_string($_POST['profile_clientid']);

		$token_id = sha1(md5(strtotime(date('m-d-y h:i:s'))));
		
		if($clientid == "") {
			$check_client = "SELECT * FROM tbl_client_profiles WHERE (firstname = '$firstname' AND lastname = '$lastname') OR (email = '$email')";
			$qry_client = $conn->query($check_client);
			$ctr_client = $qry_client->num_rows;

			if($ctr_client == 0) {
				$str_insert = "INSERT INTO tbl_client_profiles (firstname, middlename, lastname, designation, division_unit, province, town, barangay, landline, mobile, email, website, added_by, token_id, status_id) VALUES ('$firstname', '$middlename', '$lastname', '$designation', '$division_unit', '$province', '$town', '$barangay', '$landline', '$mobile', '$email', '$website', '$adminid', '$token_id', '1')";
				$qry_insert = $conn->query($str_insert);
				
				if($qry_insert == true) {
					echo "1";
				} else {
					echo "2";
				}
				
			} else {
				echo "0";
			}
		} else {
			$str_insert = "UPDATE tbl_client_profiles SET firstname = '$firstname', middlename = '$middlename', lastname = '$lastname', designation = '$designation', division_unit = '$division_unit', province = '$province', town = '$town', barangay = '$barangay', landline = '$landline', mobile = '$mobile', email = '$email', website = '$website', added_by = '$adminid' WHERE personnel_id = '$clientid'";
			$qry_insert = $conn->query($str_insert);
			
			if($qry_insert == true) {
				echo "101";
			} else {
				echo "2";
			}
		}
	}
}

if(!empty($_POST)) {
	if(isset($_POST['personnel_id'])) {
		$personnel_id = $conn->real_escape_string($_POST['personnel_id']);
		
		$industry = $conn->real_escape_string($_POST['industry']);
		$sectors = $conn->real_escape_string($_POST['sectors']);
		$institution_type = $conn->real_escape_string($_POST['institution_type']);
		$institution = $conn->real_escape_string($_POST['institution']);
		$campus = $conn->real_escape_string($_POST['campus']);
		$years_op = $conn->real_escape_string($_POST['years_op']);
		$expertise = $conn->real_escape_string($_POST['expertise']);
		$rd_engagement = $conn->real_escape_string($_POST['rd_engagement']);
	
		$check_client = "SELECT * FROM tbl_cat_hei WHERE personnel_id = '$personnel_id'";
		$qry_client = $conn->query($check_client);
		$ctr_client = $qry_client->num_rows;

		if($ctr_client == 0) {
			$str_insert = "INSERT INTO tbl_cat_hei (industry, sector, institution_type, institution_id, campus_id, years_op, expertise, rd_engagement, personnel_id) VALUES ('$industry', '$sectors', '$institution_type', '$institution', '$campus', '$years_op', '$expertise', '$rd_engagement', '$personnel_id')";
			$qry_insert = $conn->query($str_insert);
			
			if($qry_insert == true) {

				$check_expert = "SELECT * FROM tbl_hei_expertise WHERE hei_expertise = '$expertise'";
				$res = $conn->query($check_expert);
				$ctr = $res->num_rows;

				if($ctr == 0) {
					$expert_insert = "INSERT INTO tbl_hei_expertise (hei_expertise) VALUES ('$expertise')";
					$qry = $conn->query($expert_insert);
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

// ADD PHOTO ARTICLE
if(isset($_POST["news_image"])) {
	$data = $_POST["news_image"];
	$news_id = $_POST["news_id"];

	$image_array_1 = explode(";", $data);
	$image_array_2 = explode(",", $image_array_1[1]);
	$data = base64_decode($image_array_2[1]);
	$imageName = time().'.png';
	file_put_contents("../../images/news-photo/".$imageName, $data);
	// $file_content = addslashes(file_get_contents("../photos/".$imageName, $data));

	$check_photo = "SELECT * FROM tbl_news_articles WHERE news_id = '$news_id'";
	$qry_photo = $conn->query($check_photo);
	$count_photo = $qry_photo->num_rows;

	if($count_photo == 1) {
		$insert_photo = "UPDATE tbl_news_articles SET news_photo = '$imageName' WHERE news_id = '$news_id'";
	}
	
	$qry = $conn->query($insert_photo);

	if($qry == true) {
		echo 1;
	} else {
		echo 0;
	}
}


// FETCH CLIENT PROFILE

if(!empty($_POST)) {
	if(isset($_POST['clientid'])) {
		$clientid = $conn->real_escape_string($_POST['clientid']);

		$get_profile = "SELECT tbl_client_profiles.*, tbl_province.provCode, tbl_citymun.citymunCode, tbl_barangay.brgyCode, tbl_province.provDesc, tbl_citymun.citymunDesc, tbl_barangay.brgyDesc FROM tbl_client_profiles
			INNER JOIN tbl_province ON tbl_province.provCode = tbl_client_profiles.province
			INNER JOIN tbl_citymun ON tbl_citymun.citymunCode = tbl_client_profiles.town
			INNER JOIN tbl_barangay ON tbl_barangay.brgyCode = tbl_client_profiles.barangay
			WHERE tbl_client_profiles.personnel_id = '$clientid'";
		$exe_profile = $conn->query($get_profile);
		$ctr_profile = $exe_profile->num_rows;

		if($ctr_profile == 1) {
			$row_profile = $exe_profile->fetch_array();  
			echo json_encode($row_profile); 
		} else {
			echo 0;
		}
	}
}

// DELETE CLIENT PROFILE

if(!empty($_POST)) {
	if(isset($_POST['delete_clientid'])) {
		$clientid = $conn->real_escape_string($_POST['delete_clientid']);

		$get_profile = "UPDATE tbl_client_profiles SET status_id = 0 WHERE personnel_id = '$clientid'";
		$exe_profile = $conn->query($get_profile);

		if($exe_profile == true) {
			echo 1; 
		} else {
			echo 0;
		}
	}
}


?>


