<div class="container">
  <div class="section-title" data-aos="fade-up">
    <h2><?=$cat_name?></h2>
    <p class="lead"><?=$cat_desc?></p>
  </div>

  <div class="row">
    <div class="col-sm-12" data-aos="fade-up">
          <div class="table-responsive" style="width:100%">
          <table class="table table-hover mb-0 text-left" id="example">
						<thead>
							<tr>
								<th class="cell">Fullname</th>
								<th class="cell">Industry</th>
								<th class="cell">Sector</th>
								<th class="cell">Type</th>
								<th class="cell">Name of Institution</th>
								<th class="cell">Years</th>
								<th class="cell">Expertise</th>
								<th class="cell">R & D Engagement</th>
								<th class="cell">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$get_profile = "SELECT * FROM tbl_cat_hei
								INNER JOIN tbl_client_profiles ON tbl_client_profiles.personnel_id = tbl_cat_hei.personnel_id
								INNER JOIN tbl_institutions ON tbl_institutions.institution_id = tbl_cat_hei.institution_id
								INNER JOIN tbl_institutions_campuses ON tbl_institutions_campuses.campus_id = tbl_cat_hei.campus_id
								ORDER BY tbl_client_profiles.lastname ASC";
								$get_query = $conn->query($get_profile);
								$get_count = $get_query->num_rows;

								if($get_count >= 1) {
									while($row = $get_query->fetch_array()) {
										$industry = $row['industry'];
										$sector = $row['sector'];
										$institution_type = $row['institution_type'];
										$institution = $row['institution_name'];
										$campus = $row['campus_name'];
										$years_op = $row['years_op'];
										$expertise = $row['expertise'];
										$rd_engagement = $row['rd_engagement'];
										$firstname = $row['firstname'];
										$lastname = $row['lastname'];
										$token_id = $row['token_id'];

										if($campus != "") {
											$college = "$institution - $campus";
										} else {
											$college = "$institution";
										}

										echo "<tr>
												<td>$firstname $lastname</td>
												<td>$industry</td>
												<td>$sector</td>
												<td>$institution_type</td>
												<td>$college</td>
												<td>$years_op</td>
												<td>$expertise</td>
												<td>$rd_engagement</td>
												<td>
													<button type='button' id='$token_id' class='btn btn-danger btn-sm view_profile'><span class='bi bi-eye'></span> View Profile</button>
												</td>
											</tr>";
									}
								}
							?>
						</tbody>
					</table>
      </div>
    </div>
  </div>
</div>