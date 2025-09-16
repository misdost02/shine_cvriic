<?php
session_start();

require_once("../../config/config.php");

// LABORATORY FACILITIES
if(isset($_POST['rnd_facility'])) {
  
  $keyword = $_POST['rnd_facility'];

  $query = "SELECT * FROM tbl_rnd_facilities WHERE facility_name LIKE '%$keyword%' LIMIT 25";
  $result = $conn->query($query);
  $count_res = $result->num_rows;

  if ($count_res > 0) {

    $resulta = array();
    while ($row = $result->fetch_array()) {
      // $res[] = $row['firstname']." ".$row['lastname'];
      $data = ['facility_name' => $row['facility_name']];
      $resulta[] = $data;
    }
  } else {
      $resulta = array();
  }
  //return json res
  echo json_encode($resulta);
}

// LABORATORY UNITS
if(isset($_POST['unit_name'])) {
  
  $keyword = $_POST['unit_name'];

  $query = "SELECT * FROM tbl_rnd_units WHERE unit_name LIKE '%$keyword%' LIMIT 25";
  $result = $conn->query($query);
  $count_res = $result->num_rows;

  if ($count_res > 0) {

    $ress= array();
    while ($row = $result->fetch_array()) {
      // $res[] = $row['firstname']." ".$row['lastname'];
      $data = ['unit_name' => $row['unit_name']];
      $ress[] = $data;
    }
  } else {
      $ress = array();
  }
  //return json res
  echo json_encode($ress);
}


if(isset($_POST['rnd_id'])) {
  
  $rnd_id = $_POST['rnd_id'];

  $query = "SELECT * FROM tbl_cat_rnd_units WHERE rnd_id = '$rnd_id'";
  $result = $conn->query($query);
  $count_res = $result->num_rows;

  if ($count_res > 0) {

    $resulta = array();
    while ($row = $result->fetch_array()) {
      // $res[] = $row['firstname']." ".$row['lastname'];
      $data = ['facility_unit_name' => $row['facility_unit_name'], 'facility_service_desc' => $row['facility_service_desc']];
      $resulta[] = $data;
    }

  }  else {
      $resulta = array();
  }
  //return json res
  echo json_encode($resulta);
  
}

?>