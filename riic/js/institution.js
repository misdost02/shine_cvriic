$(document).ready(function() {

     // ADD SUC
    $("#suc_form").on('submit', function(e) {
  
      e.preventDefault();
  
      var institution_name = $('#institution_name').val();

      if(institution_name == "") {
        swal({
            title: 'Warning',
            text: 'SUC name is required!',
            icon: 'error',
            buttons: false,
            closeOnClickOutside: false,
            closeOnEsc: false,
            timer: 2000
          })
      } else {
  
        $.ajax({  
           url:"controller/add-suc.php",  
           method:"POST",  
           data: $("#suc_form").serialize(),
           beforeSend:function() {
            $('#save_suc').attr('disabled', true);
           },
           success:function(response) {

              if(response == 0 || response == 2) {
                swal({
                  title: 'Warning',
                  text: 'FAILED! SUC could not be saved or not found',
                  icon: 'error',
                  buttons: false,
                  closeOnClickOutside: false,
                  closeOnEsc: false,
                  timer: 2000
                })
              } else if(response == 1) {
                $('#suc_form')[0].reset();
  
                swal({
                  title: 'Success',
                  text: 'SUCCESS! New SUC successfully saved.',
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
                $('#addSchool').modal('hide');
                
                swal({
                  title: 'Success',
                  text: 'SUCCESS! Changes made to this SUC has been successfully updated.',
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
  
              $('#save_suc').attr('disabled', false);
              $('#institution_name').focus();
  
           }  
        });
      }
    });

  
    $(document).on('click', '.close_modal', function() {    
      window.location.reload();
    });


    $(document).on('click', '.add_campus', function() {  
        $('#suc_id').val($(this).attr('id'));

        $('#addCampus').modal('show');
    });
  

    // ADD SUC
    $("#suc_campus_form").on('submit', function(e) {
  
        e.preventDefault();
    
        var campus_name = $('#campus_name').val();
  
        if(institution_name == "") {
          swal({
              title: 'Warning',
              text: 'Campus name is required!',
              icon: 'error',
              buttons: false,
              closeOnClickOutside: false,
              closeOnEsc: false,
              timer: 2000
            })
        } else {
    
          $.ajax({  
             url:"controller/add-suc.php",  
             method:"POST",  
             data: $("#suc_campus_form").serialize(),
             beforeSend:function() {
              $('#save_suc_campus').attr('disabled', true);
             },
             success:function(response) {
  
                if(response == 0 || response == 2) {
                  swal({
                    title: 'Warning',
                    text: 'FAILED! SUC Campus could not be saved or already exists',
                    icon: 'error',
                    buttons: false,
                    closeOnClickOutside: false,
                    closeOnEsc: false,
                    timer: 2000
                  })
                } else if(response == 1) {

                  swal({
                    title: 'Success',
                    text: 'SUCCESS! New SUC Campus successfully saved.',
                    icon: 'success',
                    buttons: false,
                    closeOnClickOutside: false,
                    closeOnEsc: false,
                    timer: 3000
                  }).then(function() {
                      $("#reloadContent").load(window.location.href + " #reloadContent");
                  })
    
                } else if(response == 101) {
                  $('#suc_campus_form')[0].reset();
                  $('#addCampus').modal('hide');
                  
                  swal({
                    title: 'Success',
                    text: 'SUCCESS! Changes made to this SUC Campus has been successfully updated.',
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
    
                $('#save_suc_campus').attr('disabled', false);
                $('#campus_name').focus();
    
             }  
          });
        }
      });
  
  
  });
  
  