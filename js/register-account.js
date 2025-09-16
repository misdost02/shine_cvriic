
$(document).ready(function() {
  
  // REGISTER ACCOUNT
  $("#register_form").on('submit', function(e) { 
    e.preventDefault();

    var register_password = $('#register_password').val();
    var register_repassword = $('#register_repassword').val();
    var register_agreement = $('#register_agreement').val();
    var register_username = $('#register_username').val();

    if(register_password != register_repassword) {
      swal({
        title: 'Error',
        text: 'Password do not matched.',
        icon: 'error',
        buttons: false,
        closeOnClickOutside: false,
        closeOnEsc: false,
        timer: 2000
      })
    } else if(register_username.length < 6 || register_username.length > 12) {
      swal({
        title: 'Error',
        text: 'Username should at least 6 - 12 characters.',
        icon: 'error',
        buttons: false,
        closeOnClickOutside: false,
        closeOnEsc: false,
        timer: 2000
      })
    } else if(register_password.length < 6 || register_password.length > 8) {
      swal({
        title: 'Error',
        text: 'Password should at least 6 - 8 characters.',
        icon: 'error',
        buttons: false,
        closeOnClickOutside: false,
        closeOnEsc: false,
        timer: 2000
      })
    } else if(register_agreement == "") {
      swal({
        title: 'Warning',
        text: 'You should agree with the terms and agreement.',
        icon: 'error',
        buttons: false,
        closeOnClickOutside: false,
        closeOnEsc: false,
        timer: 2000
      })
    } else {
      $.ajax({  
        url:"controller/register-account.php",  
        method:"POST",  
        data: $('#register_form').serialize(),   
        beforeSend:function() {
          $('#register_account').attr('disabled', true);
        },
        success:function(response) {
          if(response == 200) {
            $('#modalRegister').modal('hide');
            $('#register_form')[0].reset();
            swal({
              title: 'Success',
              text: 'Account successfully created. You can now login.',
              icon: 'success',
              buttons: false,
              closeOnClickOutside: false,
              closeOnEsc: false,
              timer: 2000
            }).then(function() {
              $('#modalLogin').modal('show');
            });
          } else if(response == 1) {
            swal({
              title: 'Warning',
              text: 'Username already exists. Please try again.',
              icon: 'warning',
              buttons: false,
              closeOnClickOutside: false,
              closeOnEsc: false,
              timer: 3000
            })
          } else {
            swal({
              title: 'Warning',
              text: 'FAILED! Account could not saved. Please try again.',
              icon: 'warning',
              buttons: false,
              closeOnClickOutside: false,
              closeOnEsc: false,
              timer: 2000
            })
          }

          $('#register_account').attr('disabled', false);
        }
      });
    }
  });

  // LOGIN ACCOUNT
  $("#login_form").on('submit', function(e) { 
    e.preventDefault();

    var login_username = $('#login_username').val();
    var login_password = $('#login_password').val();

    if(login_username == "" || login_password == "") {
      swal({
        title: 'Error',
        text: 'Username and password are required.',
        icon: 'error',
        buttons: false,
        closeOnClickOutside: false,
        closeOnEsc: false,
        timer: 2000
      })
    } else {
      $.ajax({  
        url:"controller/register-account.php",  
        method:"POST",  
        data: $('#login_form').serialize(),   
        beforeSend:function() {
          $('#login_account').attr('disabled', true);
        },
        success:function(response) {
          //alert(response);
          if(response == 200) {
            $('#modalLogin').modal('hide');
            $('#login_form')[0].reset();
            swal({
              title: 'Success',
              text: 'You successfully logged in.',
              icon: 'success',
              buttons: false,
              closeOnClickOutside: false,
              closeOnEsc: false,
              timer: 2000
            }).then(function() {
              window.location.reload();
            });
          } else if(response == 0) {
            swal({
              title: 'Warning',
              text: 'Username or password is incorrect or your account has been disabled. Please try again.',
              icon: 'warning',
              buttons: false,
              closeOnClickOutside: false,
              closeOnEsc: false,
              timer: 3000
            })
          } else {
            swal({
              title: 'Warning',
              text: 'FAILED! Account could not found. Please try again.',
              icon: 'warning',
              buttons: false,
              closeOnClickOutside: false,
              closeOnEsc: false,
              timer: 2000
            })
          }

          $('#login_account').attr('disabled', false);
        }
      });
    }
  });


});