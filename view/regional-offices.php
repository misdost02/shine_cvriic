<div class="container">
    <div class="section-title" data-aos="fade-up">
      <h2><?php echo $cat_name; ?></h2>
      <p class="lead"><?=$cat_desc?></p>
    </div>

    <div class="row">
      <div class="col-sm-12" data-aos="fade-up">
            <div class="table-responsive" style="width:100%">
            <table class="table table-striped table-hover" style="width:100%" id="example">
              <thead  style="width:100%">
                <tr>
					<th class="cell">Fullname</th>
					<th class="cell">Name of Office</th>
					<th class="cell">Address</th>
					<th class="cell">Email</th>
					<th class="cell">Contact</th>
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
	                      <td><?php echo $officer_fullname; ?></td>
	                      <td><?php echo $office_name; ?></td>
	                      <td><?php echo $office_address; ?></td>
	                      <td><?php echo $office_email; ?></td>
	                      <td><?php echo $office_contact; ?></td>
	                  </tr>
	                  <?php
						}
					}
				?>
              </tbody>
          </table>
          </div>
      </div>
      
    </div>

  </div>