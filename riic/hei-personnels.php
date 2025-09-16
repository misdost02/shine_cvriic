<?php
	session_start();
	include("../config/config.php");
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
				        <h1 class="app-page-title mb-0">HEI RESEACHERS</h1>
				    </div>
				    <div class="col-auto">
					    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">

						    <div class="col-auto">
							    <button class="btn app-btn-primary" data-bs-toggle="modal" data-bs-target="#addHEI"><span class="fa fa-user"></span> Add New</button>
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
											<th class="cell">Type</th>
											<th class="cell">Name of Institution</th>
											<th class="cell">Years</th>
											<th class="cell">Expertise</th>
											<th class="cell">R & D Engagement</th>
											<th class="cell">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$get_profile = "SELECT * FROM tbl_cat_hei
											INNER JOIN tbl_client_profiles ON tbl_client_profiles.personnel_id = tbl_cat_hei.personnel_id
											INNER JOIN tbl_institutions ON tbl_institutions.institution_id = tbl_cat_hei.institution_id
											INNER JOIN tbl_institutions_campuses ON tbl_institutions_campuses.campus_id = tbl_cat_hei.campus_id
											ORDER BY tbl_client_profiles.lastname ASC";
											$get_query = $conn->query($get_profile);
											$get_count = $get_query->num_rows;

											if($get_count >= 1) {
												while($row = $get_query->fetch_array()) {
													$industry = $row['industry'];
													$sector = $row['sector'];
													$institution_type = $row['institution_type'];
													$institution = $row['institution_name'];
													$campus = $row['campus_name'];
													$years_op = $row['years_op'];
													$expertise = $row['expertise'];
													$rd_engagement = $row['rd_engagement'];
													$firstname = $row['firstname'];
													$lastname = $row['lastname'];

													if($campus != "") {
														$college = "$institution - $campus Campus";
													} else {
														$college = "$institution";
													}

													echo "<tr>
															<td>$lastname, $firstname</td>
															<td>$industry</td>
															<td>$sector</td>
															<td>$institution_type</td>
															<td>$college</td>
															<td>$years_op</td>
															<td>$expertise</td>
															<td>$rd_engagement</td>
															<td>
																<button type='button' class='btn btn-warning btn-sm text-white  edit_profile'><i class='fa fa-edit'></i></button>
																<button type='button' class='btn btn-danger btn-sm text-white  del_profile'><i class='fa fa-trash'></i></button>
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
	<script src="js/client-profile.js"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
	<script src="js/sweetalert/sweetalert.min.js"></script>
	<script src="assets/bootstrap-3-typeahead/bootstrap3-typeahead.min.js"></script>
	<!-- include summernote css/js -->
	<script src="assets/summernote/summernote-lite.min.js"></script>
</body>
</html> 

<script type="text/javascript">
	$(document).ready(function() {
	    $('#example').DataTable();

		$('#summernote').summernote({
			tabsize: 2,
			height: 120,
			toolbar: [
				['style', ['style']],
				['font', ['bold', 'underline', 'clear']],
				['color', ['color']],
				['para', ['ul', 'ol', 'paragraph']],
				['table', ['table']],
				['insert', ['link', 'picture', 'video']],
				['view', ['fullscreen', 'codeview', 'help']]
			]
		});
	});
	
</script>


<div class="modal fade in" id="addHEI" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
    	<form id="hei_client_form" method="POST">
			<div class="modal-header bg-info">
				<h4 class="modal-title">Add New HEI Personnel</h4>
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
			    <div class="row mb-4">
						<div class="col-md-3">
							<label class="form-label h6">Industry</label>
							<select class="form-select" id="industry" name="industry" required>
						      	<option value="">---</option>
						      	<option value='Academic'>Academic</option>
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
				<div class="row mb-4">
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
					<div class="col-md-5">
						<label class="form-label h6">Institution</label>
						<select class="form-select" id="institution" name="institution" required>
					      	<option value="">---</option>
					      	<?php 
					      		$school = "SELECT * FROM tbl_institutions ORDER BY institution_name ASC";
					      		$exe = $conn->query($school);
					      		$ctr = $exe->num_rows;

					      		if($ctr >= 1) {
					      			while($row = $exe->fetch_array()) {
					      				$institution_id = $row['institution_id'];
					      				$institution_name = $row['institution_name'];

					      				echo "<option value='$institution_id'>$institution_name</option>";
					      			}
					      		}
					      	?>
					    </select>
					</div>
					<div class="col-md-4">
						<label class="form-label h6">Campus</label>
						<select class="form-select" id="campus" name="campus" disabled>
					      	<option value="">---</option>
					    </select>
					</div>
					<div class="col-md-3">
						<label class="form-label h6">Number of Years</label>
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
						<label class="form-label h6">Fields of Expertise</label>
						<input type="text" class="form-control" id="expertise" name="expertise" required>
					</div>
				</div>
				<div class="row mb-3">
					<div class="col">
						<label class="form-label h6">Current R & D Engagement</label>
						<textarea id="summernote" class="form-control" name="rd_engagement" style="height:80px;"></textarea>
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<input type='hidden' id="clientid" name="clientid" value="" readonly>	
				<button type="submit" id="save_client" class="btn btn-danger text-white"><span class="fa fa-save"></span> Save</button>
				<button type="button"  class="btn btn-secondary close_modal" data-bs-dismiss="modal">Close</button>
			</div>
  		</form>
    </div>
  </div>
</div>

