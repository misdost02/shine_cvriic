<?php
	session_start();
	include("../config/config.php");
	include("controller/config-session.php");
	$active = 8;
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
				        <h1 class="app-page-title mb-0">User Accounts</h1>
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
											<th class="cell">User ID</th>
											<th class="cell">Photo</th>
											<th class="cell">Full Name</th>
											<th class="cell">Email Address</th>
											<th class="cell">Desgination</th>
											<th class="cell">User Level</th>
											<th class="cell">Pass Code</th>
											<th class="cell">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$checkstr = "SELECT * FROM tbl_admin_users ORDER BY id ASC";
												$checkqry = $conn->query($checkstr);
												$counter = $checkqry->num_rows;

												if($counter >= 1) {
													while($row = $checkqry->fetch_array()) {
														$id = $row['id'];
														$full_name = $row['full_name'];
														$user_email= $row['user_email'];
														$designation= $row['designation'];
														$level_user= $row['level_user'];
														$pass_code= $row['pass_code'];
														$photo = $row['photo'];

														if($level_user == 1) {
															$type = "Super admin";
														} else {
															$type = "Data Encoder";
														}

														if($photo != "") {
															$profile_pic = $photo;
														} else {
															$profile_pic = "no-photo.jpg";
														}

													echo "<tr>
															<td>$id</td>
															<td width='8%'><img src='assets/images/profiles/$profile_pic' class='img-fluid rounded-circle'/></td>
															<td>$full_name</td>
															<td>$user_email</td>
															<td>$designation</td>
															<td>$type</td>
															<td><button type='button' class='btn btn-secondary text-white btn-sm password_show' id='$id' data-id='$pass_code' title='Show Password'><i class='fa fa-eye'></i></button> <button type='button' class='btn btn-info text-white btn-sm password_reset' id='$id' title='Reset Password'><i class='fa fa-sync'></i></button></td>
															<td>
																<button type='button' class='btn btn-warning text-white btn-sm edit_user' id='$id' title='Edit Account'><i class='fa fa-edit'></i></button>
																<button type='button' class='btn btn-danger text-white btn-sm del_user' id='$id' title='Deactivate Account'><i class='fa fa-trash'></i></button>
																<label class='btn btn-sm btn-info btn-upload mb-0 text-white' title='Upload Photo'>
										                          <input type='file' class='sr-only upload_image' name='upload_image' id='$id' accept='.jpg,.jpeg,.png' />
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


<div class="modal" id="addUserAccount" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-md  modal-dialog-centered">
    <div class="modal-content">
    	<form class="" id="user_account_form" method="POST">
			<div class="modal-header">
				<h4 class="modal-title">Add User Account</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>
			<div class="modal-body">
			    <div class="col-auto my-3">
			    	<label class="form-label h6">Full Name:</label>
			        <input type="text" id="full_name" id="full_name" class="form-control" required>
			    </div>
				<div class="col-auto my-3">
			    	<label class="form-label h6">Designation:</label>
			        <input type="text" id="designation" name="designation" class="form-control" required>
			    </div>
				<div class="col-auto my-3">
			    	<label class="form-label h6">User Level:</label>
			        <select class="form-select" id="user_level" name="user_level" id="user_level" required>
						<option value="">---</option>
						<option value='1'>Super Admin</option>
						<option value='0'>Data Encoder</option>
					</select>
			    </div>
				<div class="col-auto my-3">
			    	<label class="form-label h6">Active Email Address:</label>
			        <input type="text" id="email_address" name="email_address" class="form-control" required>
			    </div>
				<div class="col-auto my-3">
			    	<label class="form-label h6">Password:</label>
			        <input type="password" id="pass_word" name="pass_word" class="form-control" required>
			    </div>
				<div class="col-auto my-3">
			    	<label class="form-label h6">Re-type Password:</label>
			        <input type="password" id="re_password" name="re_password" class="form-control" required>
			    </div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-danger" id='save_account'><span class="fa fa-save"></span> Save</button>
				<button type="button"  class="btn btn-secondary close_modal">Close</button>
			</div>
  		</form>
    </div>
  </div>
</div>


<div class="modal" id="passwordReset" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-sm  modal-dialog-centered">
    <div class="modal-content">
    	<form class="" id="user_reset_form" method="POST">
			<div class="modal-header">
				<h4 class="modal-title">Password Reset</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>
			<div class="modal-body">
				<div class="col-auto my-3">
			    	<label class="form-label h6">Account ID</label>
			        <input type="text" id="account_id" name="account_id" class="form-control" required readonly>
			    </div>
				<div class="col-auto my-3">
			    	<label class="form-label h6">Password:</label>
			        <input type="password" id="pword" name="pword" class="form-control" required>
			    </div>
				<div class="col-auto my-3">
			    	<label class="form-label h6">Re-type Password:</label>
			        <input type="password" id="repass_word" name="repass_word" class="form-control" required>
			    </div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-danger" id='save_password'><span class="fa fa-save"></span> Udpate</button>
				<button type="button"  class="btn btn-secondary close_modal">Close</button>
			</div>
  		</form>
    </div>
  </div>
</div>


<div class="modal" id="showPassword" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-md  modal-dialog-centered">
    <div class="modal-content">
    	<form class="" id="user_reset_form" method="POST">
			<div class="modal-body bg-warning">
				<div class="col-auto my-3 text-center">
			    	<label class="form-label display-3" id="passcode"></label>
			    </div>
			</div>
			<div class="modal-footer">
				<button type="button"  class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			</div>
  		</form>
    </div>
  </div>
</div>


<div class="modal fade" id="uploadimageModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="member_photo" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content">
    
      <div class="modal-header bg-info">
        <h4 class="modal-title">Upload Profile Photo</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body py-4 px-3">
        <div class="col-md-12 text-center">
          <div id="image_demo" style="width:100%;margin-top:30px"></div>
          <input type='hidden' id="accountid" readonly>
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
      $('#accountid').val($(this).attr('id'));
      $('#uploadimageModal').modal('show');

    });

    $('.crop_image').click(function(event) {
      $("#uploading").addClass("fa fa-circle-o-notch fa fa-spin").html("");
      $image_crop.croppie('result', {
        type: 'canvas',
        size: 'viewport'
      }).then(function(response) {
      	var accountid = $('#accountid').val();

        $.ajax({
          url: "controller/add-account.php",
          type: "POST",
          data: {member_image: response, accountid: accountid},
          success: function(data) {
            $('#uploadimageModal').modal('hide');

            if(data == 1) {
                swal({
                    title: 'Success',
                    text: 'Profile Photo successfully uploaded.',
                    icon: 'success',
                    buttons: false,
                    closeOnClickOutside: false,
                    closeOnEsc: false,
                    timer: 2000
                }).then(function() {
                    window.location.reload();
                })
            }
            if(data == 0) {
                swal({
                    title: 'Warning',
                    text: 'Profile Photo not uploaded. Please try again.',
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