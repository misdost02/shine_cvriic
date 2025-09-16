
$(document).ready(function() {
    register_account();
});


function register_account() {

    $("#registerAccount").on('submit', function(e) {

      e.preventDefault();

      var signupFullname = $('#signupFullname').val();
      var signupEmail = $('#signupEmail').val();
      var signupPassword = $('#signupPassword').val();
      var signupRepassword = $('#signupRepassword').val();
      var rememberPassword = $('#rememberPassword').val();
    
      if(signupEmail.length < 6) {
        $("#message").show().fadeIn();
        $("#message").html("<button type='button' class='btn-close' data-bs-dismiss='alert'></button><span>Email address must be at least 6 characters.</span>");
      } else if(signupPassword.length < 6) {
        $("#message").show().fadeIn();
        $("#message").html("<button type='button' class='btn-close' data-bs-dismiss='alert'></button><span>Password must be at least 6 characters.</span>");
      } else if (signupPassword !=  signupRepassword) {
        $("#message").show().fadeIn();
        $("#message").html("<button type='button' class='btn-close' data-bs-dismiss='alert'></button><span>Password do not match.</span>");
      } else {
        if(document.getElementById('rememberPassword').checked) {
          var datastring = $("form[id='registerAccount']").serialize();

          $.ajax({  
               url:"controller/admin-register.php",  
               method:"POST",  
               data: datastring,
               dataType: 'html', 
               success:function(response) {
                  if(response == 1) {
                    $("#message").show().fadeIn();
                    $("#message").html("<button type='button' class='btn-close' data-bs-dismiss='alert'></button><span><strong>WARNING!</strong> Email address already registered. Please try another one.</span>");
                  } else if(response == 0) {
                    $("#message").show().fadeIn();
                    $("#message").html("<button type='button' class='btn-close' data-bs-dismiss='alert'></button><span class='text-success'><strong>SUCCESS!</strong> Account successfully registered. You can now login.</span>");
                  }

                  $('#signupFullname').val('');
                  $('#signupEmail').val('');
                  $('#signupPassword').val('');
                  $('#signupRepassword').val('');
                  document.getElementById('rememberPassword').checked = "";
               }  
          });
        } else {
          $("#message").show().fadeIn();
          $("#message").html("<button type='button' class='btn-close' data-bs-dismiss='alert'></button><span>Please agree to the Terms and Conditions to continue.</span>");
        }
      }
    });
}
