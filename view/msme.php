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
									<th class="cell">Contact Person</th>
									<th class="cell">Industry</th>
									<th class="cell">Sector</th>
									<th class="cell">Name of MSME</th>
									<th class="cell">Year of Operation</th>
									<th class="cell">Complete Address</th>
									<th class="cell">Action Taken</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$get_profile = "SELECT * FROM tbl_cat_msme
									INNER JOIN tbl_client_profiles ON tbl_client_profiles.personnel_id = tbl_cat_msme.personnel_id
									ORDER BY tbl_client_profiles.lastname ASC";
									$get_query = $conn->query($get_profile);
									$get_count = $get_query->num_rows;

									if($get_count >= 1) {
										while($row = $get_query->fetch_array()) {
											$msme_id= $row['msme_id'];
											$industry = $row['industry'];
											$sector = $row['sector'];
											$institution_type = $row['type'];
											$msme_company = $row['msme_company'];
											$years_op = $row['years_op'];
											$address = $row['address'];
											$firstname = $row['firstname'];
											$lastname = $row['lastname'];
											$token_id = $row['token_id'];

											$total = getMSMEProducts($sector, $msme_id, $conn);

											if($sector == "Agriculture") {
												$view = "View Orchards";
											}

											if($sector == "Manufacturing") {
												$view = "View Products";
											}

											if($sector == "Marketing") {
												$view = "View Facilities";
											}

											echo "<tr>
													<td><a class='view_profile' id='$token_id' style='cursor:pointer;' title='View Profile'>$firstname $lastname</a></td>
													<td>$industry</td>
													<td>$sector</td>
													<td>$msme_company</td>
													<td>$years_op</td>
													<td>$address</td>
													<td>
														<button type='button' id='$msme_id' data-id='$sector' class='btn btn-danger btn-sm view_msme_agri'><span class='bi bi-eye'></span> $view <span class='badge bg-secondary'>$total</span></button>
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