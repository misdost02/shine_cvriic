
$(document).ready(function() {
  add_sub_industry();
});


//add regional officer
function add_sub_industry() {

    $("#saveSubIndustry").on('submit', function(e) {

      e.preventDefault();

      var industryId = $('#industryId').val();
      var industrySubCategory = $('#industrySubCategory').val();

      if(industrySubCategory == '') {
        $("#message3").show().fadeIn();
        $("#message3").html("<span>Please enter required field.</span>");
    
      } else {
        var datastring = $("form[id='saveSubIndustry']").serialize();

        $.ajax({  
             url:"controller/databases/add-industry.php",  
             method:"POST",  
             data: datastring,
             dataType: 'html', 
             success:function(response) {
                if(response == 0) {
                  $("#message3").show().fadeIn();
                  $("#message3").html("<strong>WARNING!</strong> Industry sub-category already exist.");
                } else if(response == 1) {
                  $("#message3").show().fadeIn();
                  $("#message3").html("<strong>SUCCESS!</strong> New industry sub-category is successfully added.");
                  $('#industrySubCategory').val('');
                  $('#industrySubCategory').focus();
                }
                setTimeout(function() {
                    $('#message3').hide().fadeOut();
                 }, 3000);
             }  
        });
      }
    });
}
