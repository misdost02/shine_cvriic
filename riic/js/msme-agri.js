$(document).ready(function() {

  // ADD AGRICUTURAL MSME
  $("#msme_industry_form").on('submit', function(e) {

    e.preventDefault();

    var msme_id = $('#msme_agri_id').val();

    if(msme_id == "" ) {
      swal({
          title: 'Warning',
          text: 'No MSME client is selected. Please select or search personnel to continue!',
          icon: 'error',
          buttons: false,
          closeOnClickOutside: false,
          closeOnEsc: false,
          timer: 2000
        });
    } else {

      $.ajax({  
         url:"controller/save-industry.php",  
         method:"POST",  
         data: $("#msme_industry_form").serialize(),
         beforeSend:function() {
          $('#save_agri_industry').attr('disabled', true);
         },
         success:function(response) {
          //alert(response);
            if(response == 0 || response == 2) {
              swal({
                title: 'Warning',
                text: 'FAILED! Agricultural indusctry could not be saved or not found',
                icon: 'error',
                buttons: false,
                closeOnClickOutside: false,
                closeOnEsc: false,
                timer: 2000
              })
            } else if(response == 1) {
              $('#msme_industry_form')[0].reset();

              swal({
                title: 'Success',
                text: 'SUCCESS! New Agricultural industry successfully saved.',
                icon: 'success',
                buttons: false,
                closeOnClickOutside: false,
                closeOnEsc: false,
                timer: 3000
              }).then(function() {
                $("#reloadContent").load(window.location.href + " #reloadContent");
                $('#addIndustry').modal('hide');
              });

            } else if(response == 101) {
              // $('#rnd_facilities_form')[0].reset();
              swal({
                title: 'Warning',
                text: 'WARNING! Agricultural Industry sector is already on the list. Please try again.',
                icon: 'warning',
                buttons: false,
                closeOnClickOutside: false,
                closeOnEsc: false,
                timer: 2000
              }).then(function() {
                $('#addIndustry').modal('hide');
              });
            } else {
              alert("Error occured. Please try again.");
            }

            $('#save_agri_industry').attr('disabled', false);
            
         }  
      });
    }
  });

  // ADD AGRICULTURAL PRODUCT
  $("#msme_agri_product_form").on('submit', function(e) {

    e.preventDefault();

    var msme_agri_prod_id = $('#msme_agri_prod_id').val();

    if(msme_agri_prod_id == "" ) {
      swal({
          title: 'Warning',
          text: 'No Agrilcultural Orchard is selected. Please select one to continue.',
          icon: 'error',
          buttons: false,
          closeOnClickOutside: false,
          closeOnEsc: false,
          timer: 2000
        });
    } else {

      $.ajax({  
         url:"controller/save-industry.php",  
         method:"POST",  
         data: $("#msme_agri_product_form").serialize(),
         beforeSend:function() {
          $('#save_agri_product').attr('disabled', true);
         },
         success:function(response) {
          // alert(response);
            if(response == 0 || response == 2) {
              swal({
                title: 'Warning',
                text: 'FAILED! Agricultural product could not be saved or not found',
                icon: 'error',
                buttons: false,
                closeOnClickOutside: false,
                closeOnEsc: false,
                timer: 2000
              })
            } else if(response == 1) {
              swal({
                title: 'Success',
                text: 'SUCCESS! New Agricultural Product successfully saved.',
                icon: 'success',
                buttons: false,
                closeOnClickOutside: false,
                closeOnEsc: false,
                timer: 3000
              }).then(function() {
                $('#cultivars').focus();
              });

            } else if(response == 101) {
              // $('#rnd_facilities_form')[0].reset();
              swal({
                title: 'Warning',
                text: 'WARNING! Agricultural Industry sector is already on the list. Please try again.',
                icon: 'warning',
                buttons: false,
                closeOnClickOutside: false,
                closeOnEsc: false,
                timer: 2000
              }).then(function() {
                $('#addAgriProduct').modal('hide');
              });
            } else {
              alert("Error occured. Please try again.");
            }

            $('#save_agri_product').attr('disabled', false);
            
         }  
      });
    }
  });

  // ADD AGRICULTURAL PRODUCT NUTRIENT MANAGEMENT
  $("#msme_agri_product_nut_form").on('submit', function(e) {

    e.preventDefault();

    var msme_agri_nut_id = $('#msme_agri_nut_id').val();

    if(msme_agri_nut_id == "" ) {
      swal({
          title: 'Warning',
          text: 'No Agrilcultural Product is selected. Please select one to continue.',
          icon: 'error',
          buttons: false,
          closeOnClickOutside: false,
          closeOnEsc: false,
          timer: 2000
        });
    } else {

      $.ajax({  
         url:"controller/save-industry.php",  
         method:"POST",  
         data: $("#msme_agri_product_nut_form").serialize(),
         beforeSend:function() {
          $('#save_agri_product_nut').attr('disabled', true);
         },
         success:function(response) {
          // alert(response);
            if(response == 0 || response == 2) {
              swal({
                title: 'Warning',
                text: 'FAILED! Agricultural product could not be saved or not found',
                icon: 'error',
                buttons: false,
                closeOnClickOutside: false,
                closeOnEsc: false,
                timer: 2000
              }).then(function() {
                $('#addNutrientManagement').modal('hide');
              });
            } else if(response == 1) {
              swal({
                title: 'Success',
                text: 'SUCCESS! New Agricultural Product successfully saved.',
                icon: 'success',
                buttons: false,
                closeOnClickOutside: false,
                closeOnEsc: false,
                timer: 3000
              }).then(function() {
                // $("#nutrient_data").load(window.location.href + " #nutrient_data");
                $('#nut_management').val();
                $('#timing_application').val();
                $('#rate_application').val();
                $('#nut_management').focus();
                $('#addNutrientManagement').modal('hide');
              });

            } else if(response == 101) {
              // $('#rnd_facilities_form')[0].reset();
              swal({
                title: 'Warning',
                text: 'WARNING! Agricultural Product is already on the list. Please try again.',
                icon: 'warning',
                buttons: false,
                closeOnClickOutside: false,
                closeOnEsc: false,
                timer: 2000
              }).then(function() {
                $('#addNutrientManagement').modal('hide');
              });
            } else {
              alert("Error occured. Please try again.");
            }

            $('#save_agri_product_nut').attr('disabled', false);
            
         }  
      });
    }
  });

  // ADD AGRICULTURAL PRODUCT PEST MANAGEMENT
  $("#msme_agri_product_pest_form").on('submit', function(e) {

    e.preventDefault();

    var msme_agri_pest_id = $('#msme_agri_pest_id').val();

    if(msme_agri_pest_id == "" ) {
      swal({
          title: 'Warning',
          text: 'No Nutrient Management is selected. Please select one to continue.',
          icon: 'error',
          buttons: false,
          closeOnClickOutside: false,
          closeOnEsc: false,
          timer: 2000
        });
    } else {

      $.ajax({  
         url:"controller/save-industry.php",  
         method:"POST",  
         data: $("#msme_agri_product_pest_form").serialize(),
         beforeSend:function() {
          $('#save_agri_product_pest').attr('disabled', true);
         },
         success:function(response) {
          // alert(response);
            if(response == 0 || response == 2) {
              swal({
                title: 'Warning',
                text: 'FAILED! Pest Management could not be saved or not found',
                icon: 'error',
                buttons: false,
                closeOnClickOutside: false,
                closeOnEsc: false,
                timer: 2000
              }).then(function() {
                $('#addPestManagement').modal('hide');
              });
            } else if(response == 1) {
              swal({
                title: 'Success',
                text: 'SUCCESS! Pest Management successfully saved.',
                icon: 'success',
                buttons: false,
                closeOnClickOutside: false,
                closeOnEsc: false,
                timer: 3000
              }).then(function() {
                $('#addPestManagement').modal('hide');
              });

            } else if(response == 101) {
              // $('#rnd_facilities_form')[0].reset();
              swal({
                title: 'Warning',
                text: 'WARNING! Nutrient Management is already on the list. Please try again.',
                icon: 'warning',
                buttons: false,
                closeOnClickOutside: false,
                closeOnEsc: false,
                timer: 2000
              }).then(function() {
                $('#addPestManagement').modal('hide');
              });
            } else {
              alert("Error occured. Please try again.");
            }

            $('#save_agri_product_pest').attr('disabled', false);
            
         }  
      });
    }
  });

  // VIEW MSME AGRICULTURAL PRODUCTS
  $(document).on('click', '.view_agri_product', function() {  
    var msme_agri_id = $(this).attr('id');
    var msme_sector_id = $('#msme_sector_id').val();

    // alert(sector_id)
    $.ajax({  
      url:"controller/search-industry.php",  
      method:"POST",  
      data: {msme_agri_id:msme_agri_id,msme_sector_id:msme_sector_id},
      dataType: 'json',
      success:function(response) {
        var len = response.length;
        $('#table_data_product').empty();

        for(var i = 0; i<len; i++){
            var msme_agri_id = response[i]['msme_agri_id'];
            var msme_agri_prod_id = response[i]['msme_agri_prod_id'];
            var farm_cultivars = response[i]['farm_cultivars'];
            var farm_yield = response[i]['farm_yield'];
            var farn_pruning = response[i]['farn_pruning'];
            var farm_produce_seed = response[i]['farm_produce_seed'];
            
            if(farm_produce_seed == 1) {
              farm_produce_seed = "Yes";
            } else {
              farm_produce_seed = "No";
            }

            $('#table_data_product').append('<tr id="'+msme_agri_prod_id+'"><td>'+(i+1)+'</td><td><b>'+farm_cultivars+'</b></td><td>'+farm_yield+'</td><td>'+farn_pruning+'</td><td>'+farm_produce_seed+'</td><td><button type="button" class="btn btn-success  btn-xs add_agri_product_nut" id="'+msme_agri_prod_id+'" title="Add Details"><i class="fa fa-plus"></i></button> <button type="button" class="btn btn-warning  btn-xs view_agri_product_nut" id="'+msme_agri_prod_id+'" title="View Nutrient Management"><i class="fa fa-eye"></i></button></td></tr>');
        }

        $('#sector_product_id').html('List of Agricultural Products')
        $('#viewAgriProduct').modal('show');
      }
    });

  });


  $(document).on('click', '.close_modal', function() {  

    window.location.reload();
    
  });



  $(document).on('click', '.view_industry', function() {  
    $('#industryid').val($(this).attr('id'));
    $('#industry_id').val($(this).attr('id'));

    var industry_id = $(this).attr('id');

    $.ajax({  
      url:"controller/search-industry.php",  
      method:"POST",  
      data: {industry_id:industry_id},
      dataType: 'json',
      success:function(response) {
        var len = response.length;
        $('#table_data').empty();

        for(var i = 0; i<len; i++){
            var industry_products = response[i]['industry_products'];
            var industry_description = response[i]['industry_description'];

            $('#table_data').append('<tr><td>'+(i+1)+'</td><td><b>'+industry_products+'</b></td><td>'+industry_description+'</td></tr>');
        }

        $('#viewIndustryProducts').modal('show');
        $('#addIndustryProducts').modal('hide');
      }
    });

  });

  $(document).on('click', '.add_agri_product_nut', function() {  
    var msme_agri_nut_id = $(this).attr('id');
    $('#msme_agri_nut_id').val(msme_agri_nut_id);
    $('#nut_management').val('');
    $('#timing_application').val('');
    $('#rate_application').val('');
    $('#nut_management').focus();
    $('#addNutrientManagement').modal('show');
  });


  $(document).on('click', '.add_agri_product_pest', function() {  
    var msme_agri_pest_id = $(this).attr('id');
    $('#msme_agri_pest_id').val(msme_agri_pest_id);

    $('#addPestManagement').modal('show');
  });

  $(document).on('click', '.add_new', function() {  
    
    
    if($('#industry_id').val() != "") {
      $('#industry_id').val($('#industryid').val());
    } else {
      $('#industry_id').val($(this).attr('id'));
    }

    $('#viewIndustryProducts').modal('hide');
    $('#addIndustryProducts').modal('show');
  });

  // ADD HEI PERSONNEL
  $("#industry_product_form").on('submit', function(e) {
    e.preventDefault();

    var industry_id = $('#industry_id').val();
    var product_name = $('#product_name').val();
    var product_desc = $('#product_desc').val();

    if(industry_id == "") {
      swal({
          title: 'Warning',
          text: 'No Industry is selected. Please search and select one to continue!',
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
         url:"controller/save-industry.php",  
         method:"POST",  
         data: $("#industry_product_form").serialize(),
         beforeSend:function() {
          $('#save_product').attr('disabled', true);
         },
         success:function(response) {
  
            if(response == 0 || response == 2) {
              swal({
                title: 'Warning',
                text: 'FAILED! Industry product could not be saved or not found',
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
                text: 'SUCCESS! New Industry Product successfully saved.',
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
                text: 'WARNING! Industry Product is already on the list. Please try again.',
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

// VIEW MSME AGRICULTURAL PRODUCTS NUTRIENT MANAGEMENT
$(document).on('click', '.view_agri_product_nut', function() {  
  var msme_agri_product_id = $(this).attr('id');

  
  $.ajax({  
    url:"controller/search-industry.php",  
    method:"POST",  
    data: {msme_agri_product_id:msme_agri_product_id},
    dataType: 'json',
    beforeSend:function() {
      var table = document.getElementById('datatable4');
      var cells = table.getElementsByTagName('td');

      for (var i = 0; i < cells.length; i++) {
          // Take each cell
          var cell = cells[i];
          // do something on onclick event for cell
          cell.onclick = function () {
              // Get the row id where the cell exists
              var rowId = this.parentNode.rowIndex;

              var rowsNotSelected = table.getElementsByTagName('tr');
              for (var row = 0; row < rowsNotSelected.length; row++) {
                  rowsNotSelected[row].style.backgroundColor = "";
                  rowsNotSelected[row].classList.remove('selected');
              }
              var rowSelected = table.getElementsByTagName('tr')[rowId];
              rowSelected.style.backgroundColor = "lightgray";
              rowSelected.className += " selected";
          }
      }
     },
    success:function(response) {
      var len = response.length;
      $('#table_data_product_nut').empty();

      for(var i = 0; i<len; i++){
          var agri_nut_id = response[i]['agri_nut_id'];
          var farm_nutrients = response[i]['farm_nutrients'];
          var farm_timing_app = response[i]['farm_timing_app'];
          var farm_rate_app = response[i]['farm_rate_app'];
          var msme_agri_prod_id = response[i]['msme_agri_prod_id'];

          $('#table_data_product_nut').append('<tr><td>'+farm_nutrients+'</td><td>'+farm_timing_app+'</td><td>'+farm_rate_app+'</td><td><button type="button" class="btn btn-danger  btn-xs add_agri_product_pest" id="'+agri_nut_id+'" data-id="'+msme_agri_prod_id+'" title="Add More Details"><i class="fa fa-plus"></i></button> <button type="button" class="btn btn-secondary  btn-xs view_agri_product_pest" id="'+agri_nut_id+'" title="View Nutrient Management"><i class="fa fa-eye"></i></button></td></tr>');
      }
    }
  });

});

// VIEW MSME AGRICULTURAL PRODUCTS PEST MANAGEMENT
$(document).on('click', '.view_agri_product_pest', function() {  
  var msme_agri_pest_id = $(this).attr('id');
  //alert(msme_agri_pest_id);
  $.ajax({  
    url:"controller/search-industry.php",  
    method:"POST",  
    data: {msme_agri_pest_id:msme_agri_pest_id},
    dataType: 'json',
    success:function(response) {
      var len = response.length;
      $('#table_data_product_pest').empty();

      for(var i = 0; i<len; i++) {
          var farm_pest_disease = response[i]['farm_pest_disease'];
          var farm_pest_timing = response[i]['farm_pest_timing'];
          var farm_rate_app = response[i]['farm_rate_app'];
          var farm_insect_pest = response[i]['farm_insect_pest'];
          var farm_growth1 = response[i]['farm_growth1'];
          var farm_diseases = response[i]['farm_diseases'];
          var farm_growth2 = response[i]['farm_growth2'];
          var farm_drainage = response[i]['farm_drainage'];
          var farm_water_mgnt = response[i]['farm_water_mgnt'];
          var farm_fre_irrig = response[i]['farm_fre_irrig'];

          if(farm_drainage == 1) {
            farm_drainage = "Yes";
          } else {
            farm_drainage = "No";
          }

          $('#table_data_product_pest').append('<tr><td>'+farm_pest_disease+'</td><td>'+farm_pest_timing+'</td><td>'+farm_rate_app+'</td><td>'+farm_insect_pest+'</td><td>'+farm_growth1+'</td><td>'+farm_diseases+'</td><td>'+farm_growth2+'</td><td>'+farm_drainage+'</td><td>'+farm_water_mgnt+'</td><td>'+farm_fre_irrig+'</td></tr>');
      }

      $('#viewAgriProductPest').modal('show');
    }
  });

});

  $('#cultivars').typeahead({
    source: function(cultivars, result) {
      $.ajax({
          url:"controller/search-industry.php",
          method:"POST",
          data:{cultivars:cultivars},
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

  $('#nut_management').typeahead({
    source: function(nut_management, result) {
      $.ajax({
          url:"controller/search-industry.php",
          method:"POST",
          data:{nut_management:nut_management},
          dataType:"json",
          success:function(data) {
          result($.map(data, function(item) {
              return item.farm_nutrients;
            }));
          },
          
      });
    },
    afterSelect: function (item) {
      
    },
  });

  $('#timing_application').typeahead({
    source: function(timing_application, result) {
      $.ajax({
          url:"controller/search-industry.php",
          method:"POST",
          data:{timing_application:timing_application},
          dataType:"json",
          success:function(data) {
          result($.map(data, function(item) {
              return item.farm_timing_app;
            }));
          },
          
      });
    },
    afterSelect: function (item) {
      
    },
  });
  
  $('#pest_timing_application').typeahead({
    source: function(pest_timing_application, result) {
      $.ajax({
          url:"controller/search-industry.php",
          method:"POST",
          data:{pest_timing_application:pest_timing_application},
          dataType:"json",
          success:function(data) {
          result($.map(data, function(item) {
              return item.farm_pest_timing;
            }));
          },
          
      });
    },
    afterSelect: function (item) {
      
    },
  });
  
  

});

