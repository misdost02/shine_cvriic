<?php
session_start();
include("../config/config.php");

// REGISTER ACCOUNT
if(!empty($_POST)) {
	if(isset($_POST['register_username'])) {
		$register_username = $conn->real_escape_string(trim($_POST['register_username']));
		$register_fname = $conn->real_escape_string(ucwords($_POST['register_fname']));
		$register_lname = $conn->real_escape_string(ucwords($_POST['register_lname']));
		$register_password = $conn->real_escape_string(trim($_POST['register_password']));
		$register_type = $conn->real_escape_string($_POST['register_type']);

		$encrypt = password_hash($register_password, PASSWORD_DEFAULT);

		$get_profile = "SELECT * FROM tbl_visitor_accounts
			WHERE visitor_username = '$register_username'";
		$exe_profile = $conn->query($get_profile);
		$ctr_profile = $exe_profile->num_rows;

		if($ctr_profile == 1) {
			echo "1";
		} else {
			$insert = "INSERT INTO tbl_visitor_accounts (visitor_fname, visitor_lname, visitor_username, visitor_password, visitor_type, visitor_status) VALUES ('$register_fname','$register_lname','$register_username','$encrypt','$register_type','1')";
			$exe = $conn->query($insert);

			if($exe == true) {
				$audit = "INSERT INTO tbl_audit_trail (userid, user_type, user_activity) VALUES ('$register_username', '$register_type', 'Created user account')";
				$res = $conn->query($audit);

				echo "200";
			} else {
				echo "0";
			}
		}
	}
}

// LOGIN ACCOUNT
if(!empty($_POST)) {
	if(isset($_POST['login_username'])) {
		$login_username = $conn->real_escape_string(trim($_POST['login_username']));
		$login_password = $conn->real_escape_string(trim($_POST['login_password']));

		$get_profile = "SELECT * FROM tbl_visitor_accounts
			WHERE visitor_username = '$login_username' AND visitor_status = '1'";
		$exe_profile = $conn->query($get_profile);
		$ctr_profile = $exe_profile->num_rows;

		if($ctr_profile == 1) {
			while($row = $exe_profile->fetch_array()) {
				$visitor_id = $row['id'];
				$visitor_password = $row['visitor_password'];
				$visitor_fname = $row['visitor_fname'];
				$visitor_type = $row['visitor_type'];
				$visitor_username = $row['visitor_username'];
			}

			if(password_verify($login_password, $visitor_password)) {
				$_SESSION['visitorid'] = $visitor_id;
				$_SESSION['visitoruname'] = $visitor_username;
				$_SESSION['visitorfname'] = $visitor_fname;
				$_SESSION['visitortype'] = $visitor_type;

				$audit = "INSERT INTO tbl_audit_trail (userid, user_type, user_activity) VALUES ('$visitor_id', '$visitor_type', 'Login to account')";
				$res = $conn->query($audit);

				echo "200";
			} else {
				echo "0";
			}
		} else {
			echo "0";
		}
	}
}

// LOGOUT ACCOUNT
if(!empty($_POST)) {
	if(isset($_POST['visitorid'])) {

		$visitor_id = $_SESSION['visitorid'];
		$visitor_type = $_SESSION['visitortype'];

		$audit = "INSERT INTO tbl_audit_trail (userid, user_type, user_activity) VALUES ('$visitor_id', '$visitor_type', 'Logout account')";
		$res = $conn->query($audit);

		unset($_SESSION['visitorid']);
		unset($_SESSION['visitoruname']);
		unset($_SESSION['visitorfname']);

		session_destroy();
		
		echo "200";
	}
}

?>