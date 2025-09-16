<?php
	session_start();
	include("../config/config.php");
	include("controller/config-session.php");
	$active = 4;
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
				        <h1 class="app-page-title mb-0">NEWS ARTICLES</h1>
				    </div>
				    <div class="col-auto">
					    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">

						    <div class="col-auto">
							    <button class="btn app-btn-primary" data-bs-toggle="modal" data-bs-target="#addNews"><span class="fa fa-user"></span> Add New Article</button>
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
													<th class="cell">News ID</th>
													<th class="cell">News Photo</th>
													<th class="cell">Title</th>
													<th class="cell" width="50%">News Article</th>
													<th class="cell">Author Uploader</th>
													<th class="cell">Date Uploaded</th>
													<th class="cell">Action</th>
												</tr>
											</thead>
											<tbody>
												<?php
													$get_news = "SELECT * FROM tbl_news_articles
														ORDER BY news_id DESC";
													$get_query = $conn->query($get_news);
													$get_count = $get_query->num_rows;

													if($get_count >= 1) {
														while($row = $get_query->fetch_array()) {
															$news_id = $row['news_id'];
															$news_title = $row['news_title'];
															$news_article = substr($row['news_article'], 0, 300);
															$news_photo = $row['news_photo'];
															$news_author = $row['news_author'];
															$news_date = $row['news_date'];
															$news_counter = $row['news_counter'];
															$news_photo = $row['news_photo'];
															$news_status = $row['news_status'];
															$token_id = $row['token_id'];
															
															if($news_id == "") {
																$disable = "$disabled";
															} else {
																$disable = "";
															}

															if($news_photo == "") {
																$foto = "<img src='../images/news-photo/no-photo.jpg' class='img-fluid' width='150px'>";
															} else {
																$foto = "<img src='../images/news-photo/$news_photo' class='img-fluid' width='150px'>";
															}

															echo "<tr>
																	<td>$news_id</td>
																	<td>$foto</td>
																	<td>$news_title</td>
																	<td>$news_article...</td>
																	<td>$news_author</td>
																	<td>$news_date</td>
																	<td>
																		<button type='button' class='btn btn-warning text-white btn-sm edit_news'><i class='fa fa-edit'></i></button>
																		<button type='button' class='btn btn-danger text-white btn-sm del_news'><i class='fa fa-trash'></i></button>
																		<label class='btn btn-sm btn-info btn-upload mb-0 text-white' title='Upload Photo Article'>
												                          <input  $disable type='file' class='sr-only upload_image' name='upload_image' id='$news_id' accept='.jpg,.jpeg,.png' />
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
      
      <script src="js/news-article.js"></script>
      <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
      <script src="assets/js/jquery-3.6.0.min.js"></script>
      <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
      <script src="js/sweetalert/sweetalert.min.js"></script>
      <script src="js/croppie.js"></script>
	  <script src="assets/summernote/summernote-lite.min.js"></script>
</body>
</html> 

<script type="text/javascript">
	$(document).ready(function() {
	    $('#example').DataTable();

		$('#summernote').summernote({
			tabsize: 2,
			height: 320,
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

<div class="modal fade in" id="addNews" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
    	<form id="article_form" method="POST">
			<div class="modal-header bg-info">
				<h4 class="modal-title">Add News Article</h4>
				<!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
			</div>
			<div class="modal-body">
				<div class="row mb-3">
					<div class="col">
						<label class="form-label h6">News Title</label>
						<input type="text" class="form-control" id="news_title" name="news_title" required>
					</div>
				</div>
			   <div class="row mb-3">
					<div class="col-sm-12">
						<label class="form-label h6">News Article</label>
						<textarea style="height:300px;" class="form-control"  id="summernote" name="news_article" required></textarea>
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<input type='hidden' id="news_id" name="news_id" value="" readonly>
				<button type="submit" id="save_news" class="btn btn-danger text-white"><span class="fa fa-save"></span> Save</button>
				<button type="button"  class="btn btn-secondary close_modal" data-bs-dismiss="modal">Close</button>
			</div>
  		</form>
    </div>
  </div>
</div>

<div class="modal fade" id="uploadimageModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="member_photo" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
    
      <div class="modal-header bg-info">
        <h4 class="modal-title">Upload Article Photo</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body py-0 px-0">
        <div class="col-md-12 text-center">
          <div id="image_demo" style="width:100%;margin-top:10px"></div>
          <input type='hidden' id="news_id" readonly>
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
        width: 1020,
        height: 600,
        type: 'square' //circle
      },
      boundary: {
        width: 1050,
        height: 620
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
      $('#news_id').val($(this).attr('id'));
      $('#uploadimageModal').modal('show');

    });

    $('.crop_image').click(function(event) {
      $("#uploading").addClass("fa fa-circle-o-notch fa fa-spin").html("");
      $image_crop.croppie('result', {
        type: 'canvas',
        size: 'viewport'
      }).then(function(response) {
      	var news_id = $('#news_id').val();
      	//alert(news_id);
        $.ajax({
          url: "controller/save-news.php",
          type: "POST",
          data: {news_image: response, news_id: news_id},
          success: function(data) {
            $('#uploadimageModal').modal('hide');

            if(data == 1) {
                swal({
                    title: 'Success',
                    text: 'Photo article successfully uploaded.',
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
                    text: 'Photo article not uploaded. Please try again.',
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