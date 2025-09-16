<?php
include("../../config/config.php");

if(isset($_POST['signupEmail']) && isset($_POST['signupFullname'])) {
	$signupFullname= $conn->real_escape_string(ucfirst($_POST['signupFullname']));
	$signupEmail = $conn->real_escape_string(trim($_POST['signupEmail']));
	$signupPassword = $conn->real_escape_string(trim($_POST['signupPassword']));
	$signupRepassword = $conn->real_escape_string(trim($_POST['signupRepassword']));

	$encryptPassword = password_hash($signupPassword, PASSWORD_DEFAULT);
	
	$checkstr = "SELECT * FROM tbl_admin_users WHERE user_email = '$signupEmail'";
	$checkqry = $conn->query($checkstr);
	$counter = $checkqry->num_rows;

	if($counter == 0) {
		$str = "INSERT INTO tbl_admin_users (full_name, user_email, pass_word, designation, level_user) VALUES ('$signupFullname', '$signupEmail', '$encryptPassword', 'Super Admin', '1')";
		$qry = $conn->query($str);
		echo "0";
	} else {
		echo "1";
	}
}

?>