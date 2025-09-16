<?php
	session_start();
	include("../config/config.php");
	include("controller/config-session.php");
	$active = 3;
	//nclude("controller/get-address.php");
	// if(!isset($_GET['token'])) {
	// 	header('location:'.MAIN_ADMIN_URL.'home');
	// } else {
	// 	$cat_id_token = $conn->real_escape_string($_GET['token']);
	// }
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
				        <h1 class="app-page-title mb-0">R&D FACILITIES</h1>
				    </div>
				    <div class="col-auto">
					    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">

						    <div class="col-auto">
							    <button class="btn app-btn-primary" data-bs-toggle="modal" data-bs-target="#addRND"><span class="fa fa-user"></span> Add New</button>
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
													<th class="cell">Fullname</th>
													<th class="cell">Industry</th>
													<th class="cell">Sector</th>
													<th class="cell">R&D Facility or Laboratory</th>
													<th class="cell">Years of Operation</th>
													<th class="cell">Facility or Lab Units</th>
													<th class="cell">Action</th>
												</tr>
											</thead>
											<tbody>
												<?php
													$get_profile = "SELECT * FROM tbl_cat_rnd
													INNER JOIN tbl_client_profiles ON tbl_client_profiles.personnel_id = tbl_cat_rnd.personnel_id
													ORDER BY tbl_client_profiles.lastname ASC";
													$get_query = $conn->query($get_profile);
													$get_count = $get_query->num_rows;

													if($get_count >= 1) {
														while($row = $get_query->fetch_array()) {
															$rnd_id = $row['rnd_id'];
															$industry = $row['industry'];
															$sector = $row['sector'];
															$rnd_facility_lab = $row['rnd_facility_lab'];
															$years_op = $row['years_op'];
															$firstname = $row['firstname'];
															$lastname = $row['lastname'];

															require_once('controller/compute.php');

															$count_total = getRNDFacilities($rnd_id, $conn);


															echo "<tr>
																	<td>$lastname, $firstname</td>
																	<td>$industry</td>
																	<td>$sector</td>
																	<td><h6 class='text-danger'>$rnd_facility_lab</h6></td>
																	<td>$years_op</td>
																	<td><button type='button' class='btn btn-info text-white btn-sm view_rnd' id='$rnd_id'><i class='fa fa-eye'></i> View Units <span class='badge bg-danger'>$count_total</span></button></td>
																	<td>
																		<button type='button' class='btn btn-success text-white btn-sm add_new' id='$rnd_id' title='Add Lab Facilities'><i class='fa fa-plus'></i></button>
																		<button type='button' class='btn btn-warning text-white btn-sm edit_rnd'><i class='fa fa-edit'></i></button>
																		<button type='button' class='btn btn-danger text-white btn-sm del_rnd'><i class='fa fa-trash'></i></button>
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
				</div><!--//row-->
		    </div><!--//container-fluid-->
	    </div><!--//app-content-->
	    
	    <?php include("pages/footer.php"); ?>
	    
    </div><!--//app-wrapper-->    					

 
     <?php include("pages/js.php"); ?>
      <script src="js/rnd-facilities.js"></script>

      <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
      <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
      <script src="js/sweetalert/sweetalert.min.js"></script>
      <script src="assets/bootstrap-3-typeahead/bootstrap3-typeahead.min.js"></script>
</body>
</html> 

<script type="text/javascript">
	$(document).ready(function() {
	    $('#example').DataTable();
	});

</script>

<div class="modal fade in" id="addRND" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
    	<form id="rnd_facilities_form" method="POST">
			<div class="modal-header bg-info">
				<h4 class="modal-title">Add New R&D Facility</h4>
				<!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
			</div>
			<div class="modal-body">
				<div class="alert alert-info text-center alert-dismissible" style="display:none;" id="message1"></div>
				<div class="row mb-3">
					<div class="col">
						<label class="form-label h6">Type firstname or lastname to search</label>
						<input type="text" class="form-control" id="fullname" name="fullname" required>
					</div>
					<div class="col-md-3">
						<label class="form-label h6">Personnel ID</label>
						<input type="text" class="form-control" id="personnel_id" name="personnel_id" required readonly>
					</div>
				</div>
				<div class="row mb-3">
						<div class="col-md-3">
							<label class="form-label h6">Industry</label>
							<select class="form-select" id="industry" name="industry" required>
						      	<option value="">---</option>
						      	<option value='Academic'>Academic</option>
						      	<option value='MSME'>MSME</option>
						      	<option value='Agriculture'>Agriculture</option>
						    </select>
						</div>
						<div class="col">
							<label class="form-label h6 mb-3">Sector</label><br>
							<div class="form-check form-check-inline">
							  <input class="form-check-input" onclick="getSector()" type="checkbox" id="instruction" name="sector[]"  value="Instruction">
							  <label class="form-check-label" for="instruction">Instruction</label>
							</div>
							<div class="form-check form-check-inline">
							  <input class="form-check-input" onclick="getSector()" type="checkbox" id="research" name="sector[]" value="Research">
							  <label class="form-check-label" for="research">Research</label>
							</div>
							<div class="form-check form-check-inline">
							  <input class="form-check-input" onclick="getSector()" type="checkbox" id="extension" name="sector[]" value="Extension">
							  <label class="form-check-label" for="extension">Extension</label>
							</div>
							<div class="form-check form-check-inline">
							  <input class="form-check-input" onclick="getSector()" type="checkbox" id="production" name="sector[]" value="Production">
							  <label class="form-check-label" for="production">Production</label>
							</div>
							
							<input type="hidden" class="form-control" id="sel_sectors" name="sectors" required readonly>
						</div>
				</div>
				<div class="row mb-3">
					<div class="col">
						<label class="form-label h6 mb-3">Type of Institution</label><br>
						<div class="form-check form-check-inline">
						  <input class="form-check-input" onclick="getType()" type="checkbox" id="suc" name="typeints[]"  value="SUC">
						  <label class="form-check-label" for="suc">State Universities and Colleges (SUC)</label>
						</div>
						<div class="form-check form-check-inline">
						  <input class="form-check-input" onclick="getType()" type="checkbox" id="nonsecretarian" name="typeints[]" value="Non-Secretarian">
						  <label class="form-check-label" for="nonsecretarian">Non-Secretarian</label>
						</div>

						<input type="hidden" class="form-control" id="sel_type" name="institution_type" required readonly>
					</div>
				</div>
			  <div class="row mb-3">
					<div class="col">
						<label class="form-label h6">Type R&D Facility/ Laboratory</label>
						<input type="text" class="form-control" id="rnd_facility" name="rnd_facility" required>
					</div>
					<div class="col-md-3">
						<label class="form-label h6">Years of Operation</label>
						<select class="form-select" id="years_op" name="years_op">
					      	<option value="">---</option>
					      	<?php
					      		for($x=1;$x<=40;$x++) {
					      			echo "<option value='$x'>$x</option>";
					      		}
					      	?>
					    </select>
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<input type='hidden' id="rndid" name="rndid" value="" readonly>
				<button type="submit" id="save_facility" class="btn btn-danger text-white"><span class="fa fa-save"></span> Save</button>
				<button type="button"  class="btn btn-secondary close_modal" data-bs-dismiss="modal">Close</button>
			</div>
  		</form>
    </div>
  </div>
</div>

<div class="modal fade in" id="viewRND" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
			<div class="modal-header bg-info">
				<h4 class="modal-title">Laboratory Unit or Facility</h4>
				<!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
			</div>
			<div class="modal-body py-0 px-3">
				<table class="table table-sm table-hover mb-0">
					<thead>
						<tr>
							<th class="cell">#</th>
							<th class="cell" width="30%">Lab Unit or Facility</th>
							<th class="cell">Line of Service / Functions</th>
						</tr>
					</thead>
					<tbody id="table_data"></tbody>
				</table>
			</div>
			<div class="modal-footer">
				<input type="hidden" class="form-control" id="lab_rndid" name="lab_rndid" required readonly>
				<button type="button" class="btn btn-info text-white add_new"><span class="fa fa-plus"></span> Add New</button>
				<button type="button" class="btn btn-secondary close_modal" data-bs-dismiss="modal">Close</button>
			</div>
    </div>
  </div>
</div>

<div class="modal fade in" id="addRNDunit" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
    	<form id="rnd_units_form" method="POST">
				<div class="modal-header bg-info">
					<h4 class="modal-title">Lab Unit or Facility</h4>
					<!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
				</div>
				<div class="modal-body">
					<div class="alert alert-info text-center alert-dismissible" style="display:none;" id="message"></div>
					<div class="row mb-3">
						<div class="col-md">
							<label class="form-label h6">Laboratory ID</label>
							<input type="text" class="form-control" id="lab_id" name="lab_id" required readonly>
						</div>
					</div>

					<div class="row mb-3">
						<div class="col">
							<label class="form-label h6">Name of Unit</label>
							<input type="text" class="form-control" id="unit_name" name="unit_name" required>
						</div>
					</div>
					<div class="row mb-3">
						<div class="col">
							<label class="form-label h6">Line of Service / Functions</label>
							<textarea class="form-control" id="service_name" name="service_name" style="height:100px;"></textarea>
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button type="submit" id="save_unit" class="btn btn-danger text-white"><span class="fa fa-save"></span> Save</button>
					<button type="button"  class="btn btn-secondary close_modal" data-bs-dismiss="modal">Close</button>
				</div>
  		</form>
    </div>
  </div>
</div>

