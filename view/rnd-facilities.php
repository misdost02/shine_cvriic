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
						<th class="cell">Owner</th>
						<th class="cell">Industry</th>
						<th class="cell">Sector</th>
						<th class="cell">Type</th>
						<th class="cell">Name of Facility or Laboratory</th>
						<th class="cell">Year of Operation</th>
						<th class="cell">Action Taken</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$get_profile = "SELECT * FROM tbl_cat_rnd
						INNER JOIN tbl_client_profiles ON tbl_client_profiles.personnel_id = tbl_cat_rnd.personnel_id
						ORDER BY tbl_client_profiles.lastname ASC";
						$get_query = $conn->query($get_profile);
						$get_count = $get_query->num_rows;

						if($get_count >= 1) {
							while($row = $get_query->fetch_array()) {
								$rnd_id= $row['rnd_id'];
								$industry = $row['industry'];
								$sector = $row['sector'];
								$institution_type = $row['institution_type'];
								$rnd_facility_lab = $row['rnd_facility_lab'];
								$years_op = $row['years_op'];
								$firstname = $row['firstname'];
								$lastname = $row['lastname'];
								$personnel_id = $row['personnel_id'];
								$token_id = $row['token_id'];

								$total = getRNDFacilities($rnd_id, $conn);

								echo "<tr>
										<td><a class='view_profile' id='$token_id' style='cursor:pointer;' title='View Profile'>$firstname $lastname</a></td>
										<td>$industry</td>
										<td>$sector</td>
										<td>$institution_type</td>
										<td>$rnd_facility_lab</td>
										<td>$years_op</td>
										<td>
											<button type='button' id='$rnd_id' class='btn btn-danger btn-sm view_rnd'><span class='bi bi-eye'></span> Available Units <span class='badge bg-secondary'>$total</span></button>
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