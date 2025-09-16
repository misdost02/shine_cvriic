
<?php
include("../../config/config.php");

if(isset($_POST['email_address'])) {
	$full_name = $conn->real_escape_string(ucwords($_POST['full_name']));
	$email_address = $conn->real_escape_string(trim($_POST['email_address']));
	$designation = $conn->real_escape_string(ucwords($_POST['designation']));
	$user_level = $conn->real_escape_string($_POST['user_level']);
	$pass_word = $conn->real_escape_string(trim($_POST['pass_word']));

	$encrypt = password_hash($pass_word, PASSWORD_DEFAULT);
	$codec = generateCode();
    $code = "$pass_word-$codec"; 

	$checkstr = "SELECT * FROM tbl_admin_users WHERE user_email = '$email_address'";
	$checkqry = $conn->query($checkstr);
	$counter = $checkqry->num_rows;

	if($counter == 0) {
		$str = "INSERT INTO tbl_admin_users (full_name, user_email, pass_word, pass_code, designation, level_user) VALUES ('$full_name', '$email_address', '$encrypt', '$code', '$designation', '$user_level')";
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


if(isset($_POST['account_id'])) {
	$account_id = $conn->real_escape_string($_POST['account_id']);
	$pword = $conn->real_escape_string(trim($_POST['pword']));
	$repass_word = $conn->real_escape_string(trim($_POST['repass_word']));

	$encrypt = password_hash($repass_word, PASSWORD_DEFAULT);

	$codec = generateCode();
    $code = "$pword-$codec"; 

	$checkstr = "SELECT * FROM tbl_admin_users WHERE id = '$account_id'";
	$checkqry = $conn->query($checkstr);
	$counter = $checkqry->num_rows;

	if($counter == 1) {
		$str = "UPDATE tbl_admin_users SET pass_word = '$encrypt', pass_code = '$code' WHERE id = '$account_id'";
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

function generateCode() {
	$length = 5;
	$characters = '0123456789abcdefghijklmnopqrs092u3tuvwxyzaskdhfhf9882323ABCDEFGHIJKLMNksadf9044OPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$gencode = '';
	for ($i = 0; $i < $length; $i++) {
		$gencode .= $characters[rand(0, $charactersLength - 1)];
	}
	return $gencode;
}

// ADD PHOTO
if(isset($_POST["member_image"])) {
	$data = $_POST["member_image"];
	$account_id = $_POST["accountid"];

	$image_array_1 = explode(";", $data);
	$image_array_2 = explode(",", $image_array_1[1]);
	$data = base64_decode($image_array_2[1]);
	$imageName = time().'.png';
	file_put_contents("../assets/images/profiles/".$imageName, $data);
	// $file_content = addslashes(file_get_contents("../photos/".$imageName, $data));

	$check_photo = "SELECT * FROM tbl_admin_users WHERE id = '$account_id'";
	$qry_photo = $conn->query($check_photo);
	$count_photo = $qry_photo->num_rows;

	if($count_photo == 0) {
		echo "0";
	} else {
		$insert_photo = "UPDATE tbl_admin_users SET photo = '$imageName' WHERE id = '$account_id'";
		$qry = $conn->query($insert_photo);

		echo "1";
	}
}

?>