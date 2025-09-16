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
			    <button class="btn app-btn-primary" data-bs-toggle="modal" data-bs-target="#addCategory"><span class="fa fa-plus"></span> Add Category</button>
		    </div>
	    </div><!--//row-->
    </div><!--//table-utilities-->
</div><!--//row-->

<div class="row g-4">
<?php
	$checkstr = "SELECT * FROM tbl_categories ORDER BY category_name ASC";
	$checkqry = $conn->query($checkstr);
	$counter = $checkqry->num_rows;

	if($counter >= 1) {
		while($row = $checkqry->fetch_array()) {
			$category_id = $row['category_id'];
			$category_name = $row['category_name'];
?>
    <div class="col-6 col-md-5 col-xl-4 col-xxl-3" id="reloadContent">
	    <div class="app-card app-card-doc shadow-sm h-100">
		    <div class="app-card-thumb-holder p-3">
			    <span class="icon-holder">
                    <i class="fas fa-file-alt text-file"></i>
                </span>
                <div class="app-card-thumb">
                    <img class="thumb-image" src="assets/images/categories.png" alt="">
                </div>
		    </div>
		    <div class="app-card-body p-3 has-card-actions">
			    
			    <h5 class=""><a href="#file-link"><?php echo $category_name; ?></a></h5>
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
						    <li><a class="dropdown-item" href="#"><i class="fa fa-eye me-2"></i>View</a></li>
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
	}
}
?>
</div><!--//row-->