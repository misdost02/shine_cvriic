$(document).ready(function() {

  // ADD NEWA
  $("#partner_form").on('submit', function(e) {

    e.preventDefault();

    var partner_name = $('#partner_name').val();
    var partner_website = $('#partner_website').val();
  
    if(partner_name == "" || partner_website == "") {
      swal({
          title: 'Warning',
          text: 'Some fields are required!',
          icon: 'error',
          buttons: false,
          closeOnClickOutside: false,
          closeOnEsc: false,
          timer: 2000
        })
  
    } else {

      $.ajax({  
         url:"controller/save-misc.php",  
         method:"POST",  
         data: $("#partner_form").serialize(),
         beforeSend:function() {
          $('#save_partner').attr('disabled', true);
         },
         success:function(response) {
          // alert(response);
            if(response == 2) {
              swal({
                title: 'Warning',
                text: 'FAILED! Core Partner could not be saved.',
                icon: 'error',
                buttons: false,
                closeOnClickOutside: false,
                closeOnEsc: false,
                timer: 2000
              })
            } else if(response == 1) {
              $('#partner_form')[0].reset();

              swal({
                title: 'Success',
                text: 'SUCCESS! New Core Partner successfully saved.',
                icon: 'success',
                buttons: false,
                closeOnClickOutside: false,
                closeOnEsc: false,
                timer: 3000
              }).then(function() {
                // window.location.reload();
                $("#reloadContent").load(window.location.href + " #reloadContent");
              })

            } else if(response == 0) {
              swal({
                title: 'Warning',
                text: 'Warning! Core Partner is already on the list. Please try again.',
                icon: 'error',
                buttons: false,
                closeOnClickOutside: false,
                closeOnEsc: false,
                timer: 3000
              })
            } else {
              alert("Error occured. Please try again.");
            }

            $('#save_partner').attr('disabled', false);
            $('#partner_name').focus();

         }  
      });
    }
  });


  $(document).on('click', '.close_modal', function() {  

    window.location.reload();
    
  });


});

