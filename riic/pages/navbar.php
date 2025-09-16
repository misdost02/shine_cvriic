<div class="app-header-inner bg-warning text-white">  
    <div class="container-fluid py-2">
        <div class="app-header-content"> 
            <div class="row justify-content-between align-items-center">
	        
		    <div class="col-auto">
			    <a id="sidepanel-toggler" class="sidepanel-toggler d-inline-block d-xl-none" href="#">
				    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" role="img"><title>Menu</title><path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" d="M4 7h22M4 15h22M4 23h22"></path></svg>
			    </a>
		    </div><!--//col-->
            <div class="search-mobile-trigger d-sm-none col">
	            <i class="search-mobile-trigger-icon fas fa-search"></i>
	        </div><!--//col-->
            <div class="app-search-box col">
                <form class="app-search-form">   
					<input type="text" placeholder="Search..." name="search" class="form-control search-input">
					<button type="submit" class="btn search-btn btn-primary" value="Search"><i class="fas fa-search"></i></button> 
		        </form>
            </div><!--//app-search-box-->
            
            <div class="app-utilities col-auto">
            	<?php 
            		if(isset($_SESSION['adminname'])) {
            			$name = $_SESSION['adminname'];
						$nagan = explode(' ',trim($name));
						$poto = $_SESSION['adminphoto'];
            		
            			echo "<small class='mr-4 text-secondary'>Welcome, $nagan[0]!</small>";

						if($_SESSION['adminphoto'] != "") {
							$foto = "assets/images/profiles/$poto";
						} else {
							$foto = "assets/images/profiles/no-photo.jpg";
						}
            		}
            	?>
	            
	            <div class="app-utility-item app-user-dropdown dropdown">
		            <a class="" role="button" aria-expanded="false"><img src="<?php echo "$foto"; ?>" alt="user profile" class="rounded-circle"></a>
		            <!-- <ul class="dropdown-menu" aria-labelledby="user-dropdown-toggle">
						<li><a class="dropdown-item" href="account.html">Account</a></li>
						<li><a class="dropdown-item" href="settings.html">Settings</a></li>
						<li><hr class="dropdown-divider"></li>
						<li><a class="dropdown-item" href="controller/logout" data-bs-toggle="modal" data-bs-target="#logout">Log Out</a></li>
					</ul> -->
	            </div><!--//app-user-dropdown--> 
            </div><!--//app-utilities-->
        </div><!--//row-->
        </div><!--//app-header-content-->
    </div><!--//container-fluid-->
</div><!--//app-header-inner-->
<div id="app-sidepanel" class="app-sidepanel"> 
    <div id="sidepanel-drop" class="sidepanel-drop"></div>
    <div class="sidepanel-inner d-flex flex-column">
        <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
        <div class="app-branding">
            <a class="app-logo" href="home"><img class="logo-icon me-2" src="assets/images/app-logo.svg" alt="logo"><span class="logo-text">SHINE</span></a>

        </div><!--//app-branding-->  
        
	    <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
		    <ul class="app-menu list-unstyled accordion" id="menu-accordion">
			    <li class="nav-item">
			        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
			        <a class="nav-link <?php if($active == 1) { echo 'active'; }?>" href="<?php echo MAIN_ADMIN_URL; ?>home">
				        <span class="nav-icon">
				        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-house-door" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
			<path fill-rule="evenodd" d="M7.646 1.146a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 .146.354v7a.5.5 0 0 1-.5.5H9.5a.5.5 0 0 1-.5-.5v-4H7v4a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .146-.354l6-6zM2.5 7.707V14H6v-4a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v4h3.5V7.707L8 2.207l-5.5 5.5z"/>
			<path fill-rule="evenodd" d="M13 2.5V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
			</svg>
				         </span>
			             <span class="nav-link-text">Home</span>
			        </a><!--//nav-link-->
			    </li><!--//nav-item-->
				
				<li class="nav-item">
			        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
			        <a class="nav-link <?php if($active == 2) { echo 'active'; }?>" href="<?php echo MAIN_ADMIN_URL; ?>client-profiles">
				        <span class="nav-icon">
				        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
  <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/>
</svg>
				         </span>
			             <span class="nav-link-text">Clients</span>
			        </a><!--//nav-link-->
			    </li><!--//nav-item-->

			    
			    <li class="nav-item has-submenu">
			        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
			        <a class="nav-link submenu-toggle <?php if($active == 3) { echo 'active'; }?>" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-1" aria-expanded="false" aria-controls="submenu-1">
				        <span class="nav-icon">
				        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
				        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-files" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
			<path fill-rule="evenodd" d="M4 2h7a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H4z"/>
			<path d="M6 0h7a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2v-1a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H6a1 1 0 0 0-1 1H4a2 2 0 0 1 2-2z"/>
			</svg>
				         </span>
			             <span class="nav-link-text">Databases</span>
			             <span class="submenu-arrow">
			                 <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
			<path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
			</svg>
			             </span><!--//submenu-arrow-->
			        </a><!--//nav-link-->
			        <div id="submenu-1" class="collapse submenu submenu-1" data-bs-parent="#menu-accordion">
				        <ul class="submenu-list list-unstyled">
					        <?php //include("controller/get-categories.php"); ?>
					        <!-- <li class='submenu-item'><a class='submenu-link' href='client-profiles'>Client Profiles</a></li> -->
					        <li class='submenu-item'><a class='submenu-link' href='hei-personnels'>HEI Personnels</a></li>
					        <li class='submenu-item'><a class='submenu-link' href='rnd-facilities'>R&D Facilities</a></li>
					        <li class='submenu-item'><a class='submenu-link' href='msme'>MSMEs</a></li>
					        <!-- <li class='submenu-item'><a class='submenu-link' href='industries'>Industries</a></li> -->
							<li class='submenu-item'><a class='submenu-link' href='regional-offices'>Regional Offices</a></li>
						</ul>
			        </div>
			    </li><!--//nav-item-->

			    <li class="nav-item">
			        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
			        <a class="nav-link <?php if($active == 4) { echo 'active'; }?>" href="<?php echo MAIN_ADMIN_URL; ?>news-articles">
				        <span class="nav-icon">
				        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-newspaper" viewBox="0 0 16 16">
  <path d="M0 2.5A1.5 1.5 0 0 1 1.5 1h11A1.5 1.5 0 0 1 14 2.5v10.528c0 .3-.05.654-.238.972h.738a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 1 1 0v9a1.5 1.5 0 0 1-1.5 1.5H1.497A1.497 1.497 0 0 1 0 13.5v-11zM12 14c.37 0 .654-.211.853-.441.092-.106.147-.279.147-.531V2.5a.5.5 0 0 0-.5-.5h-11a.5.5 0 0 0-.5.5v11c0 .278.223.5.497.5H12z"/>
  <path d="M2 3h10v2H2V3zm0 3h4v3H2V6zm0 4h4v1H2v-1zm0 2h4v1H2v-1zm5-6h2v1H7V6zm3 0h2v1h-2V6zM7 8h2v1H7V8zm3 0h2v1h-2V8zm-3 2h2v1H7v-1zm3 0h2v1h-2v-1zm-3 2h2v1H7v-1zm3 0h2v1h-2v-1z"/>
</svg>
				         </span>
			             <span class="nav-link-text">News Articles</span>
			        </a><!--//nav-link-->
			    </li><!--//nav-item-->

			    <li class="nav-item has-submenu">
			        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
			        <a class="nav-link submenu-toggle <?php if($active == 5) { echo 'active'; }?>" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-3" aria-expanded="false" aria-controls="submenu-3">
				        <span class="nav-icon">
				        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
				        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-puzzle" viewBox="0 0 16 16">
  <path d="M3.112 3.645A1.5 1.5 0 0 1 4.605 2H7a.5.5 0 0 1 .5.5v.382c0 .696-.497 1.182-.872 1.469a.459.459 0 0 0-.115.118.113.113 0 0 0-.012.025L6.5 4.5v.003l.003.01c.004.01.014.028.036.053a.86.86 0 0 0 .27.194C7.09 4.9 7.51 5 8 5c.492 0 .912-.1 1.19-.24a.86.86 0 0 0 .271-.194.213.213 0 0 0 .039-.063v-.009a.112.112 0 0 0-.012-.025.459.459 0 0 0-.115-.118c-.375-.287-.872-.773-.872-1.469V2.5A.5.5 0 0 1 9 2h2.395a1.5 1.5 0 0 1 1.493 1.645L12.645 6.5h.237c.195 0 .42-.147.675-.48.21-.274.528-.52.943-.52.568 0 .947.447 1.154.862C15.877 6.807 16 7.387 16 8s-.123 1.193-.346 1.638c-.207.415-.586.862-1.154.862-.415 0-.733-.246-.943-.52-.255-.333-.48-.48-.675-.48h-.237l.243 2.855A1.5 1.5 0 0 1 11.395 14H9a.5.5 0 0 1-.5-.5v-.382c0-.696.497-1.182.872-1.469a.459.459 0 0 0 .115-.118.113.113 0 0 0 .012-.025L9.5 11.5v-.003a.214.214 0 0 0-.039-.064.859.859 0 0 0-.27-.193C8.91 11.1 8.49 11 8 11c-.491 0-.912.1-1.19.24a.859.859 0 0 0-.271.194.214.214 0 0 0-.039.063v.003l.001.006a.113.113 0 0 0 .012.025c.016.027.05.068.115.118.375.287.872.773.872 1.469v.382a.5.5 0 0 1-.5.5H4.605a1.5 1.5 0 0 1-1.493-1.645L3.356 9.5h-.238c-.195 0-.42.147-.675.48-.21.274-.528.52-.943.52-.568 0-.947-.447-1.154-.862C.123 9.193 0 8.613 0 8s.123-1.193.346-1.638C.553 5.947.932 5.5 1.5 5.5c.415 0 .733.246.943.52.255.333.48.48.675.48h.238l-.244-2.855zM4.605 3a.5.5 0 0 0-.498.55l.001.007.29 3.4A.5.5 0 0 1 3.9 7.5h-.782c-.696 0-1.182-.497-1.469-.872a.459.459 0 0 0-.118-.115.112.112 0 0 0-.025-.012L1.5 6.5h-.003a.213.213 0 0 0-.064.039.86.86 0 0 0-.193.27C1.1 7.09 1 7.51 1 8c0 .491.1.912.24 1.19.07.14.14.225.194.271a.213.213 0 0 0 .063.039H1.5l.006-.001a.112.112 0 0 0 .025-.012.459.459 0 0 0 .118-.115c.287-.375.773-.872 1.469-.872H3.9a.5.5 0 0 1 .498.542l-.29 3.408a.5.5 0 0 0 .497.55h1.878c-.048-.166-.195-.352-.463-.557-.274-.21-.52-.528-.52-.943 0-.568.447-.947.862-1.154C6.807 10.123 7.387 10 8 10s1.193.123 1.638.346c.415.207.862.586.862 1.154 0 .415-.246.733-.52.943-.268.205-.415.39-.463.557h1.878a.5.5 0 0 0 .498-.55l-.001-.007-.29-3.4A.5.5 0 0 1 12.1 8.5h.782c.696 0 1.182.497 1.469.872.05.065.091.099.118.115.013.008.021.01.025.012a.02.02 0 0 0 .006.001h.003a.214.214 0 0 0 .064-.039.86.86 0 0 0 .193-.27c.14-.28.24-.7.24-1.191 0-.492-.1-.912-.24-1.19a.86.86 0 0 0-.194-.271.215.215 0 0 0-.063-.039H14.5l-.006.001a.113.113 0 0 0-.025.012.459.459 0 0 0-.118.115c-.287.375-.773.872-1.469.872H12.1a.5.5 0 0 1-.498-.543l.29-3.407a.5.5 0 0 0-.497-.55H9.517c.048.166.195.352.463.557.274.21.52.528.52.943 0 .568-.447.947-.862 1.154C9.193 5.877 8.613 6 8 6s-1.193-.123-1.638-.346C5.947 5.447 5.5 5.068 5.5 4.5c0-.415.246-.733.52-.943.268-.205.415-.39.463-.557H4.605z"/>
</svg>
				         </span>
			             <span class="nav-link-text">Misc</span>
			             <span class="submenu-arrow">
			                 <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
			<path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
			</svg>
			             </span><!--//submenu-arrow-->
			        </a><!--//nav-link-->
			        <div id="submenu-3" class="collapse submenu submenu-3" data-bs-parent="#menu-accordion">
				        <ul class="submenu-list list-unstyled">
					        <?php //include("controller/get-categories.php"); ?>
					        <!-- <li class='submenu-item'><a class='submenu-link' href='client-profiles'>Client Profiles</a></li> -->
					        <li class='submenu-item'><a class='submenu-link' href='categories'>Categories</a></li>
							<li class='submenu-item'><a class='submenu-link' href='institutions'>Universities</a></li>
					        <li class='submenu-item'><a class='submenu-link' href='core-partners'>Core Partners</a></li>
					        <li class='submenu-item'><a class='submenu-link' href='team-members'>Team Members</a></li>
					        <li class='submenu-item'><a class='submenu-link' href='gallery'>Gallery</a></li>
				        </ul>
			        </div>
			    </li><!--//nav-item-->

				<li class="nav-item">
			        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
			        <a class="nav-link <?php if($active == 6) { echo 'active'; }?>" href="<?php echo MAIN_ADMIN_URL; ?>audit-trail">
				        <span class="nav-icon">
				        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-laptop" viewBox="0 0 16 16">
  <path d="M13.5 3a.5.5 0 0 1 .5.5V11H2V3.5a.5.5 0 0 1 .5-.5h11zm-11-1A1.5 1.5 0 0 0 1 3.5V12h14V3.5A1.5 1.5 0 0 0 13.5 2h-11zM0 12.5h16a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 12.5z"/>
</svg>
				         </span>
			             <span class="nav-link-text">Audit Trail</span>
			        </a><!--//nav-link-->
			    </li><!--//nav-item-->
			    				    
			</ul><!--//app-menu-->
	    </nav><!--//app-nav-->
	    <div class="app-sidepanel-footer">
		    <nav class="app-nav app-nav-footer">
			    <ul class="app-menu footer-menu list-unstyled">
					<?php
						if($_SESSION['adminlevel'] == 1) { ?>
				    <li class="nav-item">
				        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
				        <a <?php if($active == 7) { echo 'active'; }?>" class="nav-link" href="settings">
					        <span class="nav-icon">
					            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-gear" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" d="M8.837 1.626c-.246-.835-1.428-.835-1.674 0l-.094.319A1.873 1.873 0 0 1 4.377 3.06l-.292-.16c-.764-.415-1.6.42-1.184 1.185l.159.292a1.873 1.873 0 0 1-1.115 2.692l-.319.094c-.835.246-.835 1.428 0 1.674l.319.094a1.873 1.873 0 0 1 1.115 2.693l-.16.291c-.415.764.42 1.6 1.185 1.184l.292-.159a1.873 1.873 0 0 1 2.692 1.116l.094.318c.246.835 1.428.835 1.674 0l.094-.319a1.873 1.873 0 0 1 2.693-1.115l.291.16c.764.415 1.6-.42 1.184-1.185l-.159-.291a1.873 1.873 0 0 1 1.116-2.693l.318-.094c.835-.246.835-1.428 0-1.674l-.319-.094a1.873 1.873 0 0 1-1.115-2.692l.16-.292c.415-.764-.42-1.6-1.185-1.184l-.291.159A1.873 1.873 0 0 1 8.93 1.945l-.094-.319zm-2.633-.283c.527-1.79 3.065-1.79 3.592 0l.094.319a.873.873 0 0 0 1.255.52l.292-.16c1.64-.892 3.434.901 2.54 2.541l-.159.292a.873.873 0 0 0 .52 1.255l.319.094c1.79.527 1.79 3.065 0 3.592l-.319.094a.873.873 0 0 0-.52 1.255l.16.292c.893 1.64-.902 3.434-2.541 2.54l-.292-.159a.873.873 0 0 0-1.255.52l-.094.319c-.527 1.79-3.065 1.79-3.592 0l-.094-.319a.873.873 0 0 0-1.255-.52l-.292.16c-1.64.893-3.433-.902-2.54-2.541l.159-.292a.873.873 0 0 0-.52-1.255l-.319-.094c-1.79-.527-1.79-3.065 0-3.592l.319-.094a.873.873 0 0 0 .52-1.255l-.16-.292c-.892-1.64.902-3.433 2.541-2.54l.292.159a.873.873 0 0 0 1.255-.52l.094-.319z"/>
<path fill-rule="evenodd" d="M8 5.754a2.246 2.246 0 1 0 0 4.492 2.246 2.246 0 0 0 0-4.492zM4.754 8a3.246 3.246 0 1 1 6.492 0 3.246 3.246 0 0 1-6.492 0z"/>
</svg>
					        </span>
	                        <span class="nav-link-text">Settings</span>
				        </a><!--//nav-link-->
				    </li><!--//nav-item-->
					<?php } ?>
					<li class="nav-item">
				        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
				        <a <?php if($active == 8) { echo 'active'; }?>" class="nav-link" style='cursor:pointer;' id="logout">
					        <span class="nav-icon">
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
  <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
</svg>
					        </span>
	                        <span class="nav-link-text">Logout</span>
				        </a><!--//nav-link-->
				    </li><!--//nav-item-->
				    <li class="nav-item">
				        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
				        <a class="nav-link" href="../data-privacy">
					        <span class="nav-icon">
					            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-person" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" d="M12 1H4a1 1 0 0 0-1 1v10.755S4 11 8 11s5 1.755 5 1.755V2a1 1 0 0 0-1-1zM4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4z"/>
<path fill-rule="evenodd" d="M8 10a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
</svg>
					        </span>
	                        <span class="nav-link-text">License</span>
				        </a><!--//nav-link-->
				    </li><!--//nav-item-->
			    </ul><!--//footer-menu-->
		    </nav>
	    </div><!--//app-sidepanel-footer-->
       
    </div><!--//sidepanel-inner-->
</div><!--//app-sidepanel-->


<script>
	$(document).ready(function() {
		$(document).on('click', '#logout', function() {  
			$('#user_logout').modal('show');
		});

		
	});

	
</script>


