<?php
    session_start();

    if(isset($_POST['adminid'])) {
        unset($_SESSION['adminemail']); 
        unset($_SESSION['adminid']);
        unset($_SESSION['adminname']);
        unset($_SESSION['adminlevel']);
        unset($_SESSION['adminphoto']);
        
        session_destroy();

        echo "200";
    } else {
        echo "404";
    }
?>