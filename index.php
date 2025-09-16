<?php
  session_start();
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

  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div class="hero-container" data-aos="fade-up">
      <h1>Welcome to <span class='text-warning'>SHINE</span> Cagayan Valley</h1>
      <h2>Innovation is in our DNA</h2>
      <p class="text-white px-5">One of the expansion sites of the Regional Inclusive Innovation Centers (RIICs). It is comprised of government partners from DOST, DTI, DA, and NEDA; academe partners from Nueva Vizcaya State University (NVSU), Quirino State University (QSU), Cagayan State University (CSU), and Isabela State University (ISU); and industry partners Philippine Chamber of Commerce and Industry (PCCI-2) and Cagayan Valley Citrus Industry Development Council (CVCIDC), with support from USAID Science, Technology, Research and Innovation for Development (STRIDE).</p>
      <a href="#about" class="btn-get-started scrollto">Get Started</a>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="beginning" class="about">
      <div class="container">

        <div class="row justify-content-end">
          <div class="col-lg-11">
            <div class="row justify-content-end">

              <div class="col-lg-3 col-md-5 col-6 d-md-flex align-items-md-stretch">
                <div class="count-box py-5">
                  <i class="bi bi-file-person"></i>
                  <span data-purecounter-start="0" data-purecounter-end="200" class="purecounter">0</span>
                  <p>HEI Researchers</p>
                </div>
              </div>

              <div class="col-lg-3 col-md-5 col-6 d-md-flex align-items-md-stretch">
                <div class="count-box py-5">
                  <i class="bi bi-building"></i>
                  <span data-purecounter-start="0" data-purecounter-end="80" class="purecounter">0</span>
                  <p>R & D Facilities</p>
                </div>
              </div>

              <div class="col-lg-3 col-md-5 col-6 d-md-flex align-items-md-stretch">
                <div class="count-box pb-5 pt-0 pt-lg-5">
                  <i class="bi bi-briefcase"></i>
                  <span data-purecounter-start="0" data-purecounter-end="70" class="purecounter">0</span>
                  <p>MSMEs</p>
                </div>
              </div>

              <div class="col-lg-3 col-md-5 col-6 d-md-flex align-items-md-stretch">
                <div class="count-box pb-5 pt-0 pt-lg-5">
                  <i class="bi bi-gear-wide"></i>
                  <span data-purecounter-start="0" data-purecounter-end="10" class="purecounter">0</span>
                  <p>Regional Offices</p>
                </div>
              </div>

            </div>
          </div>
        </div>

        <div class="row">

          <div class="col-lg-6 video-box align-self-baseline position-relative">
            <img src="assets/img/main-photo.png" class="img-fluid" alt="">
            <a href="https://youtu.be/W43QC4Jj_oU" class="glightbox play-btn mb-4"></a>
          </div>

          <div class="col-lg-6 pt-3 pt-lg-0 content">
            <h3>Our Humble Beginning</h3>
            <p>
              The SHINE Cagayan Valley Logo expresses the overall vision of harnessing the region's growth potention through the value-adding of agri-based industries. Interwining elements reflect the region's unique identity as well as the mission of the Cagayan Valley RIIC in nurturing a stronger innovation and entrepreneurship ecosystem.
            </p>
            <ul>
              <li><i class="bx bx-check-double"></i> <b>Sun</b> - light, energy, hope</li>
              <li><i class="bx bx-check-double"></i> <b>Leaf</b> - rich resources: Cagayan Valley as one of the country's main contributor to the national agriculture. Sustainability in production and entreprenuership that is rooted in innovation.</li>
              <li><i class="bx bx-check-double"></i> <b>COG</b> - strengthening capacity for agri-manufacturing through market linkages and technology transfer.</li>
              <li><i class="bx bx-check-double"></i> <b>DNA</b> - uniqueness and individuality creating innovative/smart-agri solutions through R&D and science & technology</li>
              <li><i class="bx bx-check-double"></i> <b>Tagline</b> - embedding innovation in the identity of the Cagayan Valley community</li>
            </ul>
          </div>

        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Cta Section ======= -->
    <section id="aboutus" class="cta">
      <div class="container" data-aos="fade-in">

        <div class="section-title" data-aos="fade-up">
          <h2 class="text-white">About Us</h2>
        

          <img src="images/shinecagayan.png" alt="" class="img-fluid rounded-circle" style="width:500px;">
          <p class="lead mt-3"> SHINE Cagayan Valley will serve as a convergence mechanism aimed at strengthening the capacity for innovation across government, academia and industry for inclusive growth for Region 2. It is anchored on the citrus sector as its pilot industry, with the banana sector next in line for the replication of best practices and convergence models. As with pilot RIICs sites, it is implemented through the MLA approach—mapping players and capacities, strengthening linkages, and aligning with the needs of local industries.</p>
         
          <a class="cta-btn mt-5" href="about-us">Learn More from Us</a>
        </div>

      </div>
    </section><!-- End Cta Section -->

    <!-- ======= Services Section ======= -->
    <section id="databases" class="services ">
      <div class="container">

        <div class="section-title pt-5" data-aos="fade-up">
          <h2>Our Innovation Databases</h2>
        </div>

        <div class="row">

          <?php
            $get_str = "SELECT * FROM tbl_categories ORDER BY category_name ASC";
            $qry = $conn->query($get_str);
            $cnt = $qry->num_rows;
            $icon = array("bi bi-briefcase", "bi bi-book", "bi bi-card-checklist", "bi bi-binoculars", "bi bi-globe");
            $color = array("#ff689b", "#e9bf06", "#3fcdc7", "#41cf2e", "#d6ff22");

            if($cnt >= 1) {
              $i = 0;
              foreach ($qry as $var => $value) { ?>
                <div class="col-md-6">
                  <div class="icon-box" data-aos="fade-up">
                    <div class="icon"><i class="<?php echo $icon[$i]; ?>" style="color: <?php echo $color[$i]; ?>;"></i></div>
                    <h4 class="title"><a href='<?php echo "innovation-database?".$value['category_token'];?>'><?=$value['category_name']?></a></h4>
                    <p class="description"><?=$value['category_desc']?></p>
                  </div>
                </div>
              
              <?php
              $i++;
              }
            }
          ?>
        </div>

      </div>
    </section><!-- End Services Section -->

    <!-- ======= Our Clients Section ======= -->
    <section id="coregroups" class="clients bg-light">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Our Core Groups</h2>
          <p>We are supported by dedicated technical working groups with a common goal, to share expertise and resources to meet the important needs of our region, providing guidance and ways forward.</p>
        </div>

        <div class="clients-slider swiper-container">
          <div class="swiper-wrapper align-items-center">
         
            <div class="swiper-slide"><img src="images/core-partners/DOST logo.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="images/core-partners/DTI logo.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="images/core-partners/DA logo.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="images/core-partners/NEDA logo.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="images/core-partners/NVSU logo.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="images/core-partners/QSU logo.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="images/core-partners/ISU logo.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="images/core-partners/CSU logo.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="images/core-partners/PCCI logo.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="images/core-partners/CVCIDCI logo.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="images/core-partners/USAID logo.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="images/core-partners/RTI logo.png" class="img-fluid" alt=""></div>
          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section><!-- End Our Clients Section -->

  </main><!-- End #main -->
  
  <!-- ======= Footer ======= -->
  <?php include("pages/footer-link.php"); ?>
  <!-- End Footer -->

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

