$(document).ready(function() {

  // ADD HEI PERSONNEL
  $("#msme_form").on('submit', function(e) {

    e.preventDefault();

    var personnel_id = $('#personnel_id').val();
    var company_name = $('#company_name').val();
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
    } else if(company_name == "" ) {
      swal({
          title: 'Warning',
          text: 'Please enter name of company.',
          icon: 'error',
          buttons: false,
          closeOnClickOutside: false,
          closeOnEsc: false,
          timer: 2000
        });
    } else {

      $.ajax({  
         url:"controller/save-msme.php",  
         method:"POST",  
         data: $("#msme_form").serialize(),
         beforeSend:function() {
          $('#save_msme').attr('disabled', true);
         },
         success:function(response) {
          // alert(response);
            if(response == 0 || response == 2) {
              swal({
                title: 'Warning',
                text: 'FAILED! MSME could not be saved or not found',
                icon: 'error',
                buttons: false,
                closeOnClickOutside: false,
                closeOnEsc: false,
                timer: 2000
              })
            } else if(response == 1) {
              $('#msme_form')[0].reset();

              swal({
                title: 'Success',
                text: 'SUCCESS! New MSME successfully saved.',
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
                text: 'WARNING! MSME name is already on the list. Please try again.',
                icon: 'error',
                buttons: false,
                closeOnClickOutside: false,
                closeOnEsc: false,
                timer: 2000
              });
            } else {
              alert("Error occured. Please try again.");
            }

            $('#save_msme').attr('disabled', false);
            $('#fullname').focus();
         }  
      });
    }
  });

  $(document).on('click', '.close_modal', function() {  

    window.location.reload();
    
  });


  // VIEW MSME PRODUCTS
  $(document).on('click', '.view_msme', function() {  
    $('#msmeid').val($(this).attr('id'));
    $('#msme_id').val($(this).attr('id'));

    var msme_id = $(this).attr('id');
    var sector_id = $(this).attr('data-id');

    // alert(sector_id)
    $.ajax({  
      url:"controller/search-msme.php",  
      method:"POST",  
      data: {msme_id:msme_id,sector_id:sector_id},
      dataType: 'json',
      success:function(response) {
        var len = response.length;
        $('#table_data').empty();

        for(var i = 0; i<len; i++){
            var msme_agri_id = response[i]['msme_agri_id'];
            var company = response[i]['company'];
            var farm_area = response[i]['farm_area'];
            var years_op = response[i]['years_op'];
            var address = response[i]['address'];
            

            $('#table_data').append('<tr><td>'+(i+1)+'</td><td><b>'+company+'</b></td><td>'+farm_area+'</td><td>'+years_op+'</td><td>'+address+'</td><td><button type="button" class="btn btn-success  btn-xs add_agri_product" id="'+msme_agri_id+'"><i class="fa fa-plus"></i></button> <button type="button" class="btn btn-warning  btn-xs view_agri_product" id="'+msme_agri_id+'"><i class="fa fa-eye"></i></button></td></tr>');
        }

        $('#msme_sector_id').val(sector_id);
        $('#sector_id').html('List of Agricultural MSME')
        $('#viewCompany').modal('show');
        $('#addCompanyProduct').modal('hide');
      }
    });

  });


  $(document).on('click', '.add_new', function() {  
    
    var sector_type = $(this).attr('value');
    var owner_name = $('#owner_name').text();
    var f_name = $(this).attr('data-id');


    if(sector_type == "Agriculture") {
      if($('#msme_agri_id').val() != "") {
        $('#msme_agri_id').val($('#msmeagriid').val());
      } else {
        $('#msme_agri_id').val($(this).attr('id'));
      }

      $('#owner').val(owner_name);
      $('#owner').val(f_name);
      
      $('#viewCompany').modal('hide');
      $('#addIndustry').modal('show');
    } else {
      swal({
        title: 'Warning',
        text: 'No form yet is available for this sector.',
        icon: 'warning',
        buttons: false,
        closeOnClickOutside: false,
        closeOnEsc: false,
        timer: 2000
      })
    }
  });

  // ADD MSME AGRI PRODUCTS
  $(document).on('click', '.add_agri_product', function() {  
    
    var msme_agri_id = $(this).attr('id');
    var msme_sector_id = $('#msme_sector_id').val();

    if(msme_agri_id != "") {
      if(msme_sector_id == "Agriculture") {

        $('#msme_agri_prod_id').val(msme_agri_id);
        $('#yield').val();
        $('#cultivars').val();
        $('#prunning').val();
        $('#seeding').val();
        $('#addAgriProduct').modal('show');
      } else {
        swal({
          title: 'Warning',
          text: 'No form yet is available for this sector.',
          icon: 'warning',
          buttons: false,
          closeOnClickOutside: false,
          closeOnEsc: false,
          timer: 2000
        })
      }
    } else {
      swal({
        title: 'Warning',
        text: 'No selected orchard or farm. Please select one.',
        icon: 'warning',
        buttons: false,
        closeOnClickOutside: false,
        closeOnEsc: false,
        timer: 2000
      })
    }
  });

  // ADD HEI PERSONNEL
  $("#msme_product_form").on('submit', function(e) {
    e.preventDefault();

    var msme_id = $('#msme_id').val();
    var product_name = $('#product_name').val();
    var product_desc = $('#product_desc').val();


    if(msme_id == "") {
      swal({
          title: 'Warning',
          text: 'No MSME is selected. Please search and select one to continue!',
          icon: 'error',
          buttons: false,
          closeOnClickOutside: false,
          closeOnEsc: false,
          timer: 2000
        });
    } else if(product_name == "" || product_desc == "") {
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
         url:"controller/save-msme.php",  
         method:"POST",  
         data: $("#msme_product_form").serialize(),
         beforeSend:function() {
          $('#save_product').attr('disabled', true);
         },
         success:function(response) {
            if(response == 0 || response == 2) {
              swal({
                title: 'Warning',
                text: 'FAILED! MSME roduct could not be saved or not found',
                icon: 'error',
                buttons: false,
                closeOnClickOutside: false,
                closeOnEsc: false,
                timer: 2000
              })
            } else if(response == 1) {
              $('#product_name').val("");
              $('#product_desc').val("");

              swal({
                title: 'Success',
                text: 'SUCCESS! New MSME Product successfully saved.',
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
                text: 'WARNING! MSME Product is already on the list. Please try again.',
                icon: 'error',
                buttons: false,
                closeOnClickOutside: false,
                closeOnEsc: false,
                timer: 2000
              });
            } else {
              alert("Error occured. Please try again.");
            }

            $('#save_product').attr('disabled', false);
            $('#product_name ').focus();
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

  $('#product_name').typeahead({
    source: function(product_name, result) {
      $.ajax({
          url:"controller/search-msme.php",
          method:"POST",
          data:{product_name:product_name},
          dataType:"json",
          success:function(data) {
          result($.map(data, function(item) {
              return item.product_name;
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

