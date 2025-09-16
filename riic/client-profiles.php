<?php
	session_start();
	include("../config/config.php");
	include("controller/config-session.php");
	$active = 2;
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
				        <h1 class="app-page-title mb-0">CLIENT PROFILES</h1>
				    </div>
				    <div class="col-auto">
					    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">

						    <div class="col-auto">
							    <button class="btn app-btn-primary" data-bs-toggle="modal" data-bs-target="#addClient"><span class="fa fa-user"></span> Add New Client</button>
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
											<th class="cell">Designation</th>
											<th class="cell">Division or Unit</th>
											<!-- <th class="cell">Address</th> -->
											<!-- <th class="cell">Landline</th> -->
											<th class="cell">Mobile</th>
											<th class="cell">Email</th>
											<!-- <th class="cell">Website</th> -->
											<th class="cell">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$get_profile = "SELECT * FROM tbl_client_profiles WHERE status_id = '1'
												ORDER BY lastname ASC";
											$get_query = $conn->query($get_profile);
											$get_count = $get_query->num_rows;

											if($get_count >= 1) {
												while($row = $get_query->fetch_array()) {
													$firstname = $row['firstname'];
													$middlename = $row['middlename'];
													$lastname = $row['lastname'];
													$designation = $row['designation'];
													$division_unit = $row['division_unit'];
													$province = $row['province'];
													$town = $row['town'];
													$barangay = $row['barangay'];
													$landline = $row['landline'];
													$mobile = $row['mobile'];
													$email = $row['email'];
													$website = $row['website'];
													$personnel_id = $row['personnel_id'];


													echo "<tr>
															<td>$lastname, $firstname</td>
															<td>$designation</td>
															<td>$division_unit</td>
															
															<td>$mobile</td>
															<td>$email</td>
															<td>
																<button type='button' class='btn btn-warning text-white btn-sm edit_profile' id='$personnel_id'><i class='fa fa-edit'></i></button>
																<button type='button' class='btn btn-danger text-white btn-sm remove_profile' id='$personnel_id'><i class='fa fa-trash'></i></button>
																<label class='btn btn-sm btn-info btn-upload mb-0 text-white' title='Upload Photo'>
										                          <input type='file' class='sr-only upload_image' name='upload_image' id='$personnel_id' accept='.jpg,.jpeg,.png' />
										                          <span class='fa fa-image'></span>
										                        </label>
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

      <script src="js/croppie.js"></script>
      <!-- <script src="js/croppie.min.js"></script> -->
      
</body>
</html> 

<script type="text/javascript">
	$(document).ready(function() {
	    $('#example').DataTable();
	})
</script>

<div class="modal fade in" id="addClient" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
    	<form id="client_form" method="POST">
			<div class="modal-header bg-info">
				<h4 class="modal-title">Add New Client</h4>
				<!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
			</div>
			<div class="modal-body">
				<div class="alert alert-info text-center alert-dismissible" style="display:none;" id="message1"></div>
				<div class="row mb-3">
					<div class="col">
						<label class="form-label h6">Firstname:</label>
						<input type="text" class="form-control" id="firstname" name="firstname" required>
					</div>
					<div class="col">
						<label class="form-label h6">Middlename:</label>
						<input type="text" class="form-control" id="middlename" name="middlename">
					</div>
					<div class="col">
						<label class="form-label h6">Lastname:</label>
						<input type="text" class="form-control" id="lastname" name="lastname" required>
					</div>
				</div>
			    <div class="row mb-3">
					<div class="col">
						<label class="form-label h6">Designation:</label>
						<input type="text" class="form-control" id="designation" name="designation" required>
					</div>
					<div class="col">
						<label class="form-label h6">Division or Unit:</label>
						<input type="text" class="form-control" id="division_unit" name="division_unit">
					</div>
				</div>
			    <div class="row mb-3">
					<div class="col">
						<label class="form-label h6">Province:</label>
						<select class="form-select" id="province" name="province" onchange="getText(this)" required>
					      <option value="">Select</option>
					      <?php
					      	foreach ($prov as $field) {
                                echo "<option value='".$field['provCode']."'>".$field['provDesc']."</option>";
					      	}
					      ?>
					    </select>
					    <input type="hidden" name="permaprovincehidden" id="permaprovincehidden">
					    <script>
							function getText(element) {
								var textHolder = element.options[element.selectedIndex].text
								document.getElementById("permaprovincehidden").value = textHolder;
							}
						</script>
					</div>
					<div class="col">
						<label class="form-label h6">Town or Municipality:</label>
						<select class="form-select" id="town" name="town" onchange="getTown(this)" required disabled>
					      <option value="">Select</option>
					    </select>

					    <input type="hidden" name="permatownhidden" id="permatownhidden">

						<script>
							function getTown(element) {
								var textHolder = element.options[element.selectedIndex].text
								document.getElementById("permatownhidden").value = textHolder;
							}
						</script>
					</div>
					<div class="col">
						<label class="form-label h6">Barangay:</label>
						<select class="form-select" id="barangay" name="barangay" onchange="getBarangay(this)" disabled>
					      <option value="">Select</option>
					    </select>

					    <input type="hidden" name="permabrgyhidden" id="permabrgyhidden">

						<script>
							function getBarangay(element) {
								var textHolder = element.options[element.selectedIndex].text
								document.getElementById("permabrgyhidden").value = textHolder;
							}
						</script>
					</div>
				</div>
				<div class="row mb-3">
					<div class="col">
						<label class="form-label h6">Telephone or Landline Number</label>
						<input type="text" class="form-control" id="landline" name="landline">
					</div>
					<div class="col">
						<label class="form-label h6">Mobile or CP Number</label>
						<input type="text" class="form-control" id="mobile" name="mobile">
					</div>
				</div>
				<div class="row mb-3">
					<div class="col">
						<label class="form-label h6">Email Address</label>
						<input type="email" class="form-control" id="email" name="email">
					</div>
					<div class="col">
						<label class="form-label h6">Website</label>
						<input type="text" class="form-control" id="website" name="website">
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<input type='hidden' id="profile_clientid" name="profile_clientid" value="" readonly>
				<button type="submit" id="save_client" class="btn btn-success text-white"><span class="fa fa-save"></span> Save</button>
				<button type="button"  class="btn btn-secondary close_modal" data-bs-dismiss="modal">Close</button>
			</div>
  		</form>
    </div>
  </div>
</div>

<div class="modal fade" id="removeList" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="remove_list" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h4 class="modal-title">Remove List</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body py-4 px-3">
          <h4 class='text-center'>Would you like to remove this data?</h4>
      </div>
      <div class="modal-footer bg-light">
	  		<input type='hidden' id="delete_clientid" name="delete_clientid" value="" readonly>			
	  		<button type="button" id="remove_data" class="btn btn-success text-white"><span class="fa fa-check"></span> Yes</button>
			<button type="button" class="btn btn-secondary close_modal" data-bs-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="uploadimageModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="member_photo" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content">
    
      <div class="modal-header bg-info">
        <h4 class="modal-title">Upload Personnel Photo</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body py-4 px-3">
        <div class="col-md-12 text-center">
          <div id="image_demo" style="width:100%;margin-top:30px"></div>
          <input type='hidden' id="client_id" readonly>
        </div>
      </div>
      <div class="modal-footer bg-light">
        <button class="btn btn-success w-100 crop_image"><span id='uploading'> Crop & Upload Image</span></button>
      </div>
      
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $image_crop = $('#image_demo').croppie({
      enableExif: true,
      viewport: {
        width: 320,
        height: 320,
        type: 'square' //circle
      },
      boundary: {
        width: 410,
        height: 410
      }
    });

    $('.upload_image').on('change', function() {
        var reader = new FileReader();
        reader.onload = function(event) {
            $image_crop.croppie('bind', {
              url: event.target.result
            }).then(function() {
              console.log('jQuery bind complete');
            });
        }
      reader.readAsDataURL(this.files[0]);
      $('#client_id').val($(this).attr('id'));
      $('#uploadimageModal').modal('show');

    });

    $('.crop_image').click(function(event) {
      $("#uploading").addClass("fa fa-circle-o-notch fa fa-spin").html("");
      $image_crop.croppie('result', {
        type: 'canvas',
        size: 'viewport'
      }).then(function(response) {
      	var clientid = $('#client_id').val();

        $.ajax({
          url: "controller/save-client.php",
          type: "POST",
          data: {member_image: response, clientid: clientid},
          success: function(data) {
            $('#uploadimageModal').modal('hide');

            if(data == 1) {
                swal({
                    title: 'Success',
                    text: 'Photo successfully uploaded.',
                    icon: 'success',
                    buttons: false,
                    closeOnClickOutside: false,
                    closeOnEsc: false,
                    timer: 2000
                }).then(function() {
                    window.location.reload();
                })
            }
            if(data == 2) {
                swal({
                    title: 'Warning',
                    text: 'Photo not uploaded. Please try again.',
                    icon: 'error',
                    buttons: false,
                    closeOnClickOutside: false,
                    closeOnEsc: false,
                    timer: 2000
                })
            }
            $("#uploading").removeClass("fa fa-circle-o-notch fa fa-spin").html(
              "Crop & Upload Image");
          }
        });
      })
    });
  });
</script>