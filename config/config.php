<?php
	define("MAIN_URL", "https://www.cvriics.com/");
	define("MAIN_ADMIN_URL", "https://www.cvriics.com/riic/");

	try {
		define("SERVER", "localhost");
		define("USERNAME", "cvriicsc_shine_cv02");
		define("PASSWORD", "20.sh!n3@CVr!ics.22");
		define("DATABASE", "cvriicsc_cvriic02_db");

		$conn = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);

		if($conn->connect_error) {
			die("Could not connect to server! ".$conn->connect_error);
		}
	} catch (Exception $err) {
		die("ERROR: Connection failed! Please contact the administrator.");
	}
?>