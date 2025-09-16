
$(document).ready(function() {
  
  // VIEW HEI PROFILE
  $(document).on('click', '.view_profile', function() {  
    var token_id = $(this).attr("id");  
    $.ajax({  
        url:"controller/fetch-data.php",  
        method:"POST",  
        data:{token_id:token_id},  
        dataType:"json",  
        beforeSend:function() {

        },
        success:function(data) {
          $('#viewClient').modal('show');
          $("input", "#client_form").prop('disabled',true);
          $('#fullname').html(data.firstname + " " + data.lastname);
          $('#designation').html(data.designation);
          $('#division_unit').val(data.division_unit);
          $('#province').val(data.provDesc);
          $('#town').val(data.citymunDesc);
          $('#barangay').val(data.brgyDesc);
          $('#landline').val(data.landline);
          // $('#mobile').val(data.mobile);
          $('#mobile').html("<a href='tel:"+data.mobile+"' target='_blank'>"+data.mobile+"</a>");
          // $('#email').val(data.email);
          $('#email').html("<a href='mailto:"+data.email+"' target='_blank'>"+data.email+"</a>");
          $('#website').html("<a href='"+data.website+"' target='_blank'>"+data.website+"</a>");
          // $('#client_photo').src("../images/personnels/"+data.photo_name);
          if(data.photo_name != "") {
            document.getElementById("client_photo").src = "images/personnels/" + data.photo_name; 
          } else {
            // document.getElementById("client_photo").src = "https://www.cvriics.com/images/personnels/no-photo.jpg"; 
            $("#client_photo").attr("src", "https://www.cvriics.com/images/personnels/no-photo.jpg");
          }
        } 
    });  
  });


  //VIEW R&D FACILITIES UNITS
  $(document).on('click', '.view_rnd', function() {  

    var rnd_id = $(this).attr("id");  

    $.ajax({  
        url:"controller/fetch-data.php",  
        method:"POST",  
        data:{rnd_id:rnd_id},  
        dataType:"json",  
        success:function(response) {
          var len = response.length;
          $('#table_data1').empty();

          for(var i = 0; i<len; i++) {
              var facility_unit_name = response[i]['facility_unit_name'];
              var facility_service_desc = response[i]['facility_service_desc'];

              $('#table_data1').append('<tr><td><b>'+facility_unit_name+'</b></td><td>'+facility_service_desc+'</td></tr>');
          }

          $('#viewFacilities').modal('show');
        } 
    });  
  });

  //FETCH MSME PRODUCTS
  $(document).on('click', '.view_msme', function() {  

    var msme_id = $(this).attr("id");  

    $.ajax({  
        url:"controller/fetch-data.php",  
        method:"POST",  
        data:{msme_id:msme_id},  
        dataType:"json",  
        success:function(response) {
          var len = response.length;
          $('#table_data2').empty();

          for(var i = 0; i<len; i++){
              var msme_products = response[i]['msme_products'];
              var msme_description = response[i]['msme_description'];

              $('#table_data2').append('<tr><td><b>'+msme_products+'</b></td><td>'+msme_description+'</td></tr>');
          }

          $('#viewMSMEProducts').modal('show');
        } 
    });  
  });


  //FETCH INDUSTRY PRODUCTS
  $(document).on('click', '.view_industry', function() {  

    var industry_id = $(this).attr("id");  

    $.ajax({  
        url:"controller/fetch-data.php",  
        method:"POST",  
        data:{industry_id:industry_id},  
        dataType:"json",  
        success:function(response) {
          var len = response.length;
          $('#table_data3').empty();

          for(var i = 0; i<len; i++){
              var industry_products = response[i]['industry_products'];
              var industry_description = response[i]['industry_description'];

              $('#table_data3').append('<tr><td><b>'+industry_products+'</b></td><td>'+industry_description+'</td></tr>');
          }

          $('#viewIndustries').modal('show');
        }
    });  
  });
  

  // VIEW MSME AGRI ORCHARD PRODUCTS

  $(document).on('click', '.view_msme_agri', function() {  
    $('#msmeid').val($(this).attr('id'));

    var msme_agri_id = $(this).attr('id');
    // alert(msme_agri_id);
    
    $.ajax({  
      url:"controller/fetch-data.php",  
      method:"POST",  
      data: {msme_agri_id:msme_agri_id},
      dataType: 'json',
      success:function(response) {
        var len = response.length;
        $('#table_data4').empty();

        for(var i = 0; i<len; i++){
            var msme_agri_id = response[i]['msme_agri_id'];
            var company = response[i]['company'];
            var farm_area = response[i]['farm_area'];
            var years_op = response[i]['years_op'];
            var address = response[i]['address'];
            var latitude = response[i]['latitude'];
            var longitude = response[i]['longitude'];
            var msme_id = response[i]['msme_id'];

            if(latitude != "" && longitude != "") {
              var enabled = "";
            } else {
              var enabled = "disabled";
            }

            $('#table_data4').append('<tr><td>'+(i+1)+'</td><td><b>'+company+'</b></td><td>'+farm_area+'</td><td>'+years_op+' years</td><td>'+address+'</td><td><button type="button" id="'+msme_agri_id+'" data-id="'+msme_agri_id+'" class="btn btn-success btn-sm view_msme_agri_prod"><span class="bi bi-eye"></span> View Details</button> <a type="button" href="https://www.google.com/maps/place/@'+latitude+','+longitude+',14z/" aria-disabled="true" target="_blank" class="btn btn-secondary btn-sm '+enabled+'"><span class="bi bi-search"></span> View on Map</a></td></tr>');
        }

        $('#viewAgri').modal('show');
      }
    });

  });

  // VIEW MSME AGRI ORCHARD PRODUCTS

  $(document).on('click', '.view_msme_agri_prod', function() {  

    var msme_agri_prod_id = $(this).attr('id');
   // alert(msme_agri_prod_id);
    
    $.ajax({  
      url:"controller/fetch-data.php",  
      method:"POST",  
      data: {msme_agri_prod_id:msme_agri_prod_id},
      dataType: 'json',
      success:function(response) {
        //alert(response);
        if(response == "404") {
          $("#viewAgri").modal('hide');
          swal({
            title: 'Warning',
            text: 'WARNING! Could not view details. You are not currently login.',
            icon: 'warning',
            buttons: false,
            closeOnClickOutside: false,
            closeOnEsc: false,
            timer: 3000
          }).then(function() {
            $("#modalLogin").modal('show');
          });
        } else {
            $('#cultivar-data').hide();
            $('#cultivar-data').show('fadeIn');
            $('#nutrient-data').hide();
            $('#pest-data').hide();
            
            var len = response.length;
            $('#table_data_products').empty();

            for(var i = 0; i<len; i++){
                var msme_agri_prod_id = response[i]['msme_agri_prod_id'];
                var farm_cultivars = response[i]['farm_cultivars'];
                var farm_yield = response[i]['farm_yield'];
                var farn_pruning = response[i]['farn_pruning'];
                var farm_produce_seed = response[i]['farm_produce_seed'];
                var msme_agri_id = response[i]['msme_agri_id'];

                if (farm_produce_seed == 1) {
                  farm_produce_seed = "Yes";
                } else {
                  farm_produce_seed = "No";
                }

                $('#table_data_products').append('<tr><td><b>'+farm_cultivars+'</b></td><td>'+farm_yield+'</td><td>'+farn_pruning+'</td><td>'+farm_produce_seed+'</td><td><button type="button" id="'+msme_agri_prod_id+'" data-id="'+msme_agri_prod_id+'" class="btn btn-warning btn-sm view_msme_agri_management"><span class="bi bi-eye"></span> View Nutrient Management</button></td></tr>');
            }

            // $('#viewAgriProduct').modal('show');
          }
        }
    });

  });

  // VIEW MSME AGRI ORCHARD MANAGEMENT

  $(document).on('click', '.view_msme_agri_management', function() {  

    var msme_agri_nut_id = $(this).attr('id');
    //alert(msme_agri_nut_id);
    
    $.ajax({  
      url:"controller/fetch-data.php",  
      method:"POST",  
      data: {msme_agri_nut_id:msme_agri_nut_id},
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
        //alert(response);
          $('#nutrient-data').hide();
          $('#nutrient-data').show('fadeIn');
          $('#pest-data').hide();
          var len = response.length;
          $('#table_data_products_nut').empty();

          for(var i = 0; i<len; i++){
              var agri_nut_id = response[i]['agri_nut_id'];
              var farm_nutrients = response[i]['farm_nutrients'];
              var farm_timing_app = response[i]['farm_timing_app'];
              var farm_rate_app = response[i]['farm_rate_app'];
              var msme_agri_prod_id = response[i]['msme_agri_prod_id'];

              $('#table_data_products_nut').append('<tr><td><b>'+farm_nutrients+'</b></td><td>'+farm_timing_app+'</td><td>'+farm_rate_app+'</td><td><button type="button" id="'+agri_nut_id+'" data-id="'+agri_nut_id+'" class="btn btn-warning btn-sm view_msme_agri_pest"><span class="bi bi-eye"></span> View Pest Management</button></td></tr>');
          }

        }
    });

  });


  // VIEW MSME AGRI ORCHARD PEST MANAGEMENT

  $(document).on('click', '.view_msme_agri_pest', function() {  

    var view_msme_agri_pest = $(this).attr('id');
    //alert(msme_agri_nut_id);
    
    $.ajax({  
      url:"controller/fetch-data.php",  
      method:"POST",  
      data: {view_msme_agri_pest:view_msme_agri_pest},
      dataType: 'json',
      beforeSend:function() {
        var table = document.getElementById('datatable5');
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
        //alert(response);
          $('#pest-data').hide();
          $('#pest-data').show('fadeIn');
          var len = response.length;
          $('#table_data_products_pest').empty();

          for(var i = 0; i<len; i++){
              var agri_pest_id = response[i]['agri_pest_id'];
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
              var agri_nut_id = response[i]['agri_nut_id'];

              if (farm_drainage == 1) {
                farm_drainage = "Yes";
              } else {
                farm_drainage = "No";
              }

              $('#table_data_products_pest').append('<tr><td><b>'+farm_pest_disease+'</b></td><td>'+farm_pest_timing+'</td><td>'+farm_rate_app+'</td><td>'+farm_insect_pest+'</td><td>'+farm_growth1+'</td><td>'+farm_diseases+'</td><td>'+farm_growth2+'</td><td>'+farm_drainage+'</td><td>'+farm_water_mgnt+'</td><td>'+farm_fre_irrig+'</td></tr>');
          }

        }
    });

  });

});