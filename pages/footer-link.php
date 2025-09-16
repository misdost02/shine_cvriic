<footer id="footer">
  <div class="footer-top">
    <div class="container">
      <div class="row">

        <div class="col-lg-3 col-md-6 footer-info">
          <h3>SHINE Cagayan Valley</h3>
          <p>SHINE Cagayan Valley will serve as a convergence mechanism aimed at strengthening the capacity for innovation across government, academia and industry for inclusive growth for Region 2. It is anchored on the citrus sector as its pilot industry, with the banana sector next in line for the replication of best practices and convergence models.</p>
        </div>

        <div class="col-lg-3 col-md-6 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="<?php echo BASE_URL; ?>">Home</a></li>
            <li><a href="about-us">About us</a></li>
            <li><a href="innovation-database?e8c4600bd6473d80d233fa89ef4fdb2d1a0f39d8">Innovation Database</a></li>
            <li><a href="privacy-policy">Terms of service</a></li>
            <li><a href="privacy-policy">Privacy policy</a></li>
            <li><a href="#">Join Us</a></li>
          </ul>
        </div>

        <div class="col-lg-3 col-md-6 footer-contact">
          <h4>Contact Us</h4>
          <p>
            Don Mariano Perez <br>
            Bayombong, Nueva Vizcaya<br>
            Philippines 3700<br>
            <!-- <strong>Phone:</strong> (078) 321-1111<br> -->
            <strong>Email:</strong> info@cvriics.com<br>
          </p>

          <div class="social-links">
            <!-- <a href="#" class="twitter"><i class="bi bi-twitter"></i></a> -->
            <a href="https://www.facebook.com/SHINECagayanValley" class="facebook"><i class="bi bi-facebook"></i></a>
            <!-- <a href="#" class="instagram"><i class="bi bi-instagram"></i></a> -->
            <!-- <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a> -->
          </div>

        </div>

        <div class="col-lg-3 col-md-6 footer-newsletter">
          <h4>Our Newsletter</h4>
          <p>Be a critical platform for a network of government agencies, industry players, enablers, innovators, and researchers to share expertise and resources to meet the important needs of our region.</p>
          <!-- <form action="" method="post">
            <input type="email" name="email"><input type="submit" value="Subscribe">
          </form> -->
        </div>

      </div>
    </div>
  </div>

  <div class="container">
    <div class="copyright">
      &copy; Copyright <strong><span>SHINE Cagayan Valley 2021</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/serenity-bootstrap-corporate-template/ -->
      Designed by <a href="https://www.nvsu.edu.ph/">Nueva Vizcaya State University</a>
    </div>
  </div>
</footer>


<div class="modal fade" id="modalLogin" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header jusity-content-center">
        <h2 class="modal-title text-center">Login</h2>
      </div>
      <div class="modal-body">
        <form action="" method="post" id="login_form">
          <p class="hint-text">Please enter your registered account.</p>
          <div class="form-group mb-3">
            <input type="text" class="form-control" name="login_username" placeholder="Username" required="required">
          </div>
          <div class="form-group mb-4">
              <input type="password" class="form-control" name="login_password" placeholder="Password" required="required">
              <div class="row justify-content-right">
                <div class="col justify-text-right">
                  <small class="text-right"><a href="#">Forgot Password?</a></small>
                </div>
              </div>
          </div>       
          <div class="form-group mb-3">
            <button type="submit" class="btn btn-success btn-md w-100 mb-2" id="login_account">Login Account</button>
            <button type="button" class="btn btn-danger btn-md w-100" data-bs-dismiss="modal">Cancel</button>
          </div>
          </form>
      </div>
      <div class="modal-footer justify-content-center bg-light"> 
        <small>No account yet? <a class="btn-link" id="magregister" style ='cursor:pointer;'>Signup now!</a></small>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalRegister" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">Register</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post" id="register_form">
          <p class="hint-text">Create your account. It's free and only takes a minute.</p>
              <div class="form-group mb-3">
                <div class="row">
                  <div class="col"><input type="text" class="form-control" id="register_fname" name="register_fname" placeholder="First Name" required="required"></div>
                  <div class="col"><input type="text" class="form-control" id="register_lname" name="register_lname" placeholder="Last Name" required="required"></div>
                </div>        	
              </div>
              <div class="form-group mb-3">
                <select class="form-control" id="register_type" name="register_type" required="required">
                  <option value="">--You are a or an--</option>
                  <option value="Researcher">Researcher</option>
                  <option value="Agriculturist">Agriculturist</option>
                  <option value="Businessman">Businessman</option>
                  <option value="Employee">Manager</option>
                  <option value="Employee">Employee</option>
                  <option value="Teacher">Teacher</option>
                  <option value="Student">Student</option>
                  <option value="Others">Others</option>
                </select>
              </div>
              <div class="form-group mb-3">
                <input type="text" class="form-control" id="register_username" name="register_username" placeholder="Desired username" required="required">
              </div>
              <div class="form-group mb-3">
                  <input type="password" class="form-control" id="register_password" name="register_password" placeholder="Password" required="required">
              </div>
              <div class="form-group mb-4">
                  <input type="password" class="form-control" id="register_repassword" name="register_repassword" placeholder="Confirm Password" required="required">
              </div>        
              <div class="form-group mb-3 text-center">
                <label class="form-check-label"><input type="checkbox" required="required"  id="register_agreement" name="register_agreement">&nbsp;I accept the <a href="#">Terms of Use</a> &amp; <a href="#">Privacy Policy</a></label>
              </div>
              <div class="form-group mb-3">
                <button type="submit" class="btn btn-success btn-md w-100 mb-2" id="register_account">Create Account</button>
                <button type="button" class="btn btn-danger btn-md w-100" data-bs-dismiss="modal">Cancel</button>
              </div>
          </form>
      </div>
      <div class="modal-footer justify-content-center">
        <small>Have account? <a class="btn-link" id="maglogin" style ='cursor:pointer;'>Signin now!</a></small>
      </div>

    </div>
  </div>
</div>   

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="assets/js/jquery.min.js"></script>

<script type="text/javascript">

  $(document).ready(function() {

    $(document).on('click', '.visitor_logout', function() {  

      var visitorid = $(this).attr('id');

        $.ajax({  
          url:"controller/register-account.php",  
          method:"POST",  
          data: {visitorid:visitorid},
          success:function(response) {
            swal({
                title: 'Success',
                text: 'You have been logged out.',
                icon: 'success',
                buttons: false,
                closeOnClickOutside: false,
                closeOnEsc: false,
                timer: 2000
              }).then(function() {
                window.location.reload();
              });
          },
      });
    });
  });

  $(document).on('click', '.close_modal', function() {  
    // window.location.reload();
    $(".modal-body-content").load(window.location.href + " .modal-body-content");
  });
  
</script>


