<?php
session_start();

require_once("../../config/config.php");

if(isset($_POST['cultivars'])) {
  
  $keyword = $_POST['cultivars'];

  $query = "SELECT * FROM tbl_industry_agri_products WHERE product_name LIKE '$keyword%' LIMIT 25";
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

if(isset($_POST['nut_management'])) {
  
  $keyword = $_POST['nut_management'];

  $query = "SELECT DISTINCT(farm_nutrients) FROM tbl_agri_nut_management WHERE farm_nutrients LIKE '$keyword%' LIMIT 25";
  $result = $conn->query($query);
  $count_res = $result->num_rows;

  if ($count_res > 0) {

    $resulta = array();
    while ($row = $result->fetch_array()) {
      // $res[] = $row['firstname']." ".$row['lastname'];
      $data = ['farm_nutrients' => $row['farm_nutrients']];
      $resulta[] = $data;
    }
  } else {
      $resulta = array();
  }
  //return json res
  echo json_encode($resulta);
}

if(isset($_POST['timing_application'])) {
  
  $keyword = $_POST['timing_application'];

  $query = "SELECT DISTINCT(farm_timing_app) FROM tbl_agri_nut_management WHERE farm_timing_app LIKE '$keyword%' LIMIT 25";
  $result = $conn->query($query);
  $count_res = $result->num_rows;

  if ($count_res > 0) {

    $resulta = array();
    while ($row = $result->fetch_array()) {
      // $res[] = $row['firstname']." ".$row['lastname'];
      $data = ['farm_timing_app' => $row['farm_timing_app']];
      $resulta[] = $data;
    }
  } else {
      $resulta = array();
  }
  //return json res
  echo json_encode($resulta);
}

if(isset($_POST['pest_timing_application'])) {
  
  $keyword = $_POST['pest_timing_application'];

  $query = "SELECT DISTINCT(farm_pest_timing) FROM tbl_agri_pest_management WHERE farm_pest_timing LIKE '$keyword%' LIMIT 25";
  $result = $conn->query($query);
  $count_res = $result->num_rows;

  if ($count_res > 0) {

    $resulta = array();
    while ($row = $result->fetch_array()) {
      // $res[] = $row['firstname']." ".$row['lastname'];
      $data = ['farm_pest_timing' => $row['farm_pest_timing']];
      $resulta[] = $data;
    }
  } else {
      $resulta = array();
  }
  //return json res
  echo json_encode($resulta);
}

if(isset($_POST['msme_agri_id'])) {
  
  $msme_agri_id = $_POST['msme_agri_id'];

  $query = "SELECT * FROM tbl_cat_msme_agrictulture_prod WHERE msme_agri_id = '$msme_agri_id'";
  $result = $conn->query($query);
  $count_res = $result->num_rows;

  if ($count_res > 0) {

    $resulta = array();
    while ($row = $result->fetch_array()) {
      // $res[] = $row['firstname']." ".$row['lastname'];
      $data = ['msme_agri_prod_id' => $row['msme_agri_prod_id'], 'farm_cultivars' => $row['farm_cultivars'], 'farm_yield' => $row['farm_yield'], 'farn_pruning' => $row['farn_pruning'], 'farm_produce_seed' => $row['farm_produce_seed'], 'msme_agri_id' => $row['msme_agri_id']];
      $resulta[] = $data;
    }
  }  else {
      $resulta = array();
  }
  echo json_encode($resulta);
}


if(isset($_POST['msme_agri_product_id'])) {
  
  $msme_agri_product_id = $_POST['msme_agri_product_id'];

  $query = "SELECT * FROM tbl_agri_nut_management WHERE msme_agri_prod_id = '$msme_agri_product_id'";
  $result = $conn->query($query);
  $count_res = $result->num_rows;

  if ($count_res > 0) {
    $resulta = array();
    while ($row = $result->fetch_array()) {
      $data = ['agri_nut_id' => $row['agri_nut_id'], 'farm_nutrients' => $row['farm_nutrients'], 'farm_timing_app' => $row['farm_timing_app'], 'farm_rate_app' => $row['farm_rate_app'], 'msme_agri_prod_id' => $row['msme_agri_prod_id']];
      $resulta[] = $data;
    }
  }  else {
      $resulta = array();
  }
  echo json_encode($resulta);
}


if(isset($_POST['msme_agri_pest_id'])) {
  
  $msme_agri_pest_id = $_POST['msme_agri_pest_id'];

  $query = "SELECT * FROM tbl_agri_pest_management WHERE agri_nut_id = '$msme_agri_pest_id'";
  $result = $conn->query($query);
  $count_res = $result->num_rows;

  if ($count_res > 0) {
    $resulta = array();
    while ($row = $result->fetch_array()) {
      $data = ['agri_pest_id' => $row['agri_pest_id'], 'farm_pest_disease' => $row['farm_pest_disease'], 'farm_pest_timing' => $row['farm_pest_timing'], 'farm_rate_app' => $row['farm_rate_app'], 'farm_insect_pest' => $row['farm_insect_pest'], 'farm_growth1' => $row['farm_growth1'], 'farm_diseases' => $row['farm_diseases'], 'farm_growth2' => $row['farm_growth2'], 'farm_drainage' => $row['farm_drainage'], 'farm_water_mgnt' => $row['farm_water_mgnt'], 'farm_fre_irrig' => $row['farm_fre_irrig']];

      $resulta[] = $data;
    }
  }  else {
      $resulta = array();
  }
  echo json_encode($resulta);
}

?>


