<div class="container">
    <div class="section-title" data-aos="fade-up">
      <h2><?=$cat_name?></h2>
      <p class="lead">SHINE Cagayan Valley will serve as a convergence mechanism aimed at strengthening the capacity for innovation across government, academia and industry for inclusive growth for Region 2. It is anchored on the citrus sector as its pilot industry, with the banana sector next in line for the replication of best practices and convergence models. As with pilot RIICs sites, it is implemented through the MLA approach—mapping players and capacities, strengthening linkages, and aligning with the needs of local industries.</p>
    </div>

    <div class="row">
      <div class="col-sm-12" data-aos="fade-up">
          <div class="table-responsive" style="width:100%">
            <table class="table table-hover mb-0 text-left" id="example">
							<thead>
								<tr>
									<th class="cell">Contact Person</th>
									<th class="cell">Industry</th>
									<th class="cell">Sector</th>
									<th class="cell">Type</th>
									<th class="cell">Name of Industry</th>
									<th class="cell">Age of Orchard or Industry</th>
									<th class="cell">Complete Address</th>
									<th class="cell">Action Taken</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$get_profile = "SELECT * FROM tbl_cat_industries
									INNER JOIN tbl_client_profiles ON tbl_client_profiles.personnel_id = tbl_cat_industries.personnel_id
									ORDER BY tbl_client_profiles.lastname ASC";
									$get_query = $conn->query($get_profile);
									$get_count = $get_query->num_rows;

									if($get_count >= 1) {
										while($row = $get_query->fetch_array()) {
											$industry_id= $row['industry_id'];
											$industry = $row['industry'];
											$sector = $row['sector'];
											$institution_type = $row['type'];
											$company = $row['company'];
											$years_op = $row['years_op'];
											$address = $row['address'];
											$firstname = $row['firstname'];
											$lastname = $row['lastname'];
											$token_id = $row['token_id'];


											$total = getIndustryProducts($industry_id, $conn);

											echo "<tr>
													<td><a class='view_profile' id='$token_id' style='cursor:pointer;' title='View Profile'>$firstname $lastname</a></td>
													<td>$industry</td>
													<td>$sector</td>
													<td>$institution_type</td>
													<td>$company</td>
													<td>$years_op</td>
													<td>$address</td>
													<td>
														<button type='button' id='$industry_id' class='btn btn-danger btn-sm view_industry'><span class='bi bi-eye'></span> Available Products <span class='badge bg-secondary'>$total</span></button>
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