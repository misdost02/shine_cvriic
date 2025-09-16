<?php
	session_start();
	include("../config/config.php");
	$active = 3;

	if(!isset($_GET['token'])) {
		header('location:'.MAIN_ADMIN_URL.'home');
	} else {
		$cat_id_token = $conn->real_escape_string($_GET['token']);
	}
?>

<!DOCTYPE html>
<html lang="en"> 
<head>
<?php include("pages/head.php"); ?>
</head> 

<body class="app">   	
    <header class="app-header fixed-top">	   	            
        <?php include("pages/navbar.php"); ?>
    </header><!--//app-header-->
    
    <div class="app-wrapper">
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl" id="reload">
			    
		    	<?php
		    		switch($cat_id_token) {
		    			case 1:
		    				include("view/higher-institutions.php");
		    				break;

		    			case 2:
		    				include("view/higher-institutions.php");
		    				break;

		    			case 3:

		    				break;

		    			case 4:

		    				break;
		    			case 5:
		    				
		    				break;

		    			case 6:

		    				break;

		    			case 7:
		    				include("view/industries.php");
		    				break;

		    			case 8:
		    				include("view/regional-offices.php");
		    				break;
		    		}

		    	?>
			    
		    </div><!--//container-fluid-->
	    </div><!--//app-content-->
	    
	    <?php include("pages/footer.php"); ?>
	    
    </div><!--//app-wrapper-->    					

 
     <?php include("pages/js.php"); ?>

      <script src="js/database.js" type="text/javascript"></script>
      <script src="js/officer.js" type="text/javascript"></script>
      <script src="js/sub-industry.js" type="text/javascript"></script>

      <script src="https://code.jquery.com/jquery-3.5.1.js" type="text/javascript"></script>
      <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js" type="text/javascript"></script>
      <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js" type="text/javascript"></script>
</body>
</html> 

<script type="text/javascript">
	$(document).ready(function() {
	    $('#example').DataTable();
	} )
</script>

