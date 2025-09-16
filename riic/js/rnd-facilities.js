$(document).ready(function() {

  // ADD HEI PERSONNEL
  $("#rnd_facilities_form").on('submit', function(e) {

    e.preventDefault();

    var personnel_id = $('#personnel_id').val();
    var rnd_facility = $('#rnd_facility').val();
    var sectors = $('#sel_sectors').val();

    if(personnel_id == "" ) {
      swal({
          title: 'Warning',
          text: 'No client is selected. Please select or search personnel to continue!',
          icon: 'error',
          buttons: false,
          closeOnClickOutside: false,
          closeOnEsc: false,
          timer: 2000
        });
    } else if(sectors == "" ) {
      swal({
          title: 'Warning',
          text: 'No SECTOR field is selected. Please select at least one.',
          icon: 'error',
          buttons: false,
          closeOnClickOutside: false,
          closeOnEsc: false,
          timer: 2000
        })
    } else if(rnd_facility == "" ) {
      swal({
          title: 'Warning',
          text: 'No R & D facility is selected. Please select at least one.',
          icon: 'error',
          buttons: false,
          closeOnClickOutside: false,
          closeOnEsc: false,
          timer: 2000
        });
    } else {

      $.ajax({  
         url:"controller/save-facilities.php",  
         method:"POST",  
         data: $("#rnd_facilities_form").serialize(),
         beforeSend:function() {
          $('#save_facility').attr('disabled', true);
         },
         success:function(response) {
            if(response == 0 || response == 2) {
              swal({
                title: 'Warning',
                text: 'FAILED! R&D Facility could not be saved or not found',
                icon: 'error',
                buttons: false,
                closeOnClickOutside: false,
                closeOnEsc: false,
                timer: 2000
              })
            } else if(response == 1) {
              $('#rnd_facilities_form')[0].reset();

              swal({
                title: 'Success',
                text: 'SUCCESS! New R&D Facility successfully saved.',
                icon: 'success',
                buttons: false,
                closeOnClickOutside: false,
                closeOnEsc: false,
                timer: 3000
              }).then(function() {
                $("#reloadContent").load(window.location.href + " #reloadContent");
              });

            } else if(response == 101) {
              // $('#rnd_facilities_form')[0].reset();
              swal({
                title: 'Warning',
                text: 'WARNING! R&D Facility is already on the list. Please try again.',
                icon: 'error',
                buttons: false,
                closeOnClickOutside: false,
                closeOnEsc: false,
                timer: 2000
              });
            } else {
              alert("Error occured. Please try again.");
            }

            $('#save_facility').attr('disabled', false);
            $('#fullname').focus();
         }  
      });
    }
  });

  $(document).on('click', '.close_modal', function() {  

    window.location.reload();
    
  });



  $(document).on('click', '.view_rnd', function() {  
    $('#lab_id').val($(this).attr('id'));
    $('#lab_rndid').val($(this).attr('id'));

    var rnd_id = $(this).attr('id');

    $.ajax({  
      url:"controller/search-facility.php",  
      method:"POST",  
      data: {rnd_id:rnd_id},
      dataType: 'json',
      success:function(response) {
        var len = response.length;
        $('#table_data').empty();

        for(var i = 0; i<len; i++){
            var facility_unit_name = response[i]['facility_unit_name'];
            var facility_service_desc = response[i]['facility_service_desc'];

            $('#table_data').append('<tr><td>'+(i+1)+'</td><td><b>'+facility_unit_name+'</b></td><td>'+facility_service_desc+'</td></tr>');
        }

        $('#viewRND').modal('show');
        $('#addRNDunit').modal('hide');
      }
    });

  });

  $(document).on('click', '.add_new', function() {  
    
    
    if($('#lab_id').val() != "") {
      $('#lab_id').val($('#lab_rndid').val());
    } else {
      $('#lab_id').val($(this).attr('id'));
    }

    $('#viewRND').modal('hide');
    $('#addRNDunit').modal('show');
  });

  // ADD HEI PERSONNEL
  $("#rnd_units_form").on('submit', function(e) {
    e.preventDefault();

    var rnd_id = $('#lab_id').val();
    var unit_name = $('#unit_name').val();
    var service_name = $('#service_name').val();


    if(rnd_id == "") {
      swal({
          title: 'Warning',
          text: 'No laboratory is selected. Please select facility to continue!',
          icon: 'error',
          buttons: false,
          closeOnClickOutside: false,
          closeOnEsc: false,
          timer: 2000
        });
    } else if(unit_name == "" || service_name == "") {
      swal({
          title: 'Warning',
          text: 'Some fields are missiong. Please enter data.',
          icon: 'error',
          buttons: false,
          closeOnClickOutside: false,
          closeOnEsc: false,
          timer: 2000
        });
    } else {
      $.ajax({  
         url:"controller/save-facilities.php",  
         method:"POST",  
         data: $("#rnd_units_form").serialize(),
         beforeSend:function() {
          $('#save_unit').attr('disabled', true);
         },
         success:function(response) {
            if(response == 0 || response == 2) {
              swal({
                title: 'Warning',
                text: 'FAILED! R&D Facility could not be saved or not found',
                icon: 'error',
                buttons: false,
                closeOnClickOutside: false,
                closeOnEsc: false,
                timer: 2000
              })
            } else if(response == 1) {
              $('#unit_name').val("");
              $('#service_name').val("");

              swal({
                title: 'Success',
                text: 'SUCCESS! New R&D Facility Unit successfully saved.',
                icon: 'success',
                buttons: false,
                closeOnClickOutside: false,
                closeOnEsc: false,
                timer: 3000
              })

            } else if(response == 101) {
              // $('#rnd_facilities_form')[0].reset();
              swal({
                title: 'Warning',
                text: 'WARNING! R&D Facility Unit is already on the list. Please try again.',
                icon: 'error',
                buttons: false,
                closeOnClickOutside: false,
                closeOnEsc: false,
                timer: 2000
              });
            } else {
              alert("Error occured. Please try again.");
            }

            $('#save_unit').attr('disabled', false);
            $('#unit_name').focus();
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

  $('#rnd_facility').typeahead({
    source: function(rnd_facility, result) {
      $.ajax({
          url:"controller/search-facility.php",
          method:"POST",
          data:{rnd_facility:rnd_facility},
          dataType:"json",
          success:function(data) {
          result($.map(data, function(item) {
              return item.facility_name;
            }));
          },
          
      });
    },
    afterSelect: function (item) {
      
    },
  });

  $('#unit_name').typeahead({
    source: function(unit_name, result) {
      $.ajax({
          url:"controller/search-facility.php",
          method:"POST",
          data:{unit_name:unit_name},
          dataType:"json",
          success:function(data) {
          result($.map(data, function(item) {
              return item.unit_name;
            }));
          },
          
      });
    },
    afterSelect: function (item) {
      
    },
  });

});


function getSector() {  
      var sector = document.querySelectorAll('input[name="sector[]"]:checked');
    var sec = [];
    for(var ctr = 0, len = sector.length; ctr < len;  ctr++) {
        sec.push(sector[ctr].value);
    }

    var str = sec.join(', ');
    $('#sel_sectors').val(str); 
  }
  function getType() {  
      var typeints = document.querySelectorAll('input[name="typeints[]"]:checked');
    var typein = [];
    for(var ctr = 0, len = typeints.length; ctr < len;  ctr++) {
        typein.push(typeints[ctr].value);
    }

    var str = typein.join(', ');
    $('#sel_type').val(str); 
  } 


