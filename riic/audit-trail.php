<?php
	session_start();
	include("../config/config.php");
	include("controller/config-session.php");
	$active = 6;
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
		    <div class="container-fluid" id="reload">
					<div class="row g-3 mb-4 align-items-center justify-content-between">
				    <div class="col-auto">
				        <h1 class="app-page-title mb-0">Audit Trail</h1>
				    </div>
				    <div class="col-auto">
					    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">

						    <div class="col-auto">
							    <button class="btn app-btn-primary" data-bs-toggle="modal" data-bs-target="#addUserAccount"><span class="fa fa-plus"></span> Add New User Account</button>
						    </div>
					    </div><!--//row-->
				    </div><!--//table-utilities-->
				</div><!--//row-->

				<div class="row g-4">
					<div class="app-card app-card-orders-table shadow-sm mb-5">
					    <div class="app-card-body p-3">
						    <div class="table-responsive" id="reloadContent">
						        <table class="table app-table-hover mb-0 text-left" id="example">
									<thead>
										<tr>
											<th class="cell">ID</th>
											<th class="cell">User ID</th>
											<th class="cell">User Type</th>
											<th class="cell">Activity</th>
											<th class="cell">Date and Time</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$checkstr = "SELECT * FROM tbl_audit_trail ORDER BY id DESC";
												$checkqry = $conn->query($checkstr);
												$counter = $checkqry->num_rows;

												if($counter >= 1) {
													while($row = $checkqry->fetch_array()) {
														$id = $row['id'];
														$userid = $row['userid'];
														$user_type= $row['user_type'];
														$user_activity= $row['user_activity'];
														$date_time= $row['date_time'];

													echo "<tr>
															<td>$id</td>
															<td>$userid</td>
															<td>$user_type</td>
															<td>$user_activity</td>
															<td>$date_time</td>
														</tr>";
													}
												}
											
										?>
									</tbody>
								</table>
					        </div><!--//table-responsive-->
					    </div><!--//app-card-body-->		
					</div><!--//app-card-->			    
		    </div><!--//container-fluid-->
	    </div><!--//app-content-->
	    
	    <?php include("pages/footer.php"); ?>
	    
    </div><!--//app-wrapper-->    					

 
    <?php include("pages/js.php"); ?>
	<script src="js/user_account.js" type="text/javascript"></script>
    <script src="js/sweetalert/sweetalert.min.js"></script>
	<script src="js/croppie.js"></script>

</body>
</html> 

<script type="text/javascript">
	$(document).ready(function() {
	    $('#example').DataTable();
	})
</script>
