<?php
session_start();

include("../../config/config.php");

if(!empty($_POST)) {
	if(isset($_POST['partner_name']) && isset($_POST['partner_website'])) {
		$partner_name = $conn->real_escape_string(ucwords($_POST['partner_name']));
		$partner_website = $conn->real_escape_string($_POST['partner_website']);
		$partner_contact = $conn->real_escape_string($_POST['partner_contact']);
		
		$check_daa= "SELECT * FROM tbl_core_partners WHERE partner_name = '$partner_name'";
		$qry_data = $conn->query($check_daa);
		$ctr_data = $qry_data->num_rows;

		if($ctr_data == 0) {
			$str_insert = "INSERT INTO tbl_core_partners (partner_name, partner_website, partner_contact) VALUES ('$partner_name', '$partner_website', '$partner_contact')";
			$qry_insert = $conn->query($str_insert);
			
			if($qry_insert == true) {
				echo "1";
			} else {
				echo "2";
			}
			
		} else {
			echo "0";
		}
	}
}


// ADD PHOTO ARTICLE
if(isset($_POST["partner_id"])) {
	$data = $_POST["partner_image"];
	$partner_id = $_POST["partner_id"];

	$image_array_1 = explode(";", $data);
	$image_array_2 = explode(",", $image_array_1[1]);
	$data = base64_decode($image_array_2[1]);
	$imageName = time().'.png';
	file_put_contents("../../images/core-partners/".$imageName, $data);
	// $file_content = addslashes(file_get_contents("../photos/".$imageName, $data));

	$check_photo = "SELECT * FROM tbl_core_partners WHERE partner_id = '$partner_id'";
	$qry_photo = $conn->query($check_photo);
	$count_photo = $qry_photo->num_rows;

	if($count_photo == 1) {
		$insert_photo = "UPDATE tbl_core_partners SET partner_logo = '$imageName' WHERE partner_id = '$partner_id'";
	}
	
	$qry = $conn->query($insert_photo);

	if($qry == true) {
		echo 1;
	} else {
		echo 0;
	}
}

?>