<?php
	$catstr = "SELECT * FROM tbl_categories ORDER BY category_name ASC";
	$catqry = $conn->query($catstr);
	$catctr = $catqry->num_rows;

	if($catctr >= 1) {
		while($row = $catqry->fetch_array()) {
			$cat_id = $row['category_id'];
			$cat_name = $row['category_name'];

			echo "<li class='submenu-item'><a class='submenu-link' href='https://www.cvriics.com/riic/databases?token=$cat_id'>$cat_name</a></li>";
		}

	}
?>