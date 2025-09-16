<div class="row g-3 mb-4 align-items-center justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">Categories</h1>
    </div>
    <div class="col-auto">
	    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
		    <div class="col-auto">
			    <form class="docs-search-form row gx-1 align-items-center">
                    <div class="col-auto">
                        <input type="text" id="search-docs" name="searchdocs" class="form-control search-docs" placeholder="Search">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn app-btn-secondary">Search</button>
                    </div>
                </form>
		    </div><!--//col-->
		    <div class="col-auto">
			    <select class="form-select w-auto">
					  <option selected="" value="option-1">All</option>
					  <option value="option-2">Text file</option>
					  <option value="option-3">Image</option>
					  <option value="option-4">Spreadsheet</option>
					  <option value="option-5">Presentation</option>
					  <option value="option-6">Zip file</option>
				</select>
		    </div>
		    <div class="col-auto">
			    <button class="btn app-btn-primary" data-bs-toggle="modal" data-bs-target="#addIndustry"><span class="fa fa-plus"></span> Add Industry Category</button>
		    </div>
	    </div><!--//row-->
    </div><!--//table-utilities-->
</div><!--//row-->

<div class="row g-4">
<?php
	$checkstr = "SELECT * FROM tbl_industries_category ORDER BY industry_name ASC";
	$checkqry = $conn->query($checkstr);
	$counter = $checkqry->num_rows;

	if($counter >= 1) {
		while($row = $checkqry->fetch_array()) {
			$industry_id = $row['industry_id'];
			$industry_name = $row['industry_name'];
?>
    <div class="col-6 col-md-5 col-xl-4 col-xxl-3">
	    <div class="app-card app-card-doc shadow-sm h-100">
		    <div class="app-card-thumb-holder p-3">
			    <span class="icon-holder">
                    <i class="fas fa-file-alt text-file"></i>
                </span>
                <div class="app-card-thumb">
                    <img class="thumb-image" src="assets/images/databases/industries.jpg" alt="">
                </div>
		    </div>
		    <div class="app-card-body p-3 has-card-actions">
			    
			    <h5 class=""><a href="#file-link"><?php echo $industry_name; ?></a></h5>
			    <div class="app-doc-meta">
				    <ul class="list-unstyled mb-0">
					    <li><span class="text-muted">Type:</span> Text</li>
					    <li><span class="text-muted">Size:</span> 512KB</li>
					    <li><span class="text-muted">Uploaded:</span> 3 mins ago</li>
				    </ul>
			    </div><!--//app-doc-meta-->
			    
			    <div class="app-card-actions">
				    <div class="dropdown">
					    <div class="dropdown-toggle no-toggle-arrow" data-bs-toggle="dropdown" aria-expanded="false">
						    <svg class="fa fa-ellipsis-v"></svg>
					    </div><!--//dropdown-toggle-->
					    <ul class="dropdown-menu">
					    	<li><a class="openModal dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#addSubIndustry" data-id="<?php echo $industry_id;?>"><i class="fa fa-plus me-2"></i>Add Subcategory</a></li>
					    	<li><hr class="dropdown-divider"></li>
						    <li><a class="view_data dropdown-item" style="cursor:pointer;" data-id="<?php echo $industry_id;?>" id="<?php echo $industry_id; ?>"><i class="fa fa-eye me-2"></i>View</a></li>
							<li><a class="dropdown-item" href="#"><i class="fa fa-edit me-2"></i>Edit</a></li>
							<li><a class="dropdown-item" href="#"><i class="fa fa-download me-2"></i>Download</a></li>
                            <li><hr class="dropdown-divider"></li>
							<li><a class="dropdown-item" href="#"><i class="fa fa-trash me-2"></i>Delete</a></li>
						</ul>
				    </div><!--//dropdown-->
		        </div><!--//app-card-actions-->
		    </div><!--//app-card-body-->
		</div><!--//app-card-->
    </div><!--//col-->

<?php
	}} else {
	?>
	<div class="alert alert-info text-center">
		<strong><span class="fa fa-info-circle"></span> INFO!</strong> No records to show or display this time.
	</div>
<?php
}

?>
</div><!--//row-->



<div class="modal" id="addIndustry" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-md  modal-dialog-centered">
    <div class="modal-content">
    	<form class="" id="saveIndustry" method="POST">
			<div class="modal-header">
				<h4 class="modal-title">Add Industry Category</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>
			<div class="modal-body">
				<div class="alert alert-info text-center" style="display:none;" id="message"></div>
			    <div class="col-auto my-3">
			    	<label class="form-label">Enter Industry Category:</label>
			        <input type="text" id="industryCategory" name="industryCategory" class="form-control" required>
			    </div>
			</div>
			<div class="modal-footer">
				<input type='text' id="databases" value="<?php echo $_GET['token'];?>" readonly>
				<button type="submit" class="btn btn-danger"><span class="fa fa-save"></span> Save</button>
				<button type="button"  class="btn btn-secondary" onClick="window.location.href=window.location.href">Close</button>
			</div>
  		</form>
    </div>
  </div>
</div>



<div class="modal" id="addSubIndustry" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-md  modal-dialog-centered">
    <div class="modal-content">
    	<form class="" id="saveSubIndustry" method="POST">
			<div class="modal-header">
				<h4 class="modal-title">Add Industry Sub-Category</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>
			<div class="modal-body">
				<div class="alert alert-info text-center" style="display:none;" id="message3"></div>
			    <div class="col-auto my-3">
			    	<input type="hidden" name="industryId" id="industryId" readonly/>
			    	<label class="form-label">Enter Industry Category:</label>
			        <input type="text" id="industrySubCategory" name="industrySubCategory" class="form-control" required>
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

<div class="modal" id="viewSubIndustry" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-lg  modal-dialog-centered">
    <div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title">Industry Sub-Categories</h4>
			<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
		</div>
		<div class="modal-body" id="industry_detail">
		</div>
		<div class="modal-footer">
			<input type="text" name="viewindustryId" id="viewindustryId" readonly/>
			<button type="button"  class="btn btn-secondary" onClick="window.location.href=window.location.href">Close</button>
		</div>
    </div>
  </div>
</div>

<script type="text/javascript">
	$(document).on("click", ".openModal", function () {
	     var industryId = $(this).data('id');
	     document.getElementById("industryId").value = industryId;
	});
</script>

<script>  
 $(document).ready(function(){  
      $('.view_data').click(function(){  
           var industry_id = $(this).attr("id");  
           document.getElementById("viewindustryId").value = industry_id;
           $.ajax({  
                url:"controller/databases/add-industry.php",  
                method:"POST",  
                data:{industry_id:industry_id},  
                success:function(data){  
                     $('#industry_detail').html(data);  
                     $('#viewSubIndustry').modal("show");  
                }  
           });  
      });  
 });  
 </script>