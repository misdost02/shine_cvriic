
$(document).ready(function() {
    add_category();
});


function add_category() {

    $("#saveCategory").on('submit', function(e) {

      e.preventDefault();

      var category = $('#category').val();
    
      if(category == '') {
        $("#message").show().fadeIn();
        $("#message").html("<span>Please enter required field.</span>");
    
      } else {

        var datastring = $("form[id='saveCategory']").serialize();

        $.ajax({  
             url:"controller/add-category.php",  
             method:"POST",  
             data: datastring,
             dataType: 'html', 
             success:function(response) {
                if(response == 0) {
                  $("#message").show().fadeIn();
                } else if(response == 1) {
                  $("#message").show().fadeIn();
                  $("#message").html("<button type='button' class='btn-close' data-bs-dismiss='alert'></button><span>New category is successfully added.</span>");
                  $('#reload').load('categories.php #reload');
                }

                setTimeout(function() {
                    $('#message').hide().fadeOut();
                    $("#savecategory").attr("disabled", false);
                 }, 1500);
             }  
        });
      }
    });
}
