
$(document).ready(function() {
 
  var token = document.getElementById("databases").value;

  switch (token) {
    case "1":
      alert("hei");
      break;
    case "2":
      alert("hei");
      break;

    case "7":
      // alert(token);
      add_industry();
      break;

    case "8":
      add_office();
      break;

    default:
      alert(token);
  }
});

//add regional office
function add_office() {

    $("#saveOffice").on('submit', function(e) {

      e.preventDefault();

      var officeName = $('#officeName').val();
      var office_id = document.getElementById("databases").value;

      if(officeName == '') {
        $("#message1").show().fadeIn();
        $("#message1").html("<span>Please enter required field.</span>");
    
      } else {

        var datastring = $("form[id='saveOffice']").serialize();

        $.ajax({  
             url:"controller/databases/add-office.php",  
             method:"POST",  
             data: datastring,
             dataType: 'html', 
             success:function(response) {
                if(response == 0) {
                  $("#message1").show().fadeIn();
                  $("#message1").html("<strong>WARNING!</strong> Regional Office already exist.");
                } else if(response == 1) {
                  $("#message1").show().fadeIn();
                  $("#message1").html("<button type='button' class='btn-close' data-bs-dismiss='alert'></button><strong>SUCCESS!</strong> New regional office is successfully added.");
                  $('#reload').load('database.php?token='+office_id+' #reload');
                }

                $('#officeName').val('');
                $('#officeCode').val('');
                $('#officeAddress').val('');
                $('#officeEmail').val('');
                $('#officeContact').val('');
                $('#officeName').focus();

                setTimeout(function() {
                    $('#message1').hide().fadeOut();
                    $("#submitOffice").attr("disabled", false);
                 }, 3000);
             }  
        });
      }
    });
}


function add_industry() {

    $("#saveIndustry").on('submit', function(e) {

      e.preventDefault();

      var category = $('#industryCategory').val();
      var office_id = document.getElementById("databases").value;
    
      if(category == '') {
        $("#message").show().fadeIn();
        $("#message").html("<span>Please enter required field.</span>");
    
      } else {

        var datastring = $("form[id='saveIndustry']").serialize();

        $.ajax({  
             url:"controller/databases/add-industry.php",  
             method:"POST",  
             data: datastring,
             dataType: 'html', 
             success:function(response) {
                if(response == 0) {
                  $("#message").show().fadeIn();
                  $("#message").html("<strong>WARNING!</strong> Industry category already exist.");
                } else if(response == 1) {
                  $("#message").show().fadeIn();
                  $("#message").html("<strong>SUCCESS!</strong> New industry category is successfully added.");
                  // $('#reload').load('databases.php?token='+office_id+' #reload');
                  $('#industryCategory').val('');
                }

                setTimeout(function() {
                    $('#message').hide().fadeOut();
                 }, 3000);
             }  
        });
      }
    });
}
