<?php
session_start();

require_once("../../config/config.php");

if(isset($_POST['product_name'])) {
  
  $keyword = $_POST['product_name'];

  $query = "SELECT * FROM tbl_msme_products WHERE product_name LIKE '$keyword%' LIMIT 25";
  $result = $conn->query($query);
  $count_res = $result->num_rows;

  if ($count_res > 0) {

    $resulta = array();
    while ($row = $result->fetch_array()) {
      // $res[] = $row['firstname']." ".$row['lastname'];
      $data = ['product_name' => $row['product_name']];
      $resulta[] = $data;
    }
  } else {
      $resulta = array();
  }
  //return json res
  echo json_encode($resulta);
}


if(isset($_POST['msme_id'])) {
  
  $msme_id = $_POST['msme_id'];
  $sector_id = $_POST['sector_id'];

  if($sector_id == "Agriculture") {
    $query = "SELECT * FROM tbl_cat_msme_agrictulture WHERE msme_id = '$msme_id'";
    $result = $conn->query($query);
    $count_res = $result->num_rows;

    if ($count_res > 0) {

      $resulta = array();
      while ($row = $result->fetch_array()) {
        // $res[] = $row['firstname']." ".$row['lastname'];
        $data = ['msme_agri_id' => $row['msme_agri_id'], 'company' => $row['company'], 'farm_area' => $row['farm_area'], 'years_op' => $row['years_op'], 'address' => $row['address']];
        $resulta[] = $data;
      }

    }  else {
        $resulta = array();
    }
    echo json_encode($resulta);
  }
  //return json res
  
  
}

?>