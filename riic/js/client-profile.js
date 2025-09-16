$(document).ready(function() {

  // EDIT PROFILE
  
  $("#province").change(function() {
    var deptid = $(this).val();

    $.ajax({
        url: 'controller/getTown.php',
        type: 'POST',
        data: {depart:deptid},
        dataType: 'json',
        success:function(response){

            var len = response.length;

            $("#town").empty();
            $("#town").append("<option value=''>Select</option>");
            for(var i = 0; i<len; i++){
                var citymunCode = response[i]['citymunCode'];
                var citymunDesc = response[i]['citymunDesc'];

                $("#town").append("<option value='"+citymunCode+"'>"+citymunDesc+"</option>");

            }

            $('#town').attr('disabled', false);
            // if(len >= 1) {
            //     document.getElementById('permatownhidden').value = response[0]['citymunDesc'];
            // } else {
            //     document.getElementById('permatownhidden').value = "";
            // }
        }
    });
  });

  $("#town").change(function() {
    var townid = $(this).val();

    $.ajax({
        url: 'controller/getTown.php',
        type: 'POST',
        data: {townid:townid},
        dataType: 'json',
        success:function(response){

            var len = response.length;

            $("#barangay").empty();
            $("#barangay").append("<option value=''>Select</option>");
            for(var x = 0; x<len; x++){
                var brgyCode = response[x]['brgyCode'];
                var brgyDesc = response[x]['brgyDesc'];

                $("#barangay").append("<option value='"+brgyCode+"'>"+brgyDesc+"</option>");

            }

            $('#barangay').attr('disabled', false);
        }
    });
  });

  // Get Campuses
  $("#institution").change(function() {
    var schoolid = $(this).val();

    $.ajax({
        url: 'controller/getTown.php',
        type: 'POST',
        data: {schoolid:schoolid},
        dataType: 'json',
        success:function(response){

            var len = response.length;

            $("#campus").empty();
            $("#campus").append("<option value=''>---</option>");
            for(var i = 0; i<len; i++){
                var campus_id = response[i]['campus_id'];
                var campus_name = response[i]['campus_name'];

                $("#campus").append("<option value='"+campus_id+"'>"+campus_name+"</option>");
            }

            if(len > 0) {
              $('#campus').attr('disabled', false);
            } else {
              $('#campus').attr('disabled', true);
            }
            
        }
    });
  });


  // ADD CLIENT
  $("#client_form").on('submit', function(e) {

    e.preventDefault();

    var firstname = $('#firstname').val();
    var lastname = $('#lastname').val();
    var landline = $('#landline').val();
    var mobile = $('#mobile').val();
    if(firstname == "" || lastname == "") {
      swal({
          title: 'Warning',
          text: 'All fields are required!',
          icon: 'error',
          buttons: false,
          closeOnClickOutside: false,
          closeOnEsc: false,
          timer: 2000
        })
  
    } else if(landline == "" && mobile == "") {
      swal({
          title: 'Warning',
          text: 'Please input landline or mobile number.',
          icon: 'error',
          buttons: false,
          closeOnClickOutside: false,
          closeOnEsc: false,
          timer: 2000
        })
  
    } else {

      $.ajax({  
         url:"controller/save-client.php",  
         method:"POST",  
         data: $("#client_form").serialize(),
         beforeSend:function() {
          $('#save_client').attr('disabled', true);
         },
         success:function(response) {
          //alert(response);
            if(response == 0 || response == 2) {
              swal({
                title: 'Warning',
                text: 'FAILED! Profile could not be saved or not found',
                icon: 'error',
                buttons: false,
                closeOnClickOutside: false,
                closeOnEsc: false,
                timer: 2000
              })
            } else if(response == 1) {
              $('#client_form')[0].reset();

              swal({
                title: 'Success',
                text: 'SUCCESS! Profile client successfully saved.',
                icon: 'success',
                buttons: false,
                closeOnClickOutside: false,
                closeOnEsc: false,
                timer: 3000
              }).then(function() {
                // window.location.reload();
                $("#reloadContent").load(window.location.href + " #reloadContent");
              })

            } else if(response == 101) {
              $('#client_form')[0].reset();
              $('#addClient').modal('hide');
              
              swal({
                title: 'Success',
                text: 'SUCCESS! Changes made to Profile Data has been successfully updated.',
                icon: 'success',
                buttons: false,
                closeOnClickOutside: false,
                closeOnEsc: false,
                timer: 3000
              }).then(function() {
                $("#reloadContent").load(window.location.href + " #reloadContent");
                //window.location.reload();
              })
            } else {
              alert("Error occured. Please try again.");
            }

            $('#save_client').attr('disabled', false);
            $('#firstname').focus();

         }  
      });
    }
  });

  // ADD HEI PERSONNEL
  $("#hei_client_form").on('submit', function(e) {

    e.preventDefault();

    var personnel_id = $('#personnel_id').val();
    var sectors = $('#sel_sectors').val();
    var institution_type = $('#sel_type').val();
    
    if(personnel_id == "" ) {
      swal({
          title: 'Warning',
          text: 'No profile is selected. Please select or search personnel to continue!',
          icon: 'error',
          buttons: false,
          closeOnClickOutside: false,
          closeOnEsc: false,
          timer: 2000
        })
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
    } else if(institution_type == "" ) {
      swal({
          title: 'Warning',
          text: 'No TYPE OF INSTITUTION is selected. Please select at least one.',
          icon: 'error',
          buttons: false,
          closeOnClickOutside: false,
          closeOnEsc: false,
          timer: 2000
        })
    } else {

      $.ajax({  
         url:"controller/save-client.php",  
         method:"POST",  
         data: $("#hei_client_form").serialize(),
         beforeSend:function() {
          $('#save_client').attr('disabled', true);
         },
         success:function(response) {
            if(response == 0 || response == 2) {
              swal({
                title: 'Warning',
                text: 'FAILED! HEI Personnel could not be saved or not found',
                icon: 'error',
                buttons: false,
                closeOnClickOutside: false,
                closeOnEsc: false,
                timer: 2000
              })
            } else if(response == 1) {
              $('#hei_client_form')[0].reset();

              swal({
                title: 'Success',
                text: 'SUCCESS! HEI Personnel successfully saved.',
                icon: 'success',
                buttons: false,
                closeOnClickOutside: false,
                closeOnEsc: false,
                timer: 3000
              }).then(function() {
                // window.location.reload();
                $("#reloadContent").load(window.location.href + " #reloadContent");
              })

            } else if(response == 101) {
              $('#hei_client_form')[0].reset();

              swal({
                title: 'Warning',
                text: 'FAILED! HEI Personnel is already on the list. Please try again.',
                icon: 'error',
                buttons: false,
                closeOnClickOutside: false,
                closeOnEsc: false,
                timer: 2000
              })
            } else {
              alert("Error occured. Please try again.");
            }

            $('#save_client').attr('disabled', false);
            $('#fullname').focus();
         }  
      });
    }
  });

  $(document).on('click', '.close_modal', function() {  
    window.location.reload();
  });

  $(document).on('click', '.edit_profile', function() {  
    var clientid = $(this).attr('id');
    $('#profile_clientid').val($(this).attr('id'));

    if(clientid != "") {
      $('#town').attr('disabled', false);
      $('#barangay').attr('disabled', false);
    }

    $.ajax({
      url:"controller/save-client.php",
      method:"POST",
      data:{clientid:clientid},
      dataType:"json",
      success:function(data) {
        if(data != 0) {
          $('#firstname').val(data.firstname);
          $('#middlename').val(data.middlename);
          $('#lastname').val(data.lastname);
          $('#designation').val(data.designation);
          $('#division_unit').val(data.division_unit);
          $('#province').append("<option selected value='"+data.provCode+"'>"+data.provDesc+"</option>");
          $('#town').append("<option selected value='"+data.citymunCode+"'>"+data.citymunDesc+"</option>");
          $('#barangay').append("<option selected value='"+data.brgyCode+"'>"+data.brgyDesc+"</option>");
          $('#landline').val(data.landline);
          $('#mobile').val(data.mobile);
          $('#email').val(data.email);
          $('#website').val(data.website);

          $('#save_client').html("<span class='fa fa-check'></span> Update");
          $("#addClient").modal('show');
        } else {
          alert("Could not fetch client profile data.");
        }
      }
    });
  });

  $(document).on('click', '.remove_profile', function() {  
      $('#delete_clientid').val($(this).attr('id'));
      $("#removeList").modal('show');
  });

  $(document).on('click', '#remove_data', function() {  
      var delete_clientid = $('#delete_clientid').val();

      $.ajax({
        url:"controller/save-client.php",
        method:"POST",
        data:{delete_clientid:delete_clientid},
        success:function(data) {
          if(data == 1) {
            swal({
              title: 'Success',
              text: 'SUCCESS! HEI Personnel successfully removed from the list.',
              icon: 'success',
              buttons: false,
              closeOnClickOutside: false,
              closeOnEsc: false,
              timer: 3000
            }).then(function() {
              $("#removeList").modal('hide');
              $("#reloadContent").load(window.location.href + " #reloadContent");     
            })
          } else {
            swal({
              title: 'Error',
              text: 'ERROR! HEI Personnel could not removed from the list.',
              icon: 'error',
              buttons: false,
              closeOnClickOutside: false,
              closeOnEsc: false,
              timer: 3000
            }).then(function() {
              $("#removeList").modal('hide'); 
              $("#reloadContent").load(window.location.href + " #reloadContent");             
            })
          }
        }
      });
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

  $('#expertise').typeahead({
    source: function(expertise, result) {
      $.ajax({
          url:"controller/search-personnel.php",
          method:"POST",
          data:{expertise:expertise},
          dataType:"json",
          success:function(data) {
          result($.map(data, function(item) {
              return item.hei_expertise;
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

//   function checkNoSelect() {
//     var arrCheckboxes = document.deleteFiles.elements["sector[]"];
//     var checkCount = 0;
//     for (var i = 0; i < arrCheckboxes.length; i++) {
//         checkCount += (arrCheckboxes[i].checked) ? 1 : 0;
//     }

//     if (checkCount == 0) {
//       swal({
//         title: 'Warning',
//         text: 'FAILED! Please select at least one sector.',
//         icon: 'success',
//         buttons: false,
//         closeOnClickOutside: false,
//         closeOnEsc: false,
//         timer: 2000
//       })
//     }
// }