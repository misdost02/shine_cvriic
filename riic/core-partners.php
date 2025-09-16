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
<link rel="stylesheet" href="js/croppie.min.css"/>
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
				        <h1 class="app-page-title mb-0">CORE PARTNERS</h1>
				    </div>
				    <div class="col-auto">
					    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">

						    <div class="col-auto">
							    <button class="btn app-btn-primary" data-bs-toggle="modal" data-bs-target="#addPartner"><span class="fa fa-user"></span> Add New Partner</button>
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
													<th class="cell">Partner ID</th>
													<th class="cell">Partner Logo</th>
													<th class="cell">Partner Name</th>
													<th class="cell">Partner Official Website or Portal</th>
													<th class="cell">Action</th>
												</tr>
											</thead>
											<tbody>
												<?php
													$get_data = "SELECT * FROM tbl_core_partners ORDER BY partner_id DESC";
													$get_query = $conn->query($get_data);
													$get_count = $get_query->num_rows;

													if($get_count >= 1) {
														while($row = $get_query->fetch_array()) {
															$partner_id = $row['partner_id'];
															$partner_name = $row['partner_name'];
															$partner_logo = $row['partner_logo'];
															$partner_website = $row['partner_website'];

															if($partner_id == "") {
																$disable = "$disabled";
															} else {
																$disable = "";
															}

															if($partner_logo == "") {
																$foto = "<img src='../images/core-partners/no-photo.jpg' class='img-fluid' width='150px'>";
															} else {
																$foto = "<img src='../images/core-partners/$partner_logo' class='img-fluid' width='150px'>";
															}

															echo "<tr>
																	<td>$partner_id</td>
																	<td>$foto</td>
																	<td>$partner_name</td>
																	<td>$partner_website</td>
																	<td>
																		<button type='button' class='btn btn-warning text-white btn-sm edit_data'><i class='fa fa-edit'></i></button>
																		<button type='button' class='btn btn-danger text-white btn-sm del_data'><i class='fa fa-trash'></i></button>
																		<label class='btn btn-sm btn-info btn-upload mb-0 text-white' title='Upload Photo Article'>
								                        <input  $disable type='file' class='sr-only upload_image' name='upload_image' id='$partner_id' accept='.jpg,.jpeg,.png' />
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
      
      <script src="js/misc.js"></script>
      <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
      <script src="assets/js/jquery-3.6.0.min.js"></script>
      <script src="js/croppie.min.js"></script>
      <!-- <script src="js/croppie.min.js"></script> -->
      <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
      <script src="js/sweetalert/sweetalert.min.js"></script>
      
</body>
</html> 

<script type="text/javascript">
	$(document).ready(function() {
	    $('#example').DataTable();
	})
</script>

<div class="modal fade in" id="addPartner" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
    	<form id="partner_form" method="POST">
			<div class="modal-header bg-info">
				<h4 class="modal-title">Add Partner</h4>
				<!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
			</div>
			<div class="modal-body">
				<div class="row mb-3">
					<div class="col">
						<label class="form-label h6">Name of Partner</label>
						<input type="text" class="form-control" id="partner_name" name="partner_name" required>
					</div>
				</div>
				<div class="row mb-3">
					<div class="col">
						<label class="form-label h6">Partner Active Website or Portal</label>
						<input type="url" class="form-control" id="partner_website" name="partner_website" required>
					</div>
				</div>
				<div class="row mb-3">
					<div class="col">
						<label class="form-label h6">Official Contact Info</label>
						<input type="text" class="form-control" id="partner_contact" name="partner_contact">
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<input type='hidden' id="partnerid" name="partnerid" value="" readonly>
				<button type="submit" id="save_partner" class="btn btn-danger text-white"><span class="fa fa-save"></span> Save</button>
				<button type="button"  class="btn btn-secondary close_modal" data-bs-dismiss="modal">Close</button>
			</div>
  		</form>
    </div>
  </div>
</div>

<div class="modal fade" id="uploadimageModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="partner_logo" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content">
    
      <div class="modal-header bg-info">
        <h4 class="modal-title">Upload Partner Logo</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body py-0 px-0">
        <div class="col-md-12 text-center">
          <div id="image_demo" style="width:100%;margin-top:10px"></div>
          <input type='hidden' id="partner_id" readonly>
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
        width: 450,
        height: 450,
        type: 'square' //circle
      },
      boundary: {
        width: 480,
        height: 480
      },
      showZoomer: true,
	    enableResize: true,
	    enableOrientation: true,
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
      $('#partner_id').val($(this).attr('id'));
      $('#uploadimageModal').modal('show');

    });

    $('.crop_image').click(function(event) {
      $("#uploading").addClass("fa fa-circle-o-notch fa fa-spin").html("");
      $image_crop.croppie('result', {
        type: 'canvas',
        size: 'viewport',
        showZoomer: false,
		    enableResize: true,
		    enableOrientation: true,
      }).then(function(response) {
      	var partner_id = $('#partner_id').val();
      	//alert(news_id);
        $.ajax({
          url: "controller/save-misc.php",
          type: "POST",
          data: {partner_image: response, partner_id: partner_id},
          success: function(data) {
            $('#uploadimageModal').modal('hide');

            if(data == 1) {
                swal({
                    title: 'Success',
                    text: 'Partner Logo successfully uploaded.',
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
                    text: 'Partner Logo not uploaded. Please try again.',
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