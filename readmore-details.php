<?php
  session_start();
  include("config/config.php");
  $token =  $_SERVER['QUERY_STRING'];
  $tokenid = explode("?", $token);
  $token_id = $tokenid[0];
  
  if($token_id != "") {
      $get_news = "SELECT * FROM tbl_news_articles WHERE news_slug = '$token_id' AND news_status = '1'";
      $qry_news = $conn->query($get_news);
      $cnt_news = $qry_news->num_rows;
  } else {
    header("location:current-events");
  }
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
            <h2>News Update</h2>
            <p>Est dolorum ut non facere possimus quibusdam eligendi voluptatem. Quia id aut similique quia voluptas sit quaerat debitis. Rerum omnis ipsam aperiam consequatur laboriosam nemo harum praesentium. </p>
          </div>
        </div>
      </div>
      <div class="container">
        <ol>
          <li><a href="<?php echo BASE_URL; ?>">Home</a></li>
          <li><a href="current-events?page=1">Current Events</a></li>
          <li>News Update</li>
        </ol>
      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Single Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-8 entries">
            <?php
              if($cnt_news == 1) {
                  while($row = $qry_news->fetch_array()) { ?>
                    <article class="entry entry-single">

                      <div class="entry-img">
                        <img src="<?php echo "images/news-photo/".$row['news_photo']; ?>" alt="" class="img-fluid">
                      </div>

                      <h2 class="entry-title">
                        <span><?=$row['news_title']?></span>
                      </h2>

                      <div class="entry-meta">
                        <ul>
                          <li class="d-flex align-items-center"><i class="bi bi-person"></i> <?=$row['news_author']?></li>
                          <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <?=$row['news_date']?></li>
                          <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <?=$row['news_counter']?></li>
                        </ul>
                      </div>

                      <div class="entry-content">
                        <?=$row['news_article']?>
                      </div>

                    </article><!-- End blog entry -->
                <?php 
                 }
               }
               ?>

               <a href="current-events?page=1" class="text-info">&larr; Back to Current Events</a>

          </div><!-- End blog entries list -->

          <div class="col-lg-4">

            <div class="sidebar">

              <h3 class="sidebar-title">Search</h3>
              <div class="sidebar-item search-form">
                <form action="">
                  <input type="text">
                  <button type="submit"><i class="bi bi-search"></i></button>
                </form>
              </div><!-- End sidebar search formn-->

              <h3 class="sidebar-title">Innovation Databases</h3>
              <div class="sidebar-item categories">
                <ul>
                  <?php
                    $get_str = "SELECT * FROM tbl_categories ORDER BY category_name ASC";
                    $qry = $conn->query($get_str);
                    $cnt = $qry->num_rows;

                    if($cnt >= 1) {
                      foreach ($qry as $var => $value) {
                        echo "<li><a href='innovation-database?".$value['category_token']."'>".$value['category_name']."</a></li>";
                      }
                    }
                  ?>
                </ul>
              </div><!-- End sidebar categories-->

              <h3 class="sidebar-title">Recent Posts</h3>
              <div class="sidebar-item recent-posts">

                <?php
                $select_all = "SELECT * FROM tbl_news_articles WHERE news_status = '1' ORDER BY news_id DESC LIMIT 5";
                $qry = $conn->query($select_all);
                $cnt = $qry->num_rows;

                if($cnt > 0) {
                  foreach ($qry as $key => $value) { 
                      if($cnt > 0) {
                        foreach ($qry as $key => $value) { ?>
                          <div class="post-item clearfix">
                            <img src='<?php echo "images/news-photo/".$value['news_photo']; ?>' alt="">
                            <h4><a href='<?php echo "?".$value['news_slug']?>'><?=$value['news_title']?></a></h4>
                            <time datetime=<?=$value['news_date']?>><?=$value['news_date']?></time>
                          </div>
                      <?php } 
                      } 
                    }
                  }
                ?>
              </div><!-- End sidebar recent posts-->
            </div><!-- End sidebar -->
          </div><!-- End blog sidebar -->
        </div>
      </div>
    </section><!-- End Blog Single Section -->
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include("pages/footer-link.php"); ?>
  <!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/js/jquery.min.js"></script>
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