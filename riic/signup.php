<?php
	session_start();
	include("../config/config.php");
	include("controller/check-user.php");
    if(isset($_SESSION['adminemail']) && isset($_SESSION['adminid'])) {
        echo "<script type='text/javascript'>
            alert('You are currently logged-in.')
            window.location = 'home'
        </script>";
    } else {
		$adda = checkRegisteredUser($conn);

		if($adda == 1) {
			header('location:https://www.cvriics.com/riic/');
		}
	}
?>

<!DOCTYPE html>
<html lang="en"> 
<head>
<?php include("pages/head.php"); ?>
</head> 

<body class="app app-signup p-0">    	
    <div class="row g-0 app-auth-wrapper">
	    <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
		    <div class="d-flex flex-column align-content-end">
			    <div class="app-auth-body mx-auto">	
				    <div class="app-auth-branding mb-4"><a class="app-logo" href="<?php echo MAIN_URL; ?>"><img class="img-thumbnail" src="<?php echo MAIN_URL; ?>images/shinecagayan.png" alt="logo"></a></div>
					<h2 class="auth-heading text-center mb-4">Sign up to SHINE Cagayan Valley</h2>		
	
					<div class="auth-form-container text-start mx-auto">
						<div class="alert alert-danger text-center alert-dismissible fade show" style="display:none;" id="message"></div>
						<form class="auth-form auth-signup-form" id="registerAccount" method="POST">         
							<div class="email mb-3">
								<label class="sr-only" for="signupFullname">Your Name</label>
								<input id="signupFullname" name="signupFullname" type="text" class="form-control signupFullname" placeholder="Full name" required="required">
							</div>
							<div class="email mb-3">
								<label class="sr-only" for="signupEmail">Your Email</label>
								<input id="signupEmail" name="signupEmail" type="email" class="form-control signupEmail" placeholder="Email address" required="required">
							</div>
							<div class="password mb-3">
								<label class="sr-only" for="signupPassword">Password</label>
								<input id="signupPassword" name="signupPassword" type="password" class="form-control signupPassword" placeholder="Create a password" required="required">
							</div>
							<div class="password mb-3">
								<label class="sr-only" for="signupRepassword">Re-type password</label>
								<input id="signupRepassword" name="signupRepassword" type="password" class="form-control signupRepassword" placeholder="Retype your password" required="required">
							</div>
							<div class="extra mb-3">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" id="rememberPassword">
									<label class="form-check-label" for="rememberPassword">
									I agree to SHINE's <a href="#" class="app-link">Terms of Service</a> and <a href="#" class="app-link">Privacy Policy</a>.
									</label>
								</div>
							</div><!--//extra-->
							
							<div class="text-center">
								<button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto"><i class="fas fa-check"></i> Register Account</button>
							</div>
						</form><!--//auth-form-->
						
						<div class="auth-option text-center pt-3">Already have an account? <a class="text-link" href="<?php echo MAIN_ADMIN_URL; ?>">Log in</a></div>
					</div><!--//auth-form-container-->	
					
					
				    
			    </div><!--//auth-body-->
		    
			    <footer class="app-auth-footer">
				    <div class="container text-center py-3">
				         <!--/* This template is free as long as you keep the footer attribution link. If you'd like to use the template without the attribution link, you can buy the commercial license via our website: themes.3rdwavemedia.com Thank you for your support. :) */-->
			        <small class="copyright">Copyright <i class="fas fa-copyright" style="color: #fb866a;"></i> 2021-<?php echo date("Y");?> by RIIC 02. All rights reserved. | Developed by <i class="fas fa-code" style="color: #fb866a;"></i> by <a class="app-link" href="https://www.facebook.com/vilchor.perdido/" target="_blank">Vilchor Perdido</a></small>
				       
				    </div>
			    </footer><!--//app-auth-footer-->	
		    </div><!--//flex-column-->   
	    </div><!--//auth-main-col-->
	    <div class="col-12 col-md-5 col-lg-6 h-100 auth-background-col">
		    <div class="auth-background-holder">			    
		    </div>
		    <div class="auth-background-mask"></div>
		    <div class="auth-background-overlay p-3 p-lg-5">
			    <div class="d-flex flex-column align-content-end h-100">
				    <div class="h-100"></div>
				    <div class="overlay-content p-3 p-lg-4 rounded">
					    <h5 class="mb-3 overlay-title">Explore SHINE Cagayan Valley Portal</h5>
					    <div>SHINE Cagayan Valley will serve as a convergence mechanism aimed at strengthening the capacity for innovation across government, academia and industry for inclusive growth for Region 2. It is anchored on the citrus sector as its pilot industry, with the banana sector next in line for the replication of best practices and convergence models. As with pilot RIICs sites, it is implemented through the MLA approach—mapping players and capacities, strengthening linkages, and aligning with the needs of local industries.</div>
				    </div>
				</div>
		    </div><!--//auth-background-overlay-->
	    </div><!--//auth-background-col-->
    
    </div><!--//row-->

    <script src="js/admin-register.js" type="text/javascript"></script>
</body>
</html> 

