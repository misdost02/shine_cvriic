<?php
session_start();

if(isset($_SESSION['adminemail'])) {
  unset($_SESSION['adminid']);
  unset($_SESSION['adminemail']);
  
  session_destroy();
  
  header('location:../');
}

?>