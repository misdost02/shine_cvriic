<?php
	$provstr = "SELECT * FROM tbl_province ORDER BY provDesc ASC";
	$provqry = $conn->query($provstr);
	$provctr = $provqry->num_rows;

	if($provctr >= 1) {
		$prov = array();
		while($row = $provqry->fetch_array()) {
			$prov[] = $row;
		}
	}
?>