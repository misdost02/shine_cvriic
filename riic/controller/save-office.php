
<?php
include("../../config/config.php");

//adding regional office
if(!empty($_POST)) {
	if(isset($_POST['officeName'])) {
		$officeName = $conn->real_escape_string($_POST['officeName']);
		$officeCode = $conn->real_escape_string($_POST['officeCode']);
		$officeAddress = $conn->real_escape_string($_POST['officeAddress']);
		$officeEmail = $conn->real_escape_string($_POST['officeEmail']);
		$officeContact = $conn->real_escape_string($_POST['officeContact']);
			
		$checkstr = "SELECT * FROM tbl_regional_offices WHERE office_name = '$officeName'";
		$checkqry = $conn->query($checkstr);
		$counter = $checkqry->num_rows;

		if($counter == 0) {
			$str = "INSERT INTO tbl_regional_offices (office_name, office_code, office_address, office_email, office_contact) VALUES ('$officeName', '$officeCode', '$officeAddress', '$officeEmail', '$officeContact')";
			$qry = $conn->query($str);
			echo "1";
		} else {
			echo "0";
		}
	}
}

//adding regional officer
if(!empty($_POST)) {
	if(isset($_POST['officerName'])) {
		$officeID = $conn->real_escape_string($_POST['officeID']);
		$officerName = $conn->real_escape_string($_POST['officerName']);

		$checkstr = "SELECT * FROM tbl_regional_lines WHERE officer_fullname = '$officerName'";
		$checkqry = $conn->query($checkstr);
		$counter = $checkqry->num_rows;

		if($counter == 0) {
			$str = "INSERT INTO tbl_regional_lines (officer_fullname, office_id) VALUES ('$officerName', '$officeID')";
			$qry = $conn->query($str);
			echo "1";
		} else {
			echo "0";
		}
	}
}

?>