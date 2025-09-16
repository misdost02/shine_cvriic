<?php
	session_start();
	include("../config/config.php");
	include("controller/config-session.php");
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
<link rel="stylesheet" href="js/croppie.css"/>
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
				        <h1 class="app-page-title mb-0">Regional Offices</h1>
				    </div>
				    <div class="col-auto">
					    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
						    
						    <div class="col-auto">
							    <button class="btn app-btn-primary" data-bs-toggle="modal" data-bs-target="#addOffice"><span class="fa fa-plus"></span> Add New Office</button>
							    <button class="btn app-btn-secondary" data-bs-toggle="modal" data-bs-target="#addOfficer"><span class="fa fa-user"></span> Add Regional Officer</button>
						    </div>
					    </div><!--//row-->
				    </div><!--//table-utilities-->
						</div><!--//row-->
							<div class="row g-4">
								<div class="app-card app-card-orders-table shadow-sm mb-5">
								    <div class="app-card-body">
									    <div class="table-responsive">
									        <table class="table app-table-hover mb-0 text-left" id="example">
												<thead>
													<tr>
														<th class="cell">Officer ID</th>
														<th class="cell">Fullname</th>
														<th class="cell">Name of Office</th>
														<th class="cell">Address</th>
														<th class="cell">Email</th>
														<th class="cell">Contact</th>
														<th class="cell">Action Taken</th>
													</tr>
												</thead>
												<tbody>
													<?php
														$ofisstr = "SELECT officer_id, officer_fullname, office_name, office_address, office_email, office_contact FROM tbl_regional_lines
															INNER JOIN tbl_regional_offices ON tbl_regional_lines.office_id = tbl_regional_offices.office_id
															ORDER BY tbl_regional_lines.officer_fullname ASC";
														$ofisqry = $conn->query($ofisstr);
														$ofisctr = $ofisqry->num_rows;

														if($ofisctr >= 1) {
															while($row = $ofisqry->fetch_array()) {
																$officer_id = $row['officer_id'];
																$officer_fullname = $row['officer_fullname'];
																$office_name = $row['office_name'];
																$office_address = $row['office_address'];
																$office_email = $row['office_email'];
																$office_contact = $row['office_contact'];
																
																echo "
																			<tr>
																				<td class='cell'>$officer_id</td>
																				<td class='cell'>$officer_fullname</td>
																				<td class='cell'>$office_name</td>
																				<td class='cell'>$office_address</td>
																				<td class='cell'>$office_email</td>
																				<td class='cell'>$office_contact</td>
																				<td class='cell'>
																					<button type='button' class='btn btn-warning text-white btn-sm edit_office'><i class='fa fa-edit'></i></button>
																					<button type='button' class='btn btn-danger text-white btn-sm del_office'><i class='fa fa-trash'></i></button>
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
      
      <script src="js/offices.js"></script>
      <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
      <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
      <script src="js/sweetalert/sweetalert.min.js"></script>
	  <script src="assets/bootstrap-3-typeahead/bootstrap3-typeahead.min.js"></script>														
      <script src="js/croppie.js"></script>
      <!-- <script src="js/croppie.min.js"></script> -->
      
</body>
</html> 

<script type="text/javascript">
	$(document).ready(function() {
	    $('#example').DataTable();
	})
</script>


<div class="modal" id="addOffice" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-md  modal-dialog-centered">
    <div class="modal-content">
    	<form class="" id="office_form" method="POST">
			<div class="modal-header bg-info">
				<h4 class="modal-title">Add New Office</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>
			<div class="modal-body">
			    <div class="col-auto">
			    	<label class="form-label h6">Office Name <small>(example: Department of Science and Technology)</small></label>
			        <input type="text" id="officeName" name="officeName" class="form-control" required>
			    </div>
			    <div class="col-auto">
			    	<label class="form-label h6"><small>Office Code (example: DOST)</small></label>
			        <input type="text" id="officeCode" name="officeCode" class="form-control" required>
			    </div>
			    <div class="col-auto">
			    	<label class="form-label h6">Address</label>
			        <input type="text" id="officeAddress" name="officeAddress" class="form-control" required>
			    </div>
			    <div class="col-auto">
			    	<label class="form-label h6">Email Address</label>
			        <input type="email" id="officeEmail" name=officeEmail" class="form-control" required>
			    </div>
			    <div class="col-auto">
			    	<label class="form-label h6">Contact Number</label>
			        <input type="text" id="officeContact" name="officeContact" class="form-control" required>
			    </div>
			</div>
			<div class="modal-footer">
				<button type="submit" id="save_office" class="btn btn-danger text-white"><span class="fa fa-save"></span> Save</button>
				<button type="button"  class="btn btn-secondary" onClick="window.location.href=window.location.href">Close</button>
			</div>
  		</form>
    </div>
  </div>
</div>


<div class="modal" id="addOfficer" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-md  modal-dialog-centered">
    <div class="modal-content">
    	<form class="" id="officer_form" method="POST">
				<div class="modal-header">
					<h4 class="modal-title">Add New Officer</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
				<div class="modal-body">
					<div class="col-auto  mb-3">
						<label class="form-label h6">Select Office:</label>
						<select class="form-select" id='officeID' name="officeID" required>
							<option value="">--Select one--</option>
							<?php 
								$checkstr = "SELECT * FROM tbl_regional_offices ORDER BY office_name ASC";
								$checkqry = $conn->query($checkstr);
								$counter = $checkqry->num_rows;

								if($counter >= 1) {
									while($row = $checkqry->fetch_array()) {
										$office_id = $row['office_id'];
										$office_name = $row['office_name'];

										echo "<option value='$office_id'>$office_name</option>";
									}
								}
							?>
						</select>
					</div>

				    <div class="col-auto mb-3">
				    	<label class="form-label h6">Name of Officer:</label>
				        <input type="text" id="fullname" name="officerName" class="form-control input-sm" required>
				    </div>
					<div class="col-md-3">
						<label class="form-label h6">Personnel ID</label>
						<input type="text" class="form-control" id="personnel_id" name="personnel_id" required readonly>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" id="save_officer" class="btn btn-danger text-white"><span class="fa fa-save"></span> Save</button>
					<button type="button"  class="btn btn-secondary" onClick="window.location.href=window.location.href">Close</button>
				</div>
  		</form>
    </div>
  </div>
</div>