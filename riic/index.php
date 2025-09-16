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

		if($adda == 0) {
			header('location:signup');
		}
	}
?>

<!DOCTYPE html>
<html lang="en"> 
<head>
    <?php include("pages/head.php"); ?>
</head> 

<body class="app app-login p-0">    	
    <div class="row g-0 app-auth-wrapper">
	    <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
		    <div class="d-flex flex-column align-content-end">
			    <div class="app-auth-body mx-auto">	
				    <div class="app-auth-branding mb-4"><a class="app-logo" href="index.html"><img class="img-thumbnail" src="<?php echo MAIN_URL; ?>images/shinecagayan.png" alt="logo"></a></div>
					<h2 class="auth-heading text-center mb-5">Log in to SHINE Cagayan Valley</h2>
			        <div class="auth-form-container text-start">
			        	<div class="alert alert-danger text-center" style="display:none;" id="message"><span><strong>ACCESS DENIED!</strong> Invalid username or password.</span></div>
						<form class="auth-form login-form" id="loginAccount" method="POST">         
							<div class="email mb-3">
								<label class="sr-only" for="loginEmail">Email</label>
								<input id="loginEmail" name="loginEmail" type="email" class="form-control loginEmail" placeholder="Email address" required="required">
							</div><!--//form-group-->
							<div class="password mb-3">
								<label class="sr-only" for="loginPassword">Password</label>
								<input id="loginPassword" name="loginPassword" type="password" class="form-control loginPassword" placeholder="Password" required="required">
								<div class="extra mt-3 row justify-content-between">
									<div class="col-6">
										<div class="form-check">
											<input class="form-check-input" type="checkbox" value="" id="RememberPassword">
											<label class="form-check-label" for="RememberPassword">
											Remember me
											</label>
										</div>
									</div><!--//col-6-->
									<div class="col-6">
										<div class="forgot-password text-end">
											<a href="reset-password.html">Forgot password?</a>
										</div>
									</div><!--//col-6-->
								</div><!--//extra-->
							</div><!--//form-group-->
							<div class="text-center">
								<button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto"><i class="fas fa-sign-in-alt"></i> Log In</button>
							</div>
						</form>
						
						<div class="auth-option text-center pt-5">No Account? Sign up <a class="text-link" href="signup" >here</a>.</div>
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

        <script src="js/admin-login.js" type="text/javascript"></script>

</body>
</html> 

