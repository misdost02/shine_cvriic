<?php
	session_start();
	include("../config/config.php");
	include("controller/config-session.php");
	$active = 3;
	//include("controller/get-address.php");
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
				        <h1 class="app-page-title mb-0 text-uppercase">Micro, Small, and Medium Enterprises (MSME)</h1>
				    </div>
				    <div class="col-auto">
					    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
						    <div class="col-auto">
							    <button class="btn app-btn-primary" data-bs-toggle="modal" data-bs-target="#addCompany"><span class="fa fa-user"></span> Add New</button>
						    </div>
					    </div><!--//row-->
				    </div><!--//table-utilities-->
				</div><!--//row-->

				<div class="row g-4">
					<div class="app-card app-card-orders-table shadow-sm mb-5">
					    <div class="app-card-body p-3">
						    <div class="table-responsive" id="reloadContent">
						        <table class="table app-table-hover mb-0 text-left" id="datatable1">
											<thead>
												<tr>
													<th class="cell">Fullname</th>
													<th class="cell">Industry</th>
													<th class="cell">Sector</th>
													<th class="cell">Name of Company</th>
													<th class="cell">Years of Operation</th>
													<th class="cell">Complete Address</th>
													<th class="cell">Company Products</th>
													<th class="cell">Action</th>
												</tr>
											</thead>
											<tbody>
												<?php
													$get_profile = "SELECT * FROM tbl_cat_msme
													INNER JOIN tbl_client_profiles ON tbl_client_profiles.personnel_id = tbl_cat_msme.personnel_id
													ORDER BY tbl_client_profiles.lastname ASC";
													$get_query = $conn->query($get_profile);
													$get_count = $get_query->num_rows;

													if($get_count >= 1) {
														while($row = $get_query->fetch_array()) {
															$msme_id = $row['msme_id'];
															$industry = $row['industry'];
															$sector = $row['sector'];
															$msme_company = $row['msme_company'];
															$years_op = $row['years_op'];
															$address = $row['address'];
															$firstname = $row['firstname'];
															$lastname = $row['lastname'];

															require_once('controller/compute.php');	

															if($sector == 'Agriculture') {
																$count_total = getAgriMSME($msme_id, $conn);
															} else {
																$count_total = 0;
															}
															

															echo "<tr>
																	<td><span id='owner_name'>$lastname, $firstname</span></td>
																	<td>$industry</td>
																	<td><span id='sector_type'>$sector</span></td>
																	<td><h6 class='text-danger'>$msme_company</h6></td>
																	<td>$years_op</td>
																	<td>$address</td>
																	<td><button type='button' class='btn btn-info text-white btn-sm view_msme' id='$msme_id' data-id='$sector'><i class='fa fa-eye'></i> View Data <span class='badge bg-danger'>$count_total</span></button></td>
																	<td>
																		<button type='button' class='btn btn-success text-white btn-sm add_new' id='$msme_id' data-id='$firstname $lastname' value='$sector' title='Add Products'><i class='fa fa-plus'></i></button>
																		<button type='button' class='btn btn-warning text-white btn-sm edit_msme'><i class='fa fa-edit'></i></button>
																		<button type='button' class='btn btn-danger text-white btn-sm del_msme'><i class='fa fa-trash'></i></button>
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
      <script src="js/msme.js"></script>
	  <script src="js/msme-agri.js"></script>
      <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
      <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
      <script src="js/sweetalert/sweetalert.min.js"></script>
      <script src="assets/bootstrap-3-typeahead/bootstrap3-typeahead.min.js"></script>


</body>
</html> 

<script type="text/javascript">
	$(document).ready(function() {
	    $('#datatable1').DataTable();
	});

	$(document).ready(function() {
	    $('#datatable2').DataTable();
	});
</script>


<div class="modal fade in" id="addCompany" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
    	<form id="msme_form" method="POST">
			<div class="modal-header bg-success">
				<h4 class="modal-title">Add New MSME</h4>
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
						      	<option value='Citrus'>Citrus</option>
						      	<option value='Banana'>Banana</option>
						      	<option value='Corn'>Corn</option>
								<option value='Food'>Food</option>
						    </select>
						</div>
						<div class="col">
							<label class="form-label h6 mb-3">Sector</label><br>
							<div class="form-check form-check-inline">
							  <input class="form-check-input" onclick="getSector()" type="radio" id="agriculture" name="sector[]"  value="Agriculture">
							  <label class="form-check-label" for="agriculture">Agriculture</label>
							</div>
							<div class="form-check form-check-inline">
							  <input class="form-check-input" onclick="getSector()" type="radio" id="manufacturing" name="sector[]" value="Manufacturing">
							  <label class="form-check-label" for="manufacturing">Manufacturing</label>
							</div>
							<div class="form-check form-check-inline">
							  <input class="form-check-input" onclick="getSector()" type="radio" id="marketing" name="sector[]" value="Marketing">
							  <label class="form-check-label" for="marketing">Marketing</label>
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

						<input type="hidden" class="form-control" id="sel_type" name="institution_type" readonly>
					</div>
				</div>
			  <div class="row mb-3">
					<div class="col">
						<label class="form-label h6">Name of Company</label>
						<input type="text" class="form-control" id="company_name" name="company_name" required>
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
				<div class="row mb-3">
					<div class="col">
						<label class="form-label h6">Complete Address of Company</label>
						<input type="text" class="form-control" id="company_address" name="company_address" required>
					</div>
				</div>

			</div>

			<div class="modal-footer">
				<button type="submit" id="save_msme" class="btn btn-danger text-white"><span class="fa fa-save"></span> Save</button>
				<button type="button"  class="btn btn-secondary close_modal" data-bs-dismiss="modal">Close</button>
			</div>
  		</form>
    </div>
  </div>
</div>

<!-- AGRICULTURE -->

<div class="modal fade in" id="addIndustry" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
    	<form id="msme_industry_form" method="POST">
			<div class="modal-header bg-success">
				<h4 class="modal-title">Add New Farm or Orchard</h4>
				<!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
			</div>
			<div class="modal-body">
				<div class="row mb-3">
					<div class="col">
						<label class="form-label h6">Owner</label>
						<input type="text" class="form-control" id="owner" name="owner" required readonly>
					</div>
					<div class="col-md-3">
						<label class="form-label h6">MSME ID</label>
						<input type="text" class="form-control" id="msme_agri_id" name="msme_agri_id" required readonly>
					</div>
				</div>

			  	<div class="row mb-3">
					<div class="col">
						<label class="form-label h6">Name of Farm or Orchard</label>
						<input type="text" class="form-control" id="industry_name" name="industry_name">
					</div>
					<div class="col-md-3">
						<label class="form-label h6">Farm or Orchard Area</label>
						<input type="text" class="form-control" id="farm_area" name="farm_area">
					</div>
					<div class="col-md-3">
						<label class="form-label h6">Age of Orchard</label>
						<select class="form-select" id="years_orchard" name="years_orchard" required>
					      	<option value="">---</option>
					      	<?php
					      		for($x=1;$x<=40;$x++) {
					      			echo "<option value='$x'>$x</option>";
					      		}
					      	?>
					    </select>
					</div>
				</div>
				<div class="row mb-3">
					<div class="col">
						<label class="form-label h6">Complete Address of Orchard</label>
						<input type="text" class="form-control" id="orchard_address" name="orchard_address" required>
					</div>
				</div>
				<div class="row mb-3">
					<div class="col">
						<label class="form-label h6">Latitude</label>
						<input type="text" class="form-control" id="latitude" name="latitude">
					</div>
					<div class="col">
						<label class="form-label h6">Longitude</label>
						<input type="text" class="form-control" id="longitude" name="longitude">
					</div>
				</div>

			</div>

			<div class="modal-footer">
				<input type="hidden" class="form-control" id="msmeagriid" name="msmeagriid" required readonly>
				<button type="submit" id="save_agri_industry" class="btn btn-danger text-white"><span class="fa fa-save"></span> Save</button>
				<button type="button"  class="btn btn-secondary close_modal" data-bs-dismiss="modal">Close</button>
			</div>
  		</form>
    </div>
  </div>
</div>


<div class="modal fade in" id="viewCompany" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
			<div class="modal-header bg-info">
				<h4 class="modal-title" id="sector_id"></h4>
				<!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
			</div>
			<div class="modal-body py-3 px-3">
				<div class="table-responsive" id="agri_products">
					<table class="table app-table-hover table-hover table-stripe" id="datatable3">
						<thead>
							<tr>
								<th class="cell">#</th>
								<th class="cell" width="25%">Name of Orchard</th>
								<th class="cell">Area (Ha)</th>
								<th class="cell">Years of Orchard</th>
								<th class="cell">Address</th>
								<th class="cell">Action Taken</th>
							</tr>
						</thead>
						<tbody id="table_data"></tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<input type='hidden' class="form-control" id="msme_sector_id" readonly>
				<input type="hidden" class="form-control" id="msmeid" name="msmeid" required readonly>
				<!-- <button type="button" class="btn btn-info btn-sm text-white add_new"><span class="fa fa-plus"></span> Add New</button> -->
				<button type="button" class="btn btn-secondary btn-md close_modal" data-bs-dismiss="modal">Close</button>
			</div>
    </div>
  </div>
</div>

<div class="modal fade in" id="addAgriProduct" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
    	<form id="msme_agri_product_form" method="POST">
				<div class="modal-header bg-success">
					<h4 class="modal-title">Add Agricultural Products</h4>
					<!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
				</div>
				<div class="modal-body">
					<div class="row mb-3">
						<div class="col-md">
							<label class="form-label h6">MSME AGRI ID</label>
							<input type="text" class="form-control" id="msme_agri_prod_id" name="msme_agri_prod_id" required readonly>
						</div>
					</div>

					<div class="row mb-3">
						<div class="col-md">
							<label class="form-label h6">Cultivars Grown</label>
							<input type="text" class="form-control" id="cultivars" name="cultivars" required>
						</div>
						<div class="col-md-3">
							<label class="form-label h6">Yield (tons/ha)</label>
							<input type="text" class="form-control" id="yield" name="yield">
						</div>

					</div>
					<div class="row mb-3">
						<div class="col">
							<label class="form-label h6">Prunning</label>
							<input type="text" class="form-control" id="prunning" name="prunning">
						</div>
						<div class="col-md-3">
							<label class="form-label h6">Producing Seedings</label>
							<select class="form-select" id="seeding" name="seeding">
						      	<option value="">---</option>
						      	<option value='1'>Yes</option>
								<option value='0'>No</option>
						    </select>
						</div>
					</div>

					
				</div>

				<div class="modal-footer">
					<button type="submit" id="save_agri_product" class="btn btn-danger text-white"><span class="fa fa-save"></span> Save</button>
					<button type="button"  class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				</div>
  		</form>
    </div>
  </div>
</div>

<div class="modal fade in" id="viewAgriProduct" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
			<div class="modal-header bg-warning">
				<h4 class="modal-title" id="sector_product_id"></h4>
				<!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
			</div>
			<div class="modal-body py-3 px-3">
				<div class="table-responsive">
					<table class="table app-table-hover table-hover table-stripe" id="datatable4">
						<thead>
							<tr>
								<th class="cell">#</th>
								<th class="cell" width="25%">Cultivars Grown</th>
								<th class="cell">Yield (tons/ha)</th>
								<th class="cell">Prunning</th>
								<th class="cell">Producing Seedings</th>
								<th class="cell">Action Taken</th>
							</tr>
						</thead>
						<tbody id="table_data_product"></tbody>
					</table>
				</div>
				<h4 class='text-danger'>Data on Nutrient Management</h4>
				<div class="table-responsive" id="nutrient_data">
					<table class="table app-table-hover table-hover table-condensed table-sm table-stripe" id="datatable5">
						<thead>
							<tr>
								<th class="cell" width="25%">Nutrient Management</th>
								<th class="cell">Timing of Application</th>
								<th class="cell">Rate of application</th>
								<th class="cell">Action Taken</th>
							</tr>
						</thead>
						<tbody id="table_data_product_nut"></tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<input type='hidden' class="form-control" id="msme_sector_id" readonly>
				<input type="hidden" class="form-control" id="msmeid" name="msmeid" required readonly>
				<!-- <button type="button" class="btn btn-info btn-sm text-white add_new"><span class="fa fa-plus"></span> Add New</button> -->
				<button type="button" class="btn btn-secondary btn-md" data-bs-dismiss="modal">Close</button>
			</div>
    </div>
  </div>
</div>



<div class="modal fade in" id="addNutrientManagement" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
    	<form id="msme_agri_product_nut_form" method="POST">
				<div class="modal-header bg-success">
					<h4 class="modal-title">Add Nutrient Management</h4>
					<!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
				</div>
				<div class="modal-body">
					<div class="row mb-3">
						<div class="col-md">
							<label class="form-label h6">MSME AGRI PRODUCT ID</label>
							<input type="text" class="form-control" id="msme_agri_nut_id" name="msme_agri_nut_id" required readonly>
						</div>
					</div>

					<div class="row mb-3">
						<div class="col">
							<label class="form-label h6">Nutrient Management</label>
							<input type="text" class="form-control" id="nut_management" name="nut_management">
						</div>
					</div>
					<div class="row mb-3">
						<div class="col">
							<label class="form-label h6">Timing of Application</label>
							<input type="text" class="form-control" id="timing_application" name="timing_application">
						</div>
						<div class="col">
							<label class="form-label h6">Rate of application</label>
							<input type="text" class="form-control" id="rate_application" name="rate_application">
						</div>
					</div>

					
				</div>

				<div class="modal-footer">
					<button type="submit" id="save_agri_product_nut" class="btn btn-danger text-white"><span class="fa fa-save"></span> Save</button>
					<button type="button"  class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				</div>
  		</form>
    </div>
  </div>
</div>


<div class="modal fade in" id="addPestManagement" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
    	<form id="msme_agri_product_pest_form" method="POST">
				<div class="modal-header bg-danger">
					<h4 class="modal-title">Add Pest Management</h4>
					<!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
				</div>
				<div class="modal-body">
					<div class="row mb-3">
						<div class="col-md">
							<label class="form-label h6">MSME AGRI NUTRIENT ID</label>
							<input type="text" class="form-control" id="msme_agri_pest_id" name="msme_agri_pest_id" required readonly>
						</div>
					</div>

					<div class="row mb-3">
						<div class="col">
							<label class="form-label h6">Pest and Disease Management</label>
							<input type="text" class="form-control" id="pest_management" name="pest_management" required>
						</div>
					</div>
					<div class="row mb-3">
						<div class="col">
							<label class="form-label h6">Timing of Application</label>
							<input type="text" class="form-control" id="pest_timing_application" name="pest_timing_application">
						</div>
						<div class="col">
							<label class="form-label h6">Rate of application</label>
							<input type="text" class="form-control" id="pest_rate_application" name="pest_rate_application">
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-md-5">
							<label class="form-label h6">Major Insect Pest</label>
							<input type="text" class="form-control" id="pest_insect" name="pest_insect">
						</div>
						<div class="col">
							<label class="form-label h6">Growth Stage Observed</label>
							<input type="text" class="form-control" id="pest_growth_stage1" name="pest_growth_stage1">
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-md-5">
							<label class="form-label h6">Major Diseases</label>
							<input type="text" class="form-control" id="pest_diseases" name="pest_diseases">
						</div>
						<div class="col">
							<label class="form-label h6">Growth Stage Observed</label>
							<input type="text" class="form-control" id="pest_growth_stage2" name="pest_growth_stage2">
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-md-4">
							<label class="form-label h6">Presence of Drainage Canals</label>
							<select class="form-select" id="pest_drainage" name="pest_drainage">
						      	<option value="">---</option>
						      	<option value='1'>Yes</option>
								<option value='0'>No</option>
						    </select>
						</div>
						<div class="col">
							<label class="form-label h6">Water Management</label>
							<input type="text" class="form-control" id="pest_water" name="pest_water">
						</div>
					</div>
					<div class="row mb-3">
						<div class="col">
							<label class="form-label h6">Frequency of Irrigation</label>
							<input type="text" class="form-control" id="pest_irrigation" name="pest_irrigation">
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button type="submit" id="save_agri_product_pest" class="btn btn-danger text-white"><span class="fa fa-save"></span> Save</button>
					<button type="button"  class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				</div>
  		</form>
    </div>
  </div>
</div>


<div class="modal fade in" id="viewAgriProductPest" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
			<div class="modal-header bg-secondary">
				<h4 class="modal-title">Data on Nutrient Management</h4>
				<!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
			</div>
			<div class="modal-body py-3 px-3">
				<div class="table-responsive">
					<table class="table app-table-hover table-hover table-stripe" id="datatable5">
						<thead>
							<tr>
								<th class="cell">Pest and Disease Management</th>
								<th class="cell">Timing of Application</th>
								<th class="cell">Rate of Application</th>
								<th class="cell">Major Insect Pest</th>
								<th class="cell">Growth Stage Observed</th>
								<th class="cell">Major Diseases </th>
								<th class="cell">Growth Stage Observed</th>
								<th class="cell">Presence of Drainage Canals</th>
								<th class="cell">Water Management</th>
								<th class="cell">Frequency of Irrigation</th>
							</tr>
						</thead>
						<tbody id="table_data_product_pest"></tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary btn-md" data-bs-dismiss="modal">Close</button>
			</div>
    </div>
  </div>
</div>