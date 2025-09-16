<?php

	function checkRegisteredUser($conn) {
        $check = "SELECT * FROM tbl_admin_users WHERE level_user = '1'";
        $query = $conn->query($check);
        $count_check = $query->num_rows;

        if($count_check == 1) {
            return 1;
        } else {
            return 0;
        }
    }
?>