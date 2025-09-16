<?php

    if(!isset($_SESSION['adminemail']) && !isset($_SESSION['adminid'])) {
        echo "<script type='text/javascript'>
            alert('ERROR 404: URL could not found on this server.')
            window.location = '.././'
        </script>";
    }

?>