<?php
	session_start();
	include("../config/config.php");
	include("controller/config-session.php");
	$active = 5;
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
				        <h1 class="app-page-title mb-0">State, Universities, and Colleges</h1>
				    </div>
				    <div class="col-auto">
					    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">

						    <div class="col-auto">
							    <button class="btn app-btn-primary" data-bs-toggle="modal" data-bs-target="#addSchool"><span class="fa fa-plus"></span> Add SUC</button>
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
											<th class="cell">SUC ID</th>
											<th class="cell">SUC Name</th>
											<th class="cell">Campus</th>
											<th class="cell">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$checkstr = "SELECT * FROM tbl_institutions ORDER BY institution_id ASC";
												$checkqry = $conn->query($checkstr);
												$counter = $checkqry->num_rows;

												if($counter >= 1) {
													while($row = $checkqry->fetch_array()) {
														$institution_id = $row['institution_id'];
														$institution_name = $row['institution_name'];

													echo "<tr>
															<td>$institution_id</td>
															<td>$institution_name</td>
															<td>
																<button type='button' class='btn btn-info text-white btn-sm view_campus' id='$institution_id'><i class='fa fa-eye'></i></button>
															</td>
															<td>
																<button type='button' class='btn btn-success text-white btn-sm add_campus' id='$institution_id' title='Add Campus'><i class='fa fa-plus'></i></button>
																<button type='button' class='btn btn-warning text-white btn-sm edit_school' id='$institution_id'><i class='fa fa-edit'></i></button>
																<button type='button' class='btn btn-danger text-white btn-sm del_school'><i class='fa fa-trash'></i></button>
															</td>
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
	<script src="js/institution.js" type="text/javascript"></script>
    <script src="js/sweetalert/sweetalert.min.js"></script>

</body>
</html> 

<script type="text/javascript">
	$(document).ready(function() {
	    $('#example').DataTable();
	})
</script>


<div class="modal" id="addSchool" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-md  modal-dialog-centered">
    <div class="modal-content">
    	<form class="" id="suc_form" method="POST">
			<div class="modal-header">
				<h4 class="modal-title">Add SUC</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>
			<div class="modal-body">
			    <div class="col-auto my-3">
			    	<label class="form-label">SUC Name:</label>
			        <input type="text" id="institution_name" name="institution_name" class="form-control" required>
			    </div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-danger" id="save_suc"><span class="fa fa-save"></span> Save</button>
				<button type="button"  class="btn btn-secondary close_modal">Close</button>
			</div>
  		</form>
    </div>
  </div>
</div>


<div class="modal" id="addCampus" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-md  modal-dialog-centered">
    <div class="modal-content">
    	<form class="" id="suc_campus_form" method="POST">
			<div class="modal-header">
				<h4 class="modal-title">Add SUC Campus</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>
			<div class="modal-body">
				<div class="col-auto my-3">
			    	<label class="form-label h6">SUC ID:</label>
			        <input type="text" id="suc_id" name="suc_id" class="form-control" required readonly>
			    </div>
			    <div class="col-auto my-3">
			    	<label class="form-label h6">Campus Name:</label>
			        <input type="text" id="campus_name" name="campus_name" class="form-control" required>
			    </div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-danger" id="save_suc_campus"><span class="fa fa-save"></span> Save Campus</button>
				<button type="button"  class="btn btn-secondary close_modal">Close</button>
			</div>
  		</form>
    </div>
  </div>
</div>