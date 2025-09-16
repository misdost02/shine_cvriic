<?php
session_start();
include("../config/config.php");

if(isset($_SESSION['visitorid'])) {
	$visitor_id = $_SESSION['visitorid'];
	$visitor_type = $_SESSION['visitortype'];
} else {
	$visitor_id = session_id();
	$visitor_type = "Unregistered";
}

// HEI RESEARCHERS
if(!empty($_POST)) {
	if(isset($_POST['token_id'])) {
		$token_id = $conn->real_escape_string($_POST['token_id']);

		$audit = "INSERT INTO tbl_audit_trail (userid, user_type, user_activity) VALUES ('$visitor_id', '$visitor_type', 'View HEI Researcer Profile [Token ID: $token_id]')";
		$res = $conn->query($audit);

		$get_profile = "SELECT tbl_client_profiles.*, tbl_client_photo.photo_name, tbl_province.provDesc, tbl_citymun.citymunDesc, tbl_barangay.brgyDesc FROM tbl_client_profiles
			INNER JOIN tbl_province ON tbl_province.provCode = tbl_client_profiles.province
			INNER JOIN tbl_citymun ON tbl_citymun.citymunCode = tbl_client_profiles.town
			INNER JOIN tbl_barangay ON tbl_barangay.brgyCode = tbl_client_profiles.barangay
			LEFT JOIN tbl_client_photo ON tbl_client_photo.personnel_id = tbl_client_profiles.personnel_id
			WHERE tbl_client_profiles.token_id = '$token_id'";
		$exe_profile = $conn->query($get_profile);
		$ctr_profile = $exe_profile->num_rows;

		if($ctr_profile == 1) {
			$row_profile = $exe_profile->fetch_array();  
			echo json_encode($row_profile); 
		}	
	}
}

// FACILITIES
if(!empty($_POST)) {
	if(isset($_POST['rnd_id'])) {
	  
	  $rnd_id = $_POST['rnd_id'];

	  $query = "SELECT * FROM tbl_cat_rnd_units WHERE rnd_id = '$rnd_id'";
	  $result = $conn->query($query);
	  $count_res = $result->num_rows;

	  if ($count_res > 0) {
	    $resulta = array();
	    while ($row = $result->fetch_array()) {
	      $data = ['facility_unit_name' => $row['facility_unit_name'], 'facility_service_desc' => $row['facility_service_desc']];
	      $resulta[] = $data;
	    }

	  }  else {
	      $resulta = array();
	  }
	  echo json_encode($resulta);
	}
}

// MSME
if(!empty($_POST)) {
	if(isset($_POST['msme_id'])) {
	  
	  $msme_id = $_POST['msme_id'];

	  $query = "SELECT * FROM tbl_cat_msme_products WHERE msme_id = '$msme_id'";
	  $result = $conn->query($query);
	  $count_res = $result->num_rows;

	  if ($count_res > 0) {
	    $resulta = array();
	    while ($row = $result->fetch_array()) {
	      $data = ['msme_products' => $row['msme_products'], 'msme_description' => $row['msme_description']];
	      $resulta[] = $data;
	    }

	  }  else {
	      $resulta = array();
	  }
	  echo json_encode($resulta);
	}
}

// INDUSTRIES
if(!empty($_POST)) {
	if(isset($_POST['industry_id'])) {
	  
	  $industry_id = $_POST['industry_id'];

	  $query = "SELECT * FROM tbl_cat_industry_products WHERE industry_id = '$industry_id'";
	  $result = $conn->query($query);
	  $count_res = $result->num_rows;

	  if ($count_res > 0) {
	    $resulta = array();
	    while ($row = $result->fetch_array()) {
	      $data = ['industry_products' => $row['industry_products'], 'industry_description' => $row['industry_description']];
	      $resulta[] = $data;
	    }

	  }  else {
	      $resulta = array();
	  }
	  echo json_encode($resulta);
	}
}



// AGRICULTURAL MSMEs ORCHARD
if(!empty($_POST)) {
	if(isset($_POST['msme_agri_id'])) {
	  
	  $msme_agri_id = $_POST['msme_agri_id'];

	  $query = "SELECT * FROM tbl_cat_msme_agrictulture WHERE msme_id = '$msme_agri_id'";
	  $result = $conn->query($query);
	  $count_res = $result->num_rows;

	  if ($count_res > 0) {
	    $resulta = array();

		foreach ($result as $row) {
			$resulta[] = $row;
		}

	  }  else {
	      $resulta = array();
	  }
	  echo json_encode($resulta);
	}
}


// AGRICULTURAL MSMEs ORCHARD PRODUCT
if(!empty($_POST)) {
	if(isset($_POST['msme_agri_prod_id'])) {
		if(isset($_SESSION['visitorid']) && isset($_SESSION['visitoruname'])) {
			$msme_agri_id = $_POST['msme_agri_prod_id'];

			$query = "SELECT * FROM tbl_cat_msme_agrictulture_prod WHERE msme_agri_id = '$msme_agri_id'";
			$result = $conn->query($query);
			$count_res = $result->num_rows;

			if ($count_res > 0) {
				$resulta = array();

				foreach ($result as $row) {
					$resulta[] = $row;
				}

			}  else {
				$resulta = array();
			}
			echo json_encode($resulta);
		} else {
			echo "404";
		}
	  
	}
}

// AGRICULTURAL MSMEs ORCHARD NUTRIENT
if(!empty($_POST)) {
	if(isset($_POST['msme_agri_nut_id'])) {
	  
	  $msme_agri_nut_id = $_POST['msme_agri_nut_id'];

	  $query = "SELECT * FROM tbl_agri_nut_management WHERE msme_agri_prod_id = '$msme_agri_nut_id'";
	  $result = $conn->query($query);
	  $count_res = $result->num_rows;

	  if ($count_res > 0) {
	    $resulta = array();

		foreach ($result as $row) {
			$resulta[] = $row;
		}

	  }  else {
	      $resulta = array();
	  }
	  echo json_encode($resulta);
	}
}


// AGRICULTURAL MSMEs ORCHARD PEST
if(!empty($_POST)) {
	if(isset($_POST['view_msme_agri_pest'])) {
	  
	  $view_msme_agri_pest = $_POST['view_msme_agri_pest'];

	  $query = "SELECT * FROM tbl_agri_pest_management WHERE agri_nut_id = '$view_msme_agri_pest'";
	  $result = $conn->query($query);
	  $count_res = $result->num_rows;

	  if ($count_res > 0) {
	    $resulta = array();

		foreach ($result as $row) {
			$resulta[] = $row;
		}

	  }  else {
	      $resulta = array();
	  }
	  echo json_encode($resulta);
	}
}
?>