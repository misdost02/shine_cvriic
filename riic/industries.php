<?php
	session_start();
	include("../config/config.php");
	$active = 3;
	include("controller/get-address.php");
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
				        <h1 class="app-page-title mb-0 text-uppercase">INDUSTRIES</h1>
				    </div>
				    <div class="col-auto">
					    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
						    <div class="col-auto">
							    <button class="btn app-btn-primary" data-bs-toggle="modal" data-bs-target="#addIndustry"><span class="fa fa-user"></span> Add New</button>
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
													<th class="cell">Name of Industry</th>
													<th class="cell">Years of Operation</th>
													<th class="cell">Complete Address</th>
													<th class="cell">Products</th>
													<th class="cell">Action</th>
												</tr>
											</thead>
											<tbody>
												<?php
													$get_profile = "SELECT * FROM tbl_cat_industries
													INNER JOIN tbl_client_profiles ON tbl_client_profiles.personnel_id = tbl_cat_industries.personnel_id
													ORDER BY tbl_client_profiles.lastname ASC";
													$get_query = $conn->query($get_profile);
													$get_count = $get_query->num_rows;

													if($get_count >= 1) {
														while($row = $get_query->fetch_array()) {
															$industry_id = $row['industry_id'];
															$industry = $row['industry'];
															$sector = $row['sector'];
															$company = $row['company'];
															$years_op = $row['years_op'];
															$address = $row['address'];
															$firstname = $row['firstname'];
															$lastname = $row['lastname'];

															require_once('controller/compute.php');

															$count_total = getIndustryProducts($industry_id, $conn);

															echo "<tr>
																	<td>$lastname, $firstname</td>
																	<td>$industry</td>
																	<td><h6 class='text-danger'>$sector</h6></td>
																	<td>$company</td>
																	<td>$years_op</td>
																	<td>$address</td>
																	<td><button type='button' class='btn btn-info text-white btn-sm view_industry' id='$industry_id'><i class='fa fa-eye'></i> View Products <span class='badge bg-danger'>$count_total</span></button></td>
																	<td>
																		<button type='button' class='btn btn-success text-white btn-sm add_new' id='$industry_id' title='Add Lab Facilities'><i class='fa fa-plus'></i></button>
																		<button type='button' class='btn btn-warning text-white btn-sm edit_industry'><i class='fa fa-edit'></i></button>
																		<button type='button' class='btn btn-danger text-white btn-sm del_industry'><i class='fa fa-trash'></i></button>
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
      <script src="js/industry.js"></script>
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


<div class="modal fade in" id="addIndustry" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
    	<form id="industry_form" method="POST">
			<div class="modal-header bg-info">
				<h4 class="modal-title">Add New Industry</h4>
				<!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
			</div>
			<div class="modal-body">
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
						      	<option value='Agriculture'>Agriculture</option>
						    </select>
						</div>
						<div class="col">
							<label class="form-label h6 mb-3">Sector</label><br>
							<div class="form-check form-check-inline">
							  <input class="form-check-input" onclick="getSector()" type="checkbox" id="citrus" name="sector[]"  value="Citrus">
							  <label class="form-check-label" for="citrus">Citrus</label>
							</div>
							<div class="form-check form-check-inline">
							  <input class="form-check-input" onclick="getSector()" type="checkbox" id="banana" name="sector[]" value="Banana">
							  <label class="form-check-label" for="banana">Banana</label>
							</div>
							<div class="form-check form-check-inline">
							  <input class="form-check-input" onclick="getSector()" type="checkbox" id="rice" name="sector[]" value="Rice">
							  <label class="form-check-label" for="rice">Rice</label>
							</div>
							<div class="form-check form-check-inline">
							  <input class="form-check-input" onclick="getSector()" type="checkbox" id="corn" name="sector[]" value="Corn">
							  <label class="form-check-label" for="corn">Corn</label>
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
						<label class="form-label h6">Name of Industry or Company</label>
						<input type="text" class="form-control" id="industry_name" name="industry_name">
					</div>
					<div class="col-md-4">
						<label class="form-label h6">Age of Orchard</label>
						<select class="form-select" id="years_op" name="years_op" required>
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
						<label class="form-label h6">Complete Address of Orchard or Company</label>
						<input type="text" class="form-control" id="industry_address" name="industry_address" required>
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
				<button type="submit" id="save_industry" class="btn btn-danger text-white"><span class="fa fa-save"></span> Save</button>
				<button type="button"  class="btn btn-secondary close_modal" data-bs-dismiss="modal">Close</button>
			</div>
  		</form>
    </div>
  </div>
</div>

<div class="modal fade in" id="viewIndustryProducts" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
			<div class="modal-header bg-info">
				<h4 class="modal-title">List of Industries</h4>
				<!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
			</div>
			<div class="modal-body py-0 px-3">
				<table class="table table-sm table-hover mb-0">
					<thead>
						<tr>
							<th class="cell">#</th>
							<th class="cell" width="25%">Name of Product</th>
							<th class="cell">Product Description</th>
						</tr>
					</thead>
					<tbody id="table_data"></tbody>
				</table>
			</div>
			<div class="modal-footer">
				<input type="hidden" class="form-control" id="industryid" name="industryid" required readonly>
				<button type="button" class="btn btn-info text-white add_new"><span class="fa fa-plus"></span> Add New</button>
				<button type="button" class="btn btn-secondary close_modal" data-bs-dismiss="modal">Close</button>
			</div>
    </div>
  </div>
</div>

<div class="modal fade in" id="addIndustryProducts" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
    	<form id="industry_product_form" method="POST">
				<div class="modal-header bg-info">
					<h4 class="modal-title">Add Industry Products</h4>
					<!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
				</div>
				<div class="modal-body">
					<div class="row mb-3">
						<div class="col-md">
							<label class="form-label h6">Industry ID</label>
							<input type="text" class="form-control" id="industry_id" name="industry_id" required readonly>
						</div>
					</div>

					<div class="row mb-3">
						<div class="col">
							<label class="form-label h6">Name of Industry Product</label>
							<input type="text" class="form-control" id="product_name" name="product_name" required>
						</div>
					</div>
					<div class="row mb-3">
						<div class="col">
							<label class="form-label h6">Description of Industry Product</label>
							<textarea class="form-control" id="product_desc" name="product_desc" required style="height:100px;"></textarea>
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button type="submit" id="save_product" class="btn btn-danger text-white"><span class="fa fa-save"></span> Save</button>
					<button type="button"  class="btn btn-secondary close_modal" data-bs-dismiss="modal">Close</button>
				</div>
  		</form>
    </div>
  </div>
</div>

