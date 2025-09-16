$(document).ready(function() {

     // ADD SUC
    $("#user_account_form").on('submit', function(e) {
  
      e.preventDefault();
  
      var email_address = $('#email_address').val();
      var full_name = $('#full_name').val();
      var pass_word = $('#pass_word').val();
      var re_password = $('#re_password').val();

      if(email_address == "" && full_name == "" && pass_word == "") {
        swal({
            title: 'Warning',
            text: 'Email Address is required!',
            icon: 'error',
            buttons: false,
            closeOnClickOutside: false,
            closeOnEsc: false,
            timer: 2000
          })
      } else if(pass_word != re_password) {
        swal({
            title: 'Warning',
            text: 'Password do not match required!',
            icon: 'warning',
            buttons: false,
            closeOnClickOutside: false,
            closeOnEsc: false,
            timer: 2000
          })
      } else if((pass_word.length < 6) || (pass_word.length > 8)) {
        swal({
            title: 'Warning',
            text: 'Password should be at least 6 - 8 characters.',
            icon: 'warning',
            buttons: false,
            closeOnClickOutside: false,
            closeOnEsc: false,
            timer: 2000
          })
      } else {
  
        $.ajax({  
           url:"controller/add-account.php",  
           method:"POST",  
           data: $("#user_account_form").serialize(),
           beforeSend:function() {
            $('#save_account').attr('disabled', true);
           },
           success:function(response) {

              if(response == 0 || response == 2) {
                swal({
                  title: 'Error',
                  text: 'FAILED! User Account could not be saved or not found',
                  icon: 'error',
                  buttons: false,
                  closeOnClickOutside: false,
                  closeOnEsc: false,
                  timer: 2000
                })
              } else if(response == 1) {
                $('#user_account_form')[0].reset();
  
                swal({
                  title: 'Success',
                  text: 'SUCCESS! New User Account successfully saved.',
                  icon: 'success',
                  buttons: false,
                  closeOnClickOutside: false,
                  closeOnEsc: false,
                  timer: 3000
                }).then(function() {
                    $("#reloadContent").load(window.location.href + " #reloadContent");
                })
  
              } else if(response == 101) {
                $('#suc_form')[0].reset();
                $('#addUserAccount').modal('hide');
                
                swal({
                  title: 'Success',
                  text: 'SUCCESS! Changes made to this account has been successfully updated.',
                  icon: 'success',
                  buttons: false,
                  closeOnClickOutside: false,
                  closeOnEsc: false,
                  timer: 3000
                }).then(function() {
                    $("#reloadContent").load(window.location.href + " #reloadContent");
                })
              } else {
                alert("Error occured. Please try again.");
              }
  
              $('#save_account').attr('disabled', false);
              $('#full_name').focus();
  
           }  
        });
      }
    });

  
    $(document).on('click', '.close_modal', function() {    
      window.location.reload();
    });


    $(document).on('click', '.password_reset', function() {  
        $('#account_id').val($(this).attr('id'));

        $('#passwordReset').modal('show');
    });

    $(document).on('click', '.password_show', function() {  
      var code_id = $(this).attr('data-id');
      var subStr = (code_id.substring(0,code_id.length - 6));

      $('#passcode').html(subStr);
      $('#showPassword').modal('show');
    });
  
     // ADD SUC
     $("#user_reset_form").on('submit', function(e) {
  
      e.preventDefault();
  
      var pword = $('#pword').val();
      var repass_word = $('#repass_word').val();

      if(pword == "" && repass_word == "") {
        swal({
            title: 'Warning',
            text: 'All fields are required!',
            icon: 'error',
            buttons: false,
            closeOnClickOutside: false,
            closeOnEsc: false,
            timer: 2000
          })
      } else if(pword != repass_word) {
        swal({
            title: 'Warning',
            text: 'Password do not match!',
            icon: 'warning',
            buttons: false,
            closeOnClickOutside: false,
            closeOnEsc: false,
            timer: 2000
          })
      } else if((pword.length < 6) || (pword.length > 8)) {
        swal({
            title: 'Warning',
            text: 'Password should be at least 6 - 8 characters.',
            icon: 'warning',
            buttons: false,
            closeOnClickOutside: false,
            closeOnEsc: false, 
            timer: 2000
          })
      } else {
  
        $.ajax({  
           url:"controller/add-account.php",  
           method:"POST",  
           data: $("#user_reset_form").serialize(),
           beforeSend:function() {
            $('#save_password').attr('disabled', true);
           },
           success:function(response) {
            // alert(response);
              if(response == 0 || response == 2) {
                swal({
                  title: 'Error',
                  text: 'FAILED! Password could not be saved or not found',
                  icon: 'error',
                  buttons: false,
                  closeOnClickOutside: false,
                  closeOnEsc: false,
                  timer: 2000
                })
              } else if(response == 1) {
                $('#user_account_form')[0].reset();
  
                swal({
                  title: 'Success',
                  text: 'SUCCESS! Password successfully reset.',
                  icon: 'success',
                  buttons: false,
                  closeOnClickOutside: false,
                  closeOnEsc: false,
                  timer: 3000
                }).then(function() {
                    $("#reloadContent").load(window.location.href + " #reloadContent");
                })
  
              } else if(response == 101) {
                $('#user_reset_form')[0].reset();
                $('#passwordReset').modal('hide');

                swal({
                  title: 'Success',
                  text: 'SUCCESS! Changes made to this account has been successfully updated.',
                  icon: 'success',
                  buttons: false,
                  closeOnClickOutside: false,
                  closeOnEsc: false,
                  timer: 3000
                }).then(function() {
                    $("#reloadContent").load(window.location.href + " #reloadContent");
                })
              } else {
                alert("Error occured. Please try again.");
              }

              $('#user_reset_form')[0].reset();
              $('#save_password').attr('disabled', false);  
              $('#passwordReset').modal('hide');
           }  
        });
      }
    });

    
  
  });
  
  