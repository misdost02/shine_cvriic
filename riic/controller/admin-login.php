<?php
session_start();
include("../../config/config.php");

if(isset($_POST['loginEmail']) && isset($_POST['loginPassword'])) {
  $loginEmail = $conn->real_escape_string(trim($_POST['loginEmail']));
  $loginPassword = $conn->real_escape_string($_POST['loginPassword']);
  
  $checkstr = "SELECT * FROM tbl_admin_users WHERE user_email = '$loginEmail'";
  $checkqry = $conn->query($checkstr);
  $counter = $checkqry->num_rows;

  if($counter == 1) {
    while($row = $checkqry->fetch_array()) {
      $admin_id = $row['id'];
      $pass_word = $row['pass_word'];
      $full_name = $row['full_name'];
      $user_level = $row['level_user'];
      $photo = $row['photo'];
    }

    if(password_verify($loginPassword, $pass_word)) {
      $_SESSION['adminemail'] = $loginEmail;
      $_SESSION['adminid'] = $admin_id;
      $_SESSION['adminname'] = $full_name;
      $_SESSION['adminlevel'] = $user_level;
      $_SESSION['adminphoto'] = $photo;
      
      echo "1";
    } else {
       echo "0";
    }
  } else {
    echo "2";
  }
}

?>