<?php
  include("config/config.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include("pages/header-link.php"); ?>
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
            <h2>Core Partners</h2>
            <p>We are supported by dedicated technical working groups with a common goal, to share expertise and resources to meet the important needs of our region, providing guidance and ways forward</p>
          </div>
        </div>
      </div>
      <div class="container">
        <ol>
          <li><a href="<?php echo BASE_URL; ?>">Home</a></li>
          <li>Core Partners</li>
        </ol>
      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Pricing Section ======= -->
    <section id="pricing" class="pricing">
      <div class="container">

        <div class="row">

          <?php
              $select_all = "SELECT * FROM tbl_core_partners ORDER BY partner_id DESC";
              $qry = $conn->query($select_all);
              $cnt = $qry->num_rows;

              if($cnt > 0) {
                foreach ($qry as $key => $value) { ?>

                  <div class="col-lg-4 col-md-6 mb-5">
                    <div class="box featured" data-aos="fade-up">
                      <h3><?=$value['partner_name']?></h3>
                      
                      <img src='<?php echo "images/core-partners/".$value['partner_logo']; ?>' class="img-fluid" alt="">
                      <div class="btn-wrap">
                        <a href="<?=$value['partner_website']?>" target="_blank"  class="btn btn-outline-danger"><i class="bi bi-globe"></i> Visit Website</a>
                      </div>
                    </div>
                  </div>

                  <?php
                }
              } else {
                echo "<div class='alert text-center mt-5'><h3><span class='bi bi-info-circle'></span> No core partners to display at this time.</h3></div>";
              }
          ?>

        </div>

      </div>
    </section><!-- End Pricing Section -->

    <!-- ======= Frequently Asked Questions Section ======= -->
    <section id="faq" class="faq section-bg">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>DID YOU KNOW?</h2>
          <p></p>
        </div>

        <div class="row faq-item d-flex align-items-stretch" data-aos="fade-up">
          <div class="col-lg-5">
            <i class="bx bx-help-circle"></i>
            <h4>FACT # 1</h4>
          </div>
          <div class="col-lg-7">
            <p>
              Cagayan Valley is the country’s top producer of mandarin, contributing over 45% to the national volume in the last 10 years.
            </p>
          </div>
        </div><!-- End F.A.Q Item-->

        <div class="row faq-item d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-5">
            <i class="bx bx-help-circle"></i>
            <h4>FACT # 2</h4>
          </div>
          <div class="col-lg-7">
            <p>
              Philippine Chamber of Commerce & Industry-Region 02 fosters a healthy business community through 5 local chambers in the region, partnering with government and academia in preparation for Industry 4.0
            </p>
          </div>
        </div><!-- End F.A.Q Item-->

        <div class="row faq-item d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
          <div class="col-lg-5">
            <i class="bx bx-help-circle"></i>
            <h4>FACT # 3</h4>
          </div>
          <div class="col-lg-7">
            <p>
              Nueva Vizcaya State University is the only university in Cagayan Valley with expertise in citrus and banana disease detection.
            </p>
          </div>
        </div><!-- End F.A.Q Item-->

        <div class="row faq-item d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="300">
          <div class="col-lg-5">
            <i class="bx bx-help-circle"></i>
            <h4>FACT # 4</h4>
          </div>
          <div class="col-lg-7">
            <p>
              DOST - Region 2 provides a wide range of services to nurture innovation, supporting 3 Consortia, 23 R&D Centers, 188 OneExperts and 782 SETUP beneficiaries in the region.
            </p>
          </div>
        </div><!-- End F.A.Q Item-->

        <div class="row faq-item d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="400">
          <div class="col-lg-5">
            <i class="bx bx-help-circle"></i>
            <h4>FACT # 5</h4>
          </div>
          <div class="col-lg-7">
            <p>
              State universities in Isabela, Cagayan, and Quirino, have diverse innovation expertise, facilities and services that can be tapped to strengthen local industries.
            </p>
          </div>
        </div><!-- End F.A.Q Item-->

      </div>
    </section><!-- End Frequently Asked Questions Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-info">
            <h3>Serenity</h3>
            <p>Cras fermentum odio eu feugiat lide par naso tierra. Justo eget nada terra videa magna derita valies darta donna mare fermentum iaculis eu non diam phasellus. Scelerisque felis imperdiet proin fermentum leo. Amet volutpat consequat mauris nunc congue.</p>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><a href="#">Home</a></li>
              <li><a href="#">About us</a></li>
              <li><a href="#">Services</a></li>
              <li><a href="#">Terms of service</a></li>
              <li><a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-contact">
            <h4>Contact Us</h4>
            <p>
              A108 Adam Street <br>
              New York, NY 535022<br>
              United States <br>
              <strong>Phone:</strong> +1 5589 55488 55<br>
              <strong>Email:</strong> info@example.com<br>
            </p>

            <div class="social-links">
              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>

          </div>

          <div class="col-lg-3 col-md-6 footer-newsletter">
            <h4>Our Newsletter</h4>
            <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna veniam enim veniam illum dolore legam minim quorum culpa amet magna export quem marada parida nodela caramase seza.</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>
          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Serenity</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/serenity-bootstrap-corporate-template/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/purecounter/purecounter.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>