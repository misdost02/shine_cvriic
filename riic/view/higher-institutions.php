<div class="row g-3 mb-4 align-items-center justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">Regional Offices</h1>
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
			    <button class="btn app-btn-primary" data-bs-toggle="modal" data-bs-target="#addOffice"><span class="fa fa-plus"></span> Add New Office</button>
			    <button class="btn app-btn-secondary" data-bs-toggle="modal" data-bs-target="#addOfficer"><span class="fa fa-user"></span> Add Regional Officer</button>
		    </div>
	    </div><!--//row-->
    </div><!--//table-utilities-->
</div><!--//row-->

<div class="row g-4">
	<div class="app-card app-card-orders-table shadow-sm mb-5"  id="reloadContent">
	    <div class="app-card-body">
		    <div class="table-responsive">
		        <table class="table app-table-hover mb-0 text-left">
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
?>
						<tr>
							<td class="cell"><?php echo $officer_id; ?></td>
							<td class="cell"><?php echo $officer_fullname; ?></td>
							<td class="cell"><?php echo $office_name; ?></td>
							<td class="cell"><?php echo $office_address; ?></span></td>
							<td class="cell"><?php echo $office_email; ?></td>
							<td class="cell"><?php echo $office_contact; ?></td>
							<td class="cell"><a class="btn-sm app-btn-secondary" href="#">Edit</a></td>
						</tr>

<?php
	}
} else {
	?>
		<tr>
			<td class="cell"  colspan='7'>
				<div class='alert alert-danger text-center'><span class='fa fa-info-circle'></span> <strong>WARNING!</strong> No records to show or display.
			</td>
		</tr>
	<?php
}
?>
					</tbody>
				</table>
	        </div><!--//table-responsive-->
	       
	    </div><!--//app-card-body-->		
	</div><!--//app-card-->
	<nav class="app-pagination">
		<ul class="pagination justify-content-center">
			<li class="page-item disabled">
				<a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
		    </li>
			<li class="page-item active"><a class="page-link" href="#">1</a></li>
			<li class="page-item"><a class="page-link" href="#">2</a></li>
			<li class="page-item"><a class="page-link" href="#">3</a></li>
			<li class="page-item">
			    <a class="page-link" href="#">Next</a>
			</li>
		</ul>
	</nav><!--//app-pagination-->
</div><!--//row-->


<div class="modal" id="addOffice" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-md  modal-dialog-centered">
    <div class="modal-content">
    	<form class="" id="saveOffice" method="POST">
			<div class="modal-header">
				<h4 class="modal-title">Add New Office</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>
			<div class="modal-body">
				<div class="alert alert-info text-center alert-dismissible" style="display:none;" id="message1"></div>
			    <div class="col-auto">
			    	<label class="form-label">Office Name:</label>
			        <input type="text" id="officeName" name="officeName" class="form-control" required>
			    </div>
			    <div class="col-auto">
			    	<label class="form-label">Office Code (example: DOST):</label>
			        <input type="text" id="officeCode" name="officeCode" class="form-control" required>
			    </div>
			    <div class="col-auto">
			    	<label class="form-label">Address:</label>
			        <input type="text" id="officeAddress" name="officeAddress" class="form-control" required>
			    </div>
			    <div class="col-auto">
			    	<label class="form-label">Email Address:</label>
			        <input type="text" id="officeEmail" name="officeEmail" class="form-control" required>
			    </div>
			    <div class="col-auto">
			    	<label class="form-label">Contact Number:</label>
			        <input type="text" id="officeContact" name="officeContact" class="form-control" required>
			    </div>
			</div>
			<div class="modal-footer">
				<input type='text' id="databases" value="<?php echo $_GET['token'];?>" readonly>
				<button type="submit" id="submitOffice" class="btn btn-danger"><span class="fa fa-save"></span> Save</button>
				<button type="button"  class="btn btn-secondary" onClick="window.location.href=window.location.href">Close</button>
			</div>
  		</form>
    </div>
  </div>
</div>


<div class="modal" id="addOfficer" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-md  modal-dialog-centered">
    <div class="modal-content">
    	<form class="" id="saveOfficer" method="POST">
			<div class="modal-header">
				<h4 class="modal-title">Add New Officer</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>
			<div class="modal-body">
				<div class="alert alert-info text-center alert-dismissible" style="display:none;" id="message2"></div>
			    <div class="col-auto">
			    	<label class="form-label">Select Office:</label>
				    <select class="form-select" id='officeID' name="officeID" required>
						  <option value=""></option>
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

			    <div class="col-auto">
			    	<label class="form-label">Name of Officer:</label>
			        <input type="text" id="officerName" name="officerName" class="form-control input-sm" required>
			    </div>
			</div>
			<div class="modal-footer">
				<input type='text' id="officer" value="8.1" readonly><button type="submit" id="submitOfficer" class="btn btn-danger"><span class="fa fa-save"></span> Save</button>
				<button type="button"  class="btn btn-secondary" onClick="window.location.href=window.location.href">Close</button>
			</div>
  		</form>
    </div>
  </div>
</div>