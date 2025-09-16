
$(document).ready(function() {
    login_account();
});


function login_account() {

    $("#loginAccount").on('submit', function(e) {

      e.preventDefault();

      var loginEmail = $('#loginEmail').val();
      var loginPassword = $('#loginPassword').val();
    
      if(loginEmail == '' || loginPassword == '') {
        $("#message").show().fadeIn();
        $("#message").html("<span>Please enter required fields</span>");
    
      } else {

        var datastring = $("form[id='loginAccount']").serialize();

        $.ajax({  
             url:"controller/admin-login.php",  
             method:"POST",  
             data: datastring,
             dataType: 'html', 
             success:function(response) {
                if(response == 0 || response == 2) {
                  $("#message").show().fadeIn();
                } else if(response == 1) {
                  window.location = 'home';
                }

                setTimeout(function() {
                  $("#message").hide().fadeOut();
                }, 3000);
             }  
        });
      }
    });
}
