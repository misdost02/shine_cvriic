<?php

	function getCategoryID($cat_token, $conn) {
		$get_str = "SELECT * FROM tbl_categories WHERE category_token = '$cat_token'";
		$qry = $conn->query($get_str);
		$cnt = $qry->num_rows;

		if($cnt == 1) {
			foreach ($qry as $var => $value) {
			  return $value['category_id'];
			}
		}
	}

	function getCategoryName($cat_token, $conn) {
		$get_str = "SELECT * FROM tbl_categories WHERE category_token = '$cat_token'";
		$qry = $conn->query($get_str);
		$cnt = $qry->num_rows;

		if($cnt == 1) {
			foreach ($qry as $var => $value) {
			  return $value['category_name'];
			}
		}
	}

	function getCategoryDesc($cat_token, $conn) {
		$get_str = "SELECT * FROM tbl_categories WHERE category_token = '$cat_token'";
		$qry = $conn->query($get_str);
		$cnt = $qry->num_rows;

		if($cnt == 1) {
			foreach ($qry as $var => $value) {
			  return $value['category_desc'];
			}
		}
	}


?>