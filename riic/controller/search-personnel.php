<?php
session_start();

require_once("../../config/config.php");

if(isset($_POST['fullname'])) {
  
  $keyword = $_POST['fullname'];

  $query = "SELECT * FROM tbl_client_profiles WHERE lastname LIKE '%$keyword%' OR firstname LIKE '%$keyword%'  LIMIT 25";
  $result = $conn->query($query);
  $count_res = $result->num_rows;

  if ($count_res > 0) {

    $res = array();
    while ($row = $result->fetch_array()) {
      // $res[] = $row['firstname']." ".$row['lastname'];
      $data = ['personnel_id' => $row['personnel_id'], 'firstname' => $row['firstname'], 'lastname' => $row['lastname']];
      $res[] = $data;
    }
  } else {
      $res = array();
  }
  //return json res
  echo json_encode($res);
}


if(isset($_POST['expertise'])) {
  
  $keyword = $_POST['expertise'];

  $query = "SELECT * FROM tbl_hei_expertise WHERE hei_expertise LIKE '%$keyword%' LIMIT 25";
  $result = $conn->query($query);
  $count_res = $result->num_rows;

  if ($count_res > 0) {

    $resulta = array();
    while ($row = $result->fetch_array()) {
      // $res[] = $row['firstname']." ".$row['lastname'];
      $data = ['hei_expertise' => $row['hei_expertise']];
      $resulta[] = $data;
    }
  } else {
      $resulta = array();
  }
  //return json res
  echo json_encode($resulta);
}




?>