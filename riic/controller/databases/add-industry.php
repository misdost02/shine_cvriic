
<?php
include("../../../config/config.php");

//adding regional office
if(isset($_POST['industryCategory'])) {
	$industryCategory = $conn->real_escape_string(ucfirst($_POST['industryCategory']));
	
	$checkstr = "SELECT * FROM tbl_industries_category WHERE industry_name = '$industryCategory'";
	$checkqry = $conn->query($checkstr);
	$counter = $checkqry->num_rows;

	if($counter == 0) {
		$str = "INSERT INTO tbl_industries_category (industry_name) VALUES ('$industryCategory')";
		$qry = $conn->query($str);
		echo "1";
	} else {
		echo "0";
	}
}

//adding sub industry category
if(isset($_POST['industrySubCategory'])) {
	$industrySubCategory = $conn->real_escape_string($_POST['industrySubCategory']);
	$industryId = $conn->real_escape_string($_POST['industryId']);

	$checkstr = "SELECT * FROM tbl_industries_subcategory WHERE (industry_sub_name = '$industrySubCategory' AND industry_id = '$industryId')";
	$checkqry = $conn->query($checkstr);
	$counter = $checkqry->num_rows;

	if($counter == 0) {
		$str = "INSERT INTO tbl_industries_subcategory (industry_sub_name, industry_id) VALUES ('$industrySubCategory', '$industryId')";
		$qry = $conn->query($str);
		echo "1";
	} else {
		echo "0";
	}
}

//view industry

 if(isset($_POST["industry_id"]))  
 {  
      $output = '';  
      $query = "SELECT * FROM tbl_industries_subcategory WHERE industry_id = '".$_POST["industry_id"]."'";  
      $result = $conn->query($query);  
      $output .= '  
      <div class="table-responsive" id="industry_detail">
			        <table class="table app-table-hover mb-0 text-left">
						<thead>
							<tr>
								<th class="cell">Industry Sub ID</th>
								<th class="cell">Industry Description Name</th>
							</tr>
						</thead>
						<tbody>';  
      while($row = $result->fetch_array()) {  
           $output .= '  
                <tr>  
                     <td>'.$row["industry_sub_id"].'</td>  
                     <td>'.$row["industry_sub_name"].'</td>  
                </tr>  
                ';  
      }  
      $output .= "</tbody></table></div>";  
      echo $output;  
 }  
?>