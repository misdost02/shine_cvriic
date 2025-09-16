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
				        <h1 class="app-page-title mb-0">Categories</h1>
				    </div>
				    <div class="col-auto">
					    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">

						    <div class="col-auto">
							    <button class="btn app-btn-primary" data-bs-toggle="modal" data-bs-target="#addCategory"><span class="fa fa-plus"></span> Add Category</button>
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
											<th class="cell">Caterogy ID</th>
											<th class="cell">Category Name</th>
											<th class="cell">Token</th>
											<th class="cell">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$checkstr = "SELECT * FROM tbl_categories ORDER BY category_id ASC";
												$checkqry = $conn->query($checkstr);
												$counter = $checkqry->num_rows;

												if($counter >= 1) {
													while($row = $checkqry->fetch_array()) {
														$category_id = $row['category_id'];
														$category_name = $row['category_name'];
														$category_token= $row['category_token'];

													echo "<tr>
															<td>$category_id</td>
															<td>$category_name</td>
															<td>$category_token</td>
															<td>
																<button type='button' class='btn btn-warning text-white btn-sm edit_category'><i class='fa fa-edit'></i></button>
																<button type='button' class='btn btn-danger text-white btn-sm del_category'><i class='fa fa-trash'></i></button>
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
	 <script src="js/category.js" type="text/javascript"></script>

      <script src="js/sweetalert/sweetalert.min.js"></script>

</body>
</html> 

<script type="text/javascript">
	$(document).ready(function() {
	    $('#example').DataTable();
	})
</script>


<div class="modal" id="addCategory" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-md  modal-dialog-centered">
    <div class="modal-content">
    	<form class="" id="saveCategory" method="POST">
			<div class="modal-header">
				<h4 class="modal-title">Add Category</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>
			<div class="modal-body">
				<div class="alert alert-info text-center" style="display:none;" id="message"><span><strong>Warning!</strong> Category is already exists. Please try another one.</span></div>
			    <div class="col-auto my-3">
			    	<label class="form-label h6">Enter Category Name:</label>
			        <input type="text" id="category" name="category" class="form-control" required>
			    </div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-danger"><span class="fa fa-save"></span> Save</button>
				<button type="button"  class="btn btn-secondary" onClick="window.location.href=window.location.href">Close</button>
			</div>
  		</form>
    </div>
  </div>
</div>
