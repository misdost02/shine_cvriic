<?php
  session_start();
  include("config/config.php");

  require_once("controller/fetch-category.php");
  require_once("riic/controller/compute.php");

  $token =  $_SERVER['QUERY_STRING'];
  $tokenid = explode("?", $token);
  $token_id = $tokenid[0];

  $cat_id = getCategoryID($token_id, $conn);
  $cat_name = getCategoryName($token_id, $conn);
  $cat_desc = getCategoryDesc($token_id, $conn);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include("pages/header-link.php"); ?>

<!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css"> -->
  <link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
  <link href="https://cdn.datatables.net/select/1.3.3/css/select.bootstrap5.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.css"/>
  </head>
<body>

  <!-- ======= Header ======= -->
  <?php include("pages/navbar-link.php"); ?>
  <!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="breadcrumb-hero">
        <div class="container">
          <div class="breadcrumb-heros">
            <h2>Innovation Database</h2>
            <p>Innovative regions have a strong and meaningful collaboration among the government agencies, industry players, enablers, innovators, and researchers. While our partners and clients are diverse, our goal in every engagement is the same. With highly transparent and collaborative approach, we are able to unify objectives to meet the needs of every constituent of the region’s economy.</p>
          </div>
        </div>
      </div>
      <div class="container">
        <ol>
          <li><a href="<?php echo BASE_URL; ?>">Home</a></li>
          <li>Innovation Database</li>
          <li><?=$cat_name?></li>
        </ol>
      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Features Section ======= -->
    <section id="features" class="features">
      <?php        
        switch($cat_id) {
          case 1:
            include("view/hei-personnels.php");
            break;
          case 2:
            include("view/rnd-facilities.php");
            break;
          case 3:
            include("view/msme.php");
            break;
          // case 4:
          //   include("view/industries.php");
          //   break;
          case 4:
            include("view/regional-offices.php");
            break;
          default:
            echo "<h3 class='text-center text-danger'>No data to display this time.</h3>";

        }
      ?>
    </section><!-- End Features Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include("pages/footer-link.php"); ?>
  <!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  
  <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
  
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/purecounter/purecounter.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="riic/js/sweetalert/sweetalert.min.js"></script>
  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script src="js/view-data.js"></script>
  <script src="js/register-account.js"></script>
</body>

</html>

<script type="text/javascript">
  $(document).ready(function() {
    $('#example').DataTable({
      "aLengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
      "pageLength": 25
    });

    $(document).on('click', '#magregister', function() {  
      $('#modalLogin').modal('hide');
      $('#register_form')[0].reset();
      $('#register_fname').focus();
      $('#modalRegister').modal('show');
    });

    $(document).on('click', '#maglogin', function() {  
      $('#modalRegister').modal('hide');
      $('#login_form')[0].reset();
      $('#login_username').focus();
      $('#modalLogin').modal('show');
    });

    

  });
</script>


<div class="modal fade in" id="viewClient" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
        <form id="client_form">
          <div class="alert alert-info text-center alert-dismissible" style="display:none;" id="message1"></div>
          <div class="row mb-3">
            <div class="col-md-3 text-center">
              <img class='img-fluid' src="images/personnels/no-photo.jpg" id="client_photo">
            </div>
            <div class="col">
              <div class="row mb-1">
                <h1 class="modal-title display-5 mt-3 text-primary" id="fullname"></h1>
                <h4 id="designation" name="designation"></h4>
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col">
              <label class="form-label h6">Division or Unit:</label>
              <input type="text" class="form-control" id="division_unit" name="division_unit" required>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col">
              <label class="form-label h6">Province:</label>
              <input type="text" class="form-control" id="province" name="province" required>
            </div>
            <div class="col">
              <label class="form-label h6">Town or Municipality:</label>
              <input type="text" class="form-control" id="town" name="town" required>
            </div>
            <div class="col">
              <label class="form-label h6">Barangay:</label>
              <input type="text" class="form-control" id="barangay" name="barangay" required>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col">
              <label class="form-label h6">Telephone or Landline Number</label>
              <input type="text" class="form-control" id="landline" name="landline">
            </div>
            <div class="col">
              <label class="form-label h6">Mobile or CP Number</label>
              <!-- <input type="text" class="form-control" id="mobile" name="mobile" required> -->
              <h5 id="mobile" name="mobile"></h5>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col">
              <label class="form-label h6">Email Address</label>
              <!-- <input type="email" class="form-control" id="email" name="email" required> -->
              <h5 id="email" name="email"></h5>
            </div>
            <div class="col">
              <label class="form-label h6">Website</label>
              <h5 id="website" name="website"></h5>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button"  class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- FACILITIES -->

<div class="modal fade in" id="viewFacilities" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h4 class="modal-title">Laboratory Unit or Facility</h4>
        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
      </div>
      <div class="modal-body py-0 px-3">
        <table class="table table-sm table-hover mb-0">
          <thead>
            <tr>
              <th class="cell" width="35%">Name of Lab Unit or Facility</th>
              <th class="cell">Line of Service / Functions</th>
            </tr>
          </thead>
          <tbody id="table_data1"></tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary close_modal" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- VIEW MSMEs -->
<div class="modal fade in" id="viewMSMEProducts" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h4 class="modal-title">MSME Products</h4>
        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
      </div>
      <div class="modal-body py-0 px-3">
        <table class="table table-sm table-hover mb-0">
          <thead>
            <tr>
              <th class="cell" width="30%">Name of Product</th>
              <th class="cell">Product Description</th>
            </tr>
          </thead>
          <tbody id="table_data2"></tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary close_modal" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- VIEW INDUSTRIES -->
<div class="modal fade in" id="viewIndustries" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h4 class="modal-title">Industry Products</h4>
        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
      </div>
      <div class="modal-body py-0 px-3">
        <table class="table table-sm table-hover mb-0">
          <thead>
            <tr>
              <th class="cell" width="30%">Name of Products</th>
              <th class="cell">Product Description</th>
            </tr>
          </thead>
          <tbody id="table_data3"></tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary close_modal" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<!-- AGRICULTURAL ORCHARD MSME -->

<div class="modal fade in" id="viewAgri" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
			<div class="modal-header bg-info">
				<h1 class="modal-title">FARM OR ORCHARDS</h1>
				<!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
			</div>
			<div class="modal-body py-3 px-3 modal-body-content" id="modal-body">
				<div class="table-responsive" id="agri_products">
					<table class="table app-table-hover table-hover table-stripe" id="datatable3">
						<thead>
							<tr>
								<th class="cell">#</th>
								<th class="cell" width="25%">Name of Orchard</th>
								<th class="cell">Area (Ha)</th>
								<th class="cell">Years of Orchard</th>
								<th class="cell">Address</th>
								<th class="cell" width="25%">Action Taken</th>
							</tr>
						</thead>
						<tbody id="table_data4"></tbody>
					</table>
				</div>

        <div class="mt-3" id="cultivar-data" style="display:none;">
        <h2 class='text-danger'>Farm or Orchard Cultivars</h2>
          <div class="table-responsive" id="agri_products">
            <table class="table app-table-hover table-hover table-stripe" id="datatable4">
              <thead>
                <tr>
                  <th class="cell" width="25%">Farm Cultivars</th>
                  <th class="cell">Farm Yields</th>
                  <th class="cell">Prunning</th>
                  <th class="cell">Produce Seed</th>
                  <th class="cell" width="25%">Action Taken</th>
                </tr>
              </thead>
              <tbody id="table_data_products"></tbody>
            </table>
          </div>
        </div>

        <div class="mt-3" id="nutrient-data" style="display:none;">
          <h2 class='text-danger'>Nutrient Management</h2>
          <div class="table-responsive" id="agri_nut">
            <table class="table app-table-hover table-hover table-stripe" id="datatable5">
              <thead>
                <tr>
                  <th class="cell">Farm Nutrients</th>
                  <th class="cell">Timing Application</th>
                  <th class="cell">Rate Application</th>
                  <th class="cell" width="25%">Action Taken</th>
                </tr>
              </thead>
              <tbody id="table_data_products_nut"></tbody>
            </table>
          </div>
        </div>
        
        <div class="mt-3" id="pest-data" style="display:none;">
          <h2 class='text-danger'>Pest, Diseases, and Water Management</h2>
            <div class="table-responsive" id="agri_pest">
              <table class="table app-table-hover table-hover table-stripe" id="datatable6">
                <thead>
                  <tr>
                    <th class="cell">Pest and Disease Management</th>
                    <th class="cell">Timing of Application</th>
                    <th class="cell">Rate Application</th>
                    <th class="cell">Major Insect Pest</th>
                    <th class="cell">Growth Stage Observed</th>
                    <th class="cell">Major Diseases</th>
                    <th class="cell">Growth Stage Observed</th>
                    <th class="cell">Presence of Drainage Canals</th>
                    <th class="cell">Water Management</th>
                    <th class="cell">Frequency of Irrigation</th>
                  </tr>
                </thead>
                <tbody id="table_data_products_pest"></tbody>
              </table>
            </div>

        </div>
			</div>
			<div class="modal-footer">
				<input type='hidden' class="form-control" id="msme_sector_id" readonly>
				<input type="hidden" class="form-control" id="msmeid" name="msmeid" required readonly>
				<!-- <button type="button" class="btn btn-info btn-sm text-white add_new"><span class="fa fa-plus"></span> Add New</button> -->
				<button type="button" class="btn btn-secondary btn-md close_modal" data-bs-dismiss="modal">Close</button>
			</div>
    </div>
  </div>
</div>

<!-- AGRICULTURAL MSME PRODUCTS-->

<div class="modal fade in" id="viewAgriProduct" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
			<div class="modal-header bg-info">
				<h4 class="modal-title">FARM OR ORCHARD PRODUCTS</h4>
				<!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
			</div>
			<div class="modal-body py-3 px-3">
				
				
			</div>
			<div class="modal-footer">
				
				<button type="button" class="btn btn-secondary btn-md close_modal" data-bs-dismiss="modal">Close</button>
			</div>
    </div>
  </div>
</div>
