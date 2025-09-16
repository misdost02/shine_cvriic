<?php
  session_start();
  include("config/config.php");
  $total = 5;

  if (isset($_GET["page"]))  {
    $page  = $_GET["page"];

    if($page == "") {
      header("location:./");
    } else {
      $page = 1;
    }
  } else {
    header("location:./");
  }
  $start = ($page - 1) * $total;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include("pages/header-link.php"); ?>
</head>

<body>

  <!-- ======= Header ======= -->
  <?php include("pages/navbar-link.php"); ?><!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="breadcrumb-hero">
        <div class="container">
          <div class="breadcrumb-heros">
            <h2>Current Events</h2>
            <p>Est dolorum ut non facere possimus quibusdam eligendi voluptatem. Quia id aut similique quia voluptas sit quaerat debitis. Rerum omnis ipsam aperiam consequatur laboriosam nemo harum praesentium. </p>
          </div>
        </div>
      </div>
      <div class="container">
        <ol>
          <li><a href="<?php echo BASE_URL; ?>">Home</a></li>
          <li>Current Events</li>
        </ol>
      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">
        <div class="row">
          <div class="col-lg-8 entries">

            <?php
                $select_all = "SELECT * FROM tbl_news_articles WHERE news_status = '1' LIMIT $start,$total";
                $qry = $conn->query($select_all);
                $cnt = $qry->num_rows;

                if($cnt > 0) {
                  foreach ($qry as $key => $value) { ?>
                    
                    <article class="entry">
                      <div class="entry-img">
                        <img src='<?php echo "images/news-photo/".$value['news_photo']; ?>' alt="" class="img-fluid">
                      </div>

                      <h2 class="entry-title">
                        <a href='<?php echo "readmore-details?".$value['news_slug']?>'><?=$value['news_title']?></a>
                      </h2>

                      <div class="entry-meta">
                        <ul>
                          <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="readmore-details"><?=$value['news_author']?></a></li>
                          <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="readmore-details"><time datetime=<?=$value['news_date']?>><?=$value['news_date']?></time></a></li>
                          <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="readmore-details"><?=$value['news_counter']?> Comments</a></li>
                        </ul>
                      </div>

                      <div class="entry-content">
                        <?=substr($value['news_article'],0,350)?>...
                        <div class="read-more">
                          <a href='<?php echo "readmore-details?".$value['news_slug']?>'>Read More</a>
                        </div>
                      </div>

                    </article><!-- End blog entry -->

                  <?php
                  }
                } else {
                  echo "<div class='alert alert-danger text-center'><h3><span class='bi bi-info-circle'></span> No news articles to display at this time.</h3></div>";
                }

            ?>
            <?php
              $slt = "SELECT * FROM tbl_news_articles WHERE news_status = '1'";
              $rec = $conn->query($slt);
              $total1 = $rec->num_rows;
             


            if($total1 > 5) { ?>
            
            <div class="blog-pagination">
              <ul class="pagination justify-content-center">
                <li class="<?php if($page==1){ echo 'disabled';} ?>">
                  <a href="<?php if($page==1){ echo '#';} else {?><?php echo $_SERVER['PHP_SELF']?>?page=<?php echo $page-1; }?>" aria-label="Previous">
                  <span aria-hidden="true">Previous</span>
                  </a>
                </li>

                  <?php
                   $total_pages = ceil($total1 / $total);
                    for($i = 1;$i <= $total_pages;$i++) {?>
                       <li class="<?php if($_GET['page'] == $i){ echo 'active';  } ?>"><a href="<?php echo $_SERVER['PHP_SELF']?>?page=<?php echo $i;?>"><?php echo $i;?></a></li>
                    <?php
                    }
                    ?>
                  
                <li class="<?php if($page==$total_pages){ echo 'disabled'; } ?>">
                  <a href="<?php if($page==$total_pages){ echo '#';} else {?><?php echo $_SERVER['PHP_SELF']?>?page=<?php echo $page+1; }?>" aria-label="Next">
                  <span aria-hidden="true">Next</span>
                  </a>
                </li>
              </ul>
            </div>
            <?php 
              }
            ?>
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
                  $qry_news = $conn->query($select_all);
                  $cnt_news = $qry_news->num_rows;
                  if($cnt_news > 0) {
                    foreach ($qry_news as $key => $value) { ?>
                      <div class="post-item clearfix">
                        <img src='<?php echo "images/news-photo/".$value['news_photo']; ?>' alt="">
                        <h4><a href='<?php echo "?".$value['news_slug']?>'><?=$value['news_title']?></a></h4>
                        <time datetime=<?=$value['news_date']?>><?=$value['news_date']?></time>
                      </div>
                  <?php }  
                }
                ?>

              </div><!-- End sidebar recent posts-->
            </div><!-- End sidebar -->
          </div><!-- End blog sidebar -->
        </div>
      </div>
    </section><!-- End Blog Section -->

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