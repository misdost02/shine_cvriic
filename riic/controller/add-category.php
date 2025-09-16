
<?php
include("../../config/config.php");

if(isset($_POST['category'])) {
	$category = $conn->real_escape_string($_POST['category']);
	$cat_token = sha1(md5($category));

	$checkstr = "SELECT * FROM tbl_categories WHERE category_name = '$category'";
	$checkqry = $conn->query($checkstr);
	$counter = $checkqry->num_rows;

	if($counter == 0) {
		$str = "INSERT INTO tbl_categories (category_name, category_token) VALUES ('$category', '$cat_token')";
		$qry = $conn->query($str);
		echo "1";
	} else {
		echo "0";
	}
}

?>