<header id="header" class="fixed-top d-flex align-items-center">
  <div class="container d-flex align-items-center justify-content-between">

    <div class="logo">
      <!-- <h1 class="text-light"><a href="index.html">Serenity</a></h1> -->
      <!-- Uncomment below if you prefer to use an image logo -->
       <a href="<?php echo BASE_URL; ?>"><img src="images/SHINE-Logo.png" alt="" class="img-fluid"></a>
    </div>

    <nav id="navbar" class="navbar">
      <ul>
        <li class="dropdown"><a href="#"><span>Home</span> <i class="bi bi-chevron-down"></i></a>
          <ul>
            <li><a class="dropdown-item" href="<?php echo BASE_URL;?>#beginning">Our Humble Beginning</a></li>
            <li><a class="dropdown-item" href="<?php echo BASE_URL;?>#aboutus">About SHINE</a></li>
            <li><a class="dropdown-item" href="<?php echo BASE_URL;?>#databases">Databases</a></li>
            <li><a class="dropdown-item" href="<?php echo BASE_URL;?>#coregroups">Partner Core Groups</a></li>
            <li><a class="dropdown-item" href="our-team">Our Team</a></li>
             <div class="dropdown-divider"></div>
            <li><a class="dropdown-item" href="contact-us">Contact Us</a></li>
            <li><a class="dropdown-item" href="#">Join Us</a></li>
          </ul>
        </li>
        <li><a href="current-events?page=1">Newsletter</a></li>
        <li class="dropdown"><a href="#"><span>Innovation Database</span> <i class="bi bi-chevron-down"></i></a>
          <ul>
            <?php
              $get_str = "SELECT * FROM tbl_categories ORDER BY category_name ASC";
              $qry = $conn->query($get_str);
              $cnt = $qry->num_rows;

              if($cnt >= 1) {
                foreach ($qry as $var => $value) {
                  echo "<li><a class='dropdown-item' href='innovation-database?".$value['category_token']."'>".$value['category_name']."</a></li>";
                }
              }
            ?>
            
            <!-- <li><a class="dropdown-item" href="innovation-database?2">Higher Education Institutions</a></li>
            <li><a class="dropdown-item" href="innovation-database?3">Shared Service Facilities</a></li>
            <li><a class="dropdown-item" href="innovation-database?4">R & D Facilities</a></li>
            <li><a class="dropdown-item" href="innovation-database?5">MSMes</a></li>
            <li><a class="dropdown-item" href="innovation-database?6">Industries</a></li> -->
          </ul>
        </li>
        <li><a href="core-partners">Our Partners</a></li>
        <li><a href="resources">Resources</a></li>
        <li><a href="portfolio">Gallery</a></li>
        
        <!-- <li><a href="contact.html">Contact Us</a></li> -->

        <li><a role="button" class="getstarted" data-bs-target="#searchbox" data-bs-toggle="modal"><i class="bi bi-search"></i>&nbsp;Search</a></li>
        <?php

          if(isset($_SESSION['visitorid']) && isset($_SESSION['visitoruname'])) {

            $visitorid = $_SESSION['visitorid'];
            
            echo "<li><a role='button' class='getstarted bg-danger visitor_logout' id='$visitorid'><i class='bi bi-x-circle'></i>&nbsp;Logout</a></li>";
          }
          
        ?>
      </ul>
      <i class="bi bi-list mobile-nav-toggle"></i>
    </nav><!-- .navbar -->

  </div>
</header>

<!-- Modal -->
<div class="modal fade" id="searchbox" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title" id="staticBackdropLabel">Search</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="input-group mb-3 input-group-lg">
          <input type="text" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon2">
          <span class="input-group-text" id="basic-addon2">Enter Keyword</span>
        </div>
      </div>
      <div class="modal-footer bg-light">
        <button type="button" class="btn btn-outline-success"><span class="bi bi-search"></span> Go</button>
      </div>
    </div>
  </div>
</div>

