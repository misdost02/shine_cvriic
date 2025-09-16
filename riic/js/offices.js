$(document).ready(function() {

  // ADD REGIONAL OFFICE
  $("#office_form").on('submit', function(e) {
    e.preventDefault();

    var officeName = $('#officeName').val();

    if(officeName == '') {
      swal({
        title: 'Warning',
        text: 'Please enter required field!',
        icon: 'error',
        buttons: false,
        closeOnClickOutside: false,
        closeOnEsc: false,
        timer: 2000
      });
    } else {
      $.ajax({  
           url:"controller/save-office.php",  
           method:"POST",  
           data: $("#office_form").serialize(),
           beforeSend:function() {
            $('#save_office').attr('disabled', true);
           },
           success:function(response) {
              if(response == 0) {
                swal({
                  title: 'Warning',
                  text: 'Regional Office is already exist. Please try again.',
                  icon: 'error',
                  buttons: false,
                  closeOnClickOutside: false,
                  closeOnEsc: false,
                  timer: 2000
                });
              } else if(response == 1) {
                $('#office_form')[0].reset();
                swal({
                  title: 'Success',
                  text: 'New Regional Office successfully saved.',
                  icon: 'success',
                  buttons: false,
                  closeOnClickOutside: false,
                  closeOnEsc: false,
                  timer: 2000
                }).then(function() {
                  $("#reloadContent").load(window.location.href + " #reloadContent");
                });
              } else {
                alert("Error occured. Please try again.");
              }

              $('#save_office').attr('disabled', false);
              $('#officeName').focus();
           }  
      });
    }
  });

  $('#fullname').typeahead({
    source: function(fullname, result) {
      $.ajax({
          url:"controller/search-personnel.php",
          method:"POST",
          data:{fullname:fullname},
          dataType:"json",
          success:function(data) {
          result($.map(data, function(item) {
              return item.personnel_id + " - " + item.firstname + " " + item.lastname;
            }));
          },
          
      });
    },
    afterSelect: function (item) {
        const str = item;
        const first = str.split(' - ')[0]
         $('#personnel_id').val(first);
         $('#fullname').val(str.split(' - ')[1]);
      },
  });
  
  // ADD REGIONAL OFFICER
  $("#officer_form").on('submit', function(e) {

    e.preventDefault();

    var officeID = $('#officeID').val();
    var officerName = $('#officerName').val();

    if(officeID == '' || officerName == '') {
      swal({
        title: 'Warning',
        text: 'Please enter required field!',
        icon: 'error',
        buttons: false,
        closeOnClickOutside: false,
        closeOnEsc: false,
        timer: 2000
      });
    } else {     
      $.ajax({  
           url:"controller/save-office.php",  
           method:"POST",  
           data: $("#officer_form").serialize(),
           beforeSend:function() {
            $('#save_officer').attr('disabled', true);
           },
           success:function(response) {
            // alert(response);
              if(response == 0) {
                swal({
                  title: 'Warning',
                  text: 'Regional Officer is already exist. Please try again.',
                  icon: 'error',
                  buttons: false,
                  closeOnClickOutside: false,
                  closeOnEsc: false,
                  timer: 2000
                });
              } else if(response == 1) {
                $('#officer_form')[0].reset();
                swal({
                  title: 'Success',
                  text: 'New Regional Officer successfully saved.',
                  icon: 'success',
                  buttons: false,
                  closeOnClickOutside: false,
                  closeOnEsc: false,
                  timer: 2000
                }).then(function() {
                  $("#reloadContent").load(window.location.href + " #reloadContent");
                });
              } else {
                alert("Error occured. Please try again.");
              }

              $('#save_officer').attr('disabled', false);
              $('#officerName').focus();
           }  
      });
    }
  });

});
